#!/usr/bin/env python3
"""
CitySync AI Monitor - YOLO Person Detection + Weather Heuristic Analysis
Untuk deteksi keramaian wisata dan kondisi cuaca dari video/stream.
"""
import sys
import os

os.environ["KMP_DUPLICATE_LIB_OK"] = "True"
os.environ["PYTHONIOENCODING"] = "utf-8"

import warnings
warnings.filterwarnings("ignore")

if __name__ == "__main__":
    try:
        import argparse
        import json
        import subprocess
        from collections import Counter
        from pathlib import Path

        import cv2
        import numpy as np
        from ultralytics import YOLO

        def write_json(path: Path, payload: dict) -> None:
            path.parent.mkdir(parents=True, exist_ok=True)
            path.write_text(json.dumps(payload, indent=2, ensure_ascii=False), encoding="utf-8")

        def parse_source(raw_source: str):
            source = raw_source.strip()
            if source.isdigit():
                return int(source)
            return source

        def detect_weather(frame: np.ndarray) -> str:
            """
            Deteksi kondisi cuaca berdasarkan analisis visual frame.
            Menggunakan brightness, saturation, dan kontras langit.

            Returns: 'Cerah', 'Berawan', 'Mendung', atau 'Hujan/Kabut'
            """
            hsv = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)
            h, w = frame.shape[:2]

            # Ambil region langit (1/3 atas frame)
            sky_region = hsv[:h // 3, :, :]
            sky_brightness = float(np.mean(sky_region[:, :, 2]))   # Value channel
            sky_saturation = float(np.mean(sky_region[:, :, 1]))   # Saturation channel

            # Seluruh frame
            overall_brightness = float(np.mean(hsv[:, :, 2]))
            overall_saturation = float(np.mean(hsv[:, :, 1]))

            # Analisis warna biru (langit cerah)
            # Hue 100-130 = biru/langit
            blue_sky_mask = (
                (sky_region[:, :, 0] >= 100) &
                (sky_region[:, :, 0] <= 130) &
                (sky_region[:, :, 1] >= 50) &
                (sky_region[:, :, 2] >= 100)
            )
            blue_ratio = float(np.sum(blue_sky_mask)) / max(1, (h // 3) * w)

            # Klasifikasi
            if overall_brightness < 60:
                return "Malam/Gelap"
            elif overall_brightness < 100 and overall_saturation < 40:
                return "Hujan/Kabut"
            elif sky_brightness < 120 and sky_saturation < 35:
                return "Mendung"
            elif blue_ratio > 0.25 and sky_brightness > 150:
                return "Cerah"
            elif sky_brightness > 160 and sky_saturation < 50:
                return "Cerah Berawan"
            elif sky_brightness > 130:
                return "Berawan"
            else:
                return "Mendung"

        def get_crowd_level(avg_count: float) -> str:
            if avg_count == 0:
                return "Sepi"
            elif avg_count < 3:
                return "Sepi"
            elif avg_count < 8:
                return "Sedang"
            elif avg_count < 15:
                return "Ramai"
            else:
                return "Sangat Ramai"

        def get_visit_recommendation(crowd_level: str, weather: str) -> str:
            bad_weather = weather in ["Hujan/Kabut", "Mendung", "Malam/Gelap"]
            if bad_weather and crowd_level in ["Ramai", "Sangat Ramai"]:
                return "Kurang Disarankan - Cuaca buruk dan lokasi sedang ramai"
            elif bad_weather:
                return "Perlu Persiapan - Bawa payung/jas hujan"
            elif crowd_level == "Sangat Ramai":
                return "Pertimbangkan Waktu Lain - Lokasi sangat padat"
            elif crowd_level == "Ramai":
                return "Siap Dikunjungi - Lokasi sedang ramai, datang lebih awal"
            elif crowd_level in ["Sepi", "Sedang"]:
                return "Waktu Ideal - Lokasi nyaman untuk dikunjungi"
            else:
                return "Siap Dikunjungi"

        # ── Argument parsing ──────────────────────────────────────────────────
        parser = argparse.ArgumentParser(description="CitySync AI Monitor")
        parser.add_argument("--source", required=True, help="Video source path/url/index")
        parser.add_argument("--output-json", required=True, help="Path to output JSON")
        parser.add_argument("--output-video", required=True, help="Path to output mp4")
        parser.add_argument("--max-frames", type=int, default=300, help="Maximum frames to process")
        args = parser.parse_args()

        output_json = Path(args.output_json)
        output_video = Path(args.output_video)
        output_video_tmp = output_video.with_suffix(".tmp.avi")

        # ── Load YOLO ─────────────────────────────────────────────────────────
        # Load model dari direktori script agar tidak bergantung pada working directory
        _script_dir = Path(__file__).parent
        yolo_model = YOLO(str(_script_dir / "yolov8n.pt"))

        source = parse_source(args.source)
        cap = cv2.VideoCapture(source)
        if not cap.isOpened():
            raise RuntimeError(f"Tidak dapat membuka source: {source}")

        fps = cap.get(cv2.CAP_PROP_FPS) or 25.0
        width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH)) or 1280
        height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT)) or 720

        # Tulis dulu ke AVI (OpenCV support native), lalu convert ke H.264 mp4
        output_video.parent.mkdir(parents=True, exist_ok=True)
        fourcc_avi = cv2.VideoWriter_fourcc(*"XVID")
        out = cv2.VideoWriter(str(output_video_tmp), fourcc_avi, fps, (width, height))

        frame_index = 0
        person_counts = []
        weather_votes = Counter()
        weather_sample_interval = 10  # Cek cuaca setiap 10 frame

        while frame_index < args.max_frames:
            ret, frame = cap.read()
            if not ret:
                break

            # ── YOLO person detection ─────────────────────────────────────────
            yolo_results = yolo_model(frame, classes=[0], verbose=False)
            person_count = len(yolo_results[0].boxes)
            person_counts.append(person_count)

            # Gambar anotasi YOLO
            annotated = yolo_results[0].plot()

            # ── Weather detection (setiap N frame) ───────────────────────────
            if frame_index % weather_sample_interval == 0:
                weather_label = detect_weather(frame)
                weather_votes[weather_label] += 1
            else:
                # Gunakan label terakhir
                weather_label = weather_votes.most_common(1)[0][0] if weather_votes else "Menganalisis..."

            # ── Overlay info pada frame ───────────────────────────────────────
            overlay_h = 110
            cv2.rectangle(annotated, (10, 10), (500, overlay_h), (0, 0, 0), -1)
            cv2.rectangle(annotated, (10, 10), (500, overlay_h), (0, 200, 100), 2)

            cv2.putText(
                annotated,
                f"Pengunjung: {person_count} orang",
                (20, 42),
                cv2.FONT_HERSHEY_SIMPLEX, 0.75, (0, 255, 100), 2,
            )
            cv2.putText(
                annotated,
                f"Cuaca: {weather_label}",
                (20, 76),
                cv2.FONT_HERSHEY_SIMPLEX, 0.72, (0, 230, 255), 2,
            )
            cv2.putText(
                annotated,
                f"Frame: {frame_index + 1}/{args.max_frames}",
                (20, 104),
                cv2.FONT_HERSHEY_SIMPLEX, 0.50, (180, 180, 180), 1,
            )

            out.write(annotated)
            frame_index += 1

        cap.release()
        out.release()

        # ── Convert AVI → H.264 MP4 (browser-compatible) ─────────────────────
        ffmpeg_candidates = [
            "ffmpeg",
            r"C:\Users\akbar\AppData\Local\Microsoft\WinGet\Packages\Gyan.FFmpeg_Microsoft.Winget.Source_8wekyb3d8bbwe\ffmpeg-8.1-full_build\bin\ffmpeg.exe",
            r"C:\ffmpeg\bin\ffmpeg.exe",
            r"C:\Program Files\ffmpeg\bin\ffmpeg.exe",
        ]
        ffmpeg_bin = None
        for candidate in ffmpeg_candidates:
            try:
                result = subprocess.run(
                    [candidate, "-version"],
                    capture_output=True, timeout=5
                )
                if result.returncode == 0:
                    ffmpeg_bin = candidate
                    break
            except Exception:
                continue

        video_converted = False
        if ffmpeg_bin and output_video_tmp.exists():
            try:
                conv_result = subprocess.run(
                    [
                        ffmpeg_bin, "-y",
                        "-i", str(output_video_tmp),
                        "-c:v", "libx264",
                        "-preset", "fast",
                        "-crf", "28",
                        "-movflags", "+faststart",
                        "-an",  # no audio
                        str(output_video),
                    ],
                    capture_output=True, timeout=600,
                )
                if conv_result.returncode == 0:
                    video_converted = True
                    output_video_tmp.unlink(missing_ok=True)
            except Exception:
                pass

        if not video_converted and output_video_tmp.exists():
            # Fallback: rename AVI as mp4 (mungkin tidak bisa diputar browser, tapi ada file)
            output_video_tmp.rename(output_video)

        # ── Hitung statistik ─────────────────────────────────────────────────
        avg_person = round(sum(person_counts) / len(person_counts), 1) if person_counts else 0
        max_person = max(person_counts) if person_counts else 0
        min_person = min(person_counts) if person_counts else 0
        dominant_weather = weather_votes.most_common(1)[0][0] if weather_votes else "Tidak Terdeteksi"
        crowd_level = get_crowd_level(avg_person)
        recommendation = get_visit_recommendation(crowd_level, dominant_weather)

        result = {
            "success": True,
            "frames_processed": frame_index,
            "max_person_count": max_person,
            "min_person_count": min_person,
            "avg_person_count": avg_person,
            "dominant_weather_label": dominant_weather,
            "weather_distribution": dict(weather_votes),
            "crowd_level": crowd_level,
            "visit_recommendation": recommendation,
            "video_converted_h264": video_converted,
            "message": "Analisis selesai.",
        }

        write_json(output_json, result)
        print(f"Analisis selesai: {output_json}")
        sys.exit(0)

    except Exception as e:
        import traceback
        error_result = {
            "success": False,
            "message": f"Error: {str(e)}",
            "traceback": traceback.format_exc(),
        }
        try:
            from pathlib import Path
            import json
            out_path = Path(args.output_json)
            out_path.parent.mkdir(parents=True, exist_ok=True)
            out_path.write_text(json.dumps(error_result, indent=2, ensure_ascii=False), encoding="utf-8")
        except Exception:
            pass
        print(f"Error: {str(e)}", file=sys.stderr)
        sys.exit(1)
