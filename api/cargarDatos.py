import pandas as pd
import os
import numpy as np

os.makedirs("graficas", exist_ok=True)

df01 = pd.read_json("hf://datasets/Amod/mental_health_counseling_conversations/combined_dataset.json", lines=True)
df02 = pd.read_csv("hf://datasets/Ram07/Detection-for-Suicide/detection_final_cleaned.csv")

