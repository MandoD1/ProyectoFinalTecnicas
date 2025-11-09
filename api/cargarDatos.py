import os
import pandas as pd
import numpy as np

df01 = pd.read_json("combined_dataset.json", lines=True)

print("Dataset 1 (local):", df01.shape)

print("\nPrimeras filas del dataset 1:")
print(df01.head())

#¿Cómo podemos identificar automáticamente los perfiles psicológicos de unos posibles usuarios que buscan ayuda en salud mental?
