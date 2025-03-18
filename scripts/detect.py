import sys
import json
import cv2
import numpy as np
from inference_sdk import InferenceHTTPClient
import supervision as sv
import pandas as pd

file_path = "C:\laragon\www\e-waste-management-v1\scripts\e_waste_dataset.csv"
data_file = pd.read_csv(file_path)

image_path = sys.argv[1]
image = cv2.imread(image_path)

CLIENT = InferenceHTTPClient(
    api_url="https://detect.roboflow.com",
    api_key="ZASMC8AuWSuBkVIfYlpc"
)

result = CLIENT.infer(image, model_id="e-waste-dataset-r0ojc/43")



bounding_box_annotator = sv.BoxAnnotator()
detections_list = []
labels_list = []
components_list = []
haz_materials_list = []
health_env_list = []
Recyclability_list = []

if "predictions" not in result or not result["predictions"]:
    output = {
        "message": "No e-waste detected",
        "labels": [],
        "components": [],
        "Hazardous_Materials": [],
        "Health & Environmental Impact": [],
        "Recyclability": [],
        "image_url": None
    }
else:
    for label in result["predictions"]:
        x0, y0, width, height = label["x"], label["y"], label["width"], label["height"]
        class_name = label["class"]
        confidence = label["confidence"]

        components = data_file[data_file['Device'] == class_name]['Electrical Components'].iloc[0]
        haz_materials = data_file[data_file['Device'] == class_name]['Hazardous Materials'].iloc[0]
        health_env = data_file[data_file['Device'] == class_name]['Health & Environmental Impact'].iloc[0]
        Recyclability = data_file[data_file['Device'] == class_name]['Recyclability'].iloc[0]

        
        x1, y1 = x0 - width / 2, y0 - height / 2
        x2, y2 = x0 + width / 2, y0 + height / 2

        detections_list.append([x1, y1, x2, y2])
        labels_list.append(class_name)
        components_list.append(components)
        haz_materials_list.append(haz_materials)
        health_env_list.append(health_env)
        Recyclability_list.append(Recyclability)

    detections = sv.Detections(
        xyxy=np.array(detections_list),
        class_id=np.zeros(len(detections_list), dtype=int),  
        confidence=np.ones(len(detections_list))
    )

    annotated_image = bounding_box_annotator.annotate(scene=image.copy(), detections=detections)

    output_path = image_path.replace(".jpg", "_annotated.jpg").replace(".png", "_annotated.png")
    cv2.imwrite(output_path, annotated_image)

    output = {
        "message": "E-waste detected",
        "labels": labels_list,
        "components": components_list,
        "Hazardous_Materials": haz_materials_list,
        "Health & Environmental Impact": health_env_list,
        "Recyclability": Recyclability_list,
        "image_url": output_path
    }


print(json.dumps(output))