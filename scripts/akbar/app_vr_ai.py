import sys
import os
import warnings

# Suppress all warnings for cleaner output
warnings.filterwarnings("ignore")

# Windows compatibility
if sys.platform == "win32":
    # Suppress NumPy/PyTorch warnings on Windows
    os.environ["KMP_DUPLICATE_LIB_OK"] = "True"

import argparse
import json
from collections import Counter
from pathlib import Path

import cv2
import torch
from PIL import Image
from torchvision import models, transforms
from ultralytics import YOLO


def write_json(path: Path, payload: dict) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    path.write_text(json.dumps(payload, indent=2), encoding="utf-8")


def parse_source(raw_source: str):
    source = raw_source.strip()
    if source.isdigit():
        return int(source)
    return source


def main() -> int:
    parser = argparse.ArgumentParser(description="VR Tourism AI Monitor")
    parser.add_argument("--source", required=True, help="Video source path/url/index")
    parser.add_argument("--output-json", required=True, help="Path to output JSON")
    parser.add_argument("--output-video", required=True, help="Path to output mp4")
    parser.add_argument("--max-frames", type=int, default=300, help="Maximum frame processed")
    args = parser.parse_args()

    output_json = Path(args.output_json)
    output_video = Path(args.output_video)

    try:
        _script_dir = Path(__file__).parent
        yolo_model = YOLO(str(_script_dir / "yolov8n.pt"))

        weights = models.MobileNet_V2_Weights.DEFAULT
        weather_model = models.mobilenet_v2(weights=weights)
        weather_model.eval()
        preprocess = weights.transforms()
        categories = weights.meta.get("categories", [])

        cap = cv2.VideoCapture(parse_source(args.source))
        if not cap.isOpened():
            write_json(output_json, {
                "success": False,
                "message": f"Tidak dapat membuka source video: {args.source}",
            })
            return 1

        fps = cap.get(cv2.CAP_PROP_FPS)
        if fps <= 0:
            fps = 20.0

        width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH)) or 1280
        height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT)) or 720

        output_video.parent.mkdir(parents=True, exist_ok=True)
        writer = cv2.VideoWriter(
            str(output_video),
            cv2.VideoWriter_fourcc(*"mp4v"),
            fps,
            (width, height),
        )

        frame_count = 0
        person_counts = []
        weather_labels = []

        while cap.isOpened() and frame_count < max(1, args.max_frames):
            ret, frame = cap.read()
            if not ret:
                break

            results = yolo_model(frame, classes=[0], verbose=False)
            person_count = len(results[0].boxes)
            person_counts.append(person_count)
            annotated_frame = results[0].plot()

            if frame_count % 10 == 0:
                img_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
                pil_img = Image.fromarray(img_rgb)
                input_tensor = preprocess(pil_img).unsqueeze(0)
                with torch.no_grad():
                    weather_output = weather_model(input_tensor)
                    pred_idx = int(weather_output.argmax(dim=1).item())
                    label = categories[pred_idx] if categories else f"class_{pred_idx}"
                    weather_labels.append(label)
            else:
                label = weather_labels[-1] if weather_labels else "menganalisis"

            cv2.rectangle(annotated_frame, (12, 12), (460, 100), (0, 0, 0), -1)
            cv2.putText(
                annotated_frame,
                f"Jumlah Pengunjung: {person_count}",
                (20, 45),
                cv2.FONT_HERSHEY_SIMPLEX,
                0.8,
                (0, 255, 0),
                2,
            )
            cv2.putText(
                annotated_frame,
                f"Cuaca (Top-1): {label[:35]}",
                (20, 80),
                cv2.FONT_HERSHEY_SIMPLEX,
                0.7,
                (0, 255, 255),
                2,
            )

            writer.write(annotated_frame)
            frame_count += 1

        cap.release()
        writer.release()

        dominant_weather = "unknown"
        if weather_labels:
            dominant_weather = Counter(weather_labels).most_common(1)[0][0]

        avg_person = round(sum(person_counts) / len(person_counts), 2) if person_counts else 0
        max_person = max(person_counts) if person_counts else 0

        write_json(output_json, {
            "success": True,
            "message": "Analisis selesai.",
            "frames_processed": frame_count,
            "avg_person_count": avg_person,
            "max_person_count": max_person,
            "dominant_weather_label": dominant_weather,
            "weather_samples": weather_labels[:30],
        })
        return 0
    except Exception as exc:
        write_json(output_json, {
            "success": False,
            "message": f"Exception saat analisis: {exc}",
        })
        return 1


if __name__ == "__main__":
    raise SystemExit(main())
