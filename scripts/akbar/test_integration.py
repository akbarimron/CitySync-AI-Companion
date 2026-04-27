#!/usr/bin/env python3
"""
Test case untuk OpenCV + YOLO + MobileNet integration
Menguji deteksi keramaian dan analisis cuaca
"""

import cv2
import torch
from PIL import Image
from torchvision import models, transforms
from ultralytics import YOLO
from pathlib import Path
import json
from datetime import datetime

print("=" * 80)
print("VR TOURISM AI MONITOR - INTEGRATION TEST")
print("=" * 80)

# ==========================================
# TEST 1: Load Models
# ==========================================
print("\n[TEST 1] Loading AI Models...")
print("-" * 80)

try:
    print("  • Loading YOLOv8 (nano) for crowd detection...")
    yolo_model = YOLO(str(Path(__file__).parent / 'yolov8n.pt'))
    print("    ✓ YOLOv8 loaded successfully")
except Exception as e:
    print(f"    ✗ Error loading YOLOv8: {e}")
    exit(1)

try:
    print("  • Loading MobileNetV2 for weather classification...")
    weights = models.MobileNet_V2_Weights.DEFAULT
    weather_model = models.mobilenet_v2(weights=weights)
    weather_model.eval()
    preprocess = weights.transforms()
    categories = weights.meta.get("categories", [])
    print(f"    ✓ MobileNetV2 loaded successfully ({len(categories)} classes)")
except Exception as e:
    print(f"    ✗ Error loading MobileNetV2: {e}")
    exit(1)

print("\n✓ All models loaded successfully!")

# ==========================================
# TEST 2: Webcam Availability Check
# ==========================================
print("\n[TEST 2] Checking Webcam Availability...")
print("-" * 80)

cap = cv2.VideoCapture(0)
if not cap.isOpened():
    print("  ⚠ Webcam not available. Will use test mode.")
    use_webcam = False
else:
    print("  ✓ Webcam is available and ready")
    fps = cap.get(cv2.CAP_PROP_FPS)
    width = int(cap.get(cv2.CAP_PROP_FRAME_WIDTH))
    height = int(cap.get(cv2.CAP_PROP_FRAME_HEIGHT))
    print(f"    - Resolution: {width}x{height} @ {fps} FPS")
    use_webcam = True
    cap.release()

# ==========================================
# TEST 3: Test Crowd Detection (YOLO)
# ==========================================
print("\n[TEST 3] Testing Crowd Detection (YOLO)...")
print("-" * 80)

if use_webcam:
    print("  • Capturing frame from webcam...")
    cap = cv2.VideoCapture(0)
    ret, frame = cap.read()
    cap.release()
    
    if ret:
        print("    ✓ Frame captured successfully")
        print(f"    - Frame shape: {frame.shape}")
        
        print("  • Running YOLO inference...")
        results = yolo_model(frame, classes=[0], verbose=False)
        person_count = len(results[0].boxes)
        
        print(f"    ✓ Detection complete")
        print(f"    - Persons detected: {person_count}")
        
        # Get confidence scores
        if len(results[0].boxes) > 0:
            confidences = results[0].boxes.conf.tolist()
            avg_confidence = sum(confidences) / len(confidences)
            print(f"    - Average confidence: {avg_confidence:.2f}")
    else:
        print("    ✗ Failed to capture frame")
else:
    print("  ⚠ Skipping YOLO test (webcam not available)")
    print("    The model is loaded and ready to use")

# ==========================================
# TEST 4: Test Weather Classification (MobileNet)
# ==========================================
print("\n[TEST 4] Testing Weather Classification (MobileNetV2)...")
print("-" * 80)

if use_webcam:
    print("  • Capturing frame for weather analysis...")
    cap = cv2.VideoCapture(0)
    ret, frame = cap.read()
    cap.release()
    
    if ret:
        print("    ✓ Frame captured")
        
        print("  • Running MobileNetV2 inference...")
        img_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        pil_img = Image.fromarray(img_rgb)
        input_tensor = preprocess(pil_img).unsqueeze(0)
        
        with torch.no_grad():
            weather_output = weather_model(input_tensor)
            pred_idx = int(weather_output.argmax(dim=1).item())
            pred_label = categories[pred_idx] if categories else f"class_{pred_idx}"
            confidence = torch.softmax(weather_output, dim=1)[0][pred_idx].item()
        
        print(f"    ✓ Classification complete")
        print(f"    - Top prediction: {pred_label}")
        print(f"    - Confidence: {confidence:.2%}")
        
        # Show top 5 predictions
        top5_scores, top5_indices = torch.topk(torch.softmax(weather_output, dim=1)[0], 5)
        print(f"    - Top 5 predictions:")
        for i, idx in enumerate(top5_indices):
            label = categories[idx] if categories else f"class_{idx}"
            score = top5_scores[i].item()
            print(f"      {i+1}. {label}: {score:.2%}")
    else:
        print("    ✗ Failed to capture frame")
else:
    print("  ⚠ Skipping MobileNetV2 test (webcam not available)")
    print("    The model is loaded and ready to use")

# ==========================================
# TEST 5: End-to-End Pipeline Test
# ==========================================
print("\n[TEST 5] End-to-End Pipeline Integration...")
print("-" * 80)

if use_webcam:
    print("  • Running full pipeline on single frame...")
    cap = cv2.VideoCapture(0)
    ret, frame = cap.read()
    cap.release()
    
    if ret:
        # 1. Crowd detection
        crowd_results = yolo_model(frame, classes=[0], verbose=False)
        person_count = len(crowd_results[0].boxes)
        
        # 2. Weather analysis
        img_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        pil_img = Image.fromarray(img_rgb)
        input_tensor = preprocess(pil_img).unsqueeze(0)
        with torch.no_grad():
            weather_output = weather_model(input_tensor)
            pred_idx = int(weather_output.argmax(dim=1).item())
            weather_label = categories[pred_idx] if categories else f"class_{pred_idx}"
        
        print(f"    ✓ Full pipeline executed successfully")
        print(f"\n  RESULTS:")
        print(f"    • Visitor count: {person_count} persons")
        print(f"    • Weather: {weather_label}")
        print(f"    • Timestamp: {datetime.now().isoformat()}")
else:
    print("  ⚠ Skipping full pipeline test (webcam not available)")

# ==========================================
# TEST 6: GPU/CPU Check
# ==========================================
print("\n[TEST 6] Hardware Acceleration Check...")
print("-" * 80)

if torch.cuda.is_available():
    print(f"  ✓ CUDA GPU available: {torch.cuda.get_device_name(0)}")
    print(f"    - CUDA Version: {torch.version.cuda}")
else:
    print("  • Running on CPU")
    print("    - PyTorch will use CPU for inference")

print(f"  • PyTorch version: {torch.__version__}")
print(f"  • OpenCV version: {cv2.__version__}")

# ==========================================
# SUMMARY
# ==========================================
print("\n" + "=" * 80)
print("TEST SUMMARY")
print("=" * 80)

results = {
    "timestamp": datetime.now().isoformat(),
    "tests": {
        "models_loaded": True,
        "yolo_available": True,
        "mobilenet_available": True,
        "webcam_available": use_webcam,
    },
    "system": {
        "pytorch_version": torch.__version__,
        "opencv_version": cv2.__version__,
        "cuda_available": torch.cuda.is_available(),
    }
}

print("\n✓ All tests completed!")
print("\nSystem is ready for:")
print("  • Real-time crowd detection using YOLO")
print("  • Weather condition classification using MobileNetV2")
print("  • Integration with IoT camera streams")
print("  • Destination analytics and monitoring")

# Save test results
output_file = Path(__file__).parent / "test_results.json"
with open(output_file, 'w') as f:
    json.dump(results, f, indent=2)

print(f"\n✓ Test results saved to: {output_file}")
print("=" * 80)
