# predict.py
import sys
import json
import numpy as np
import tensorflow as tf
from tensorflow.keras.preprocessing.sequence import pad_sequences
from tensorflow.keras.models import load_model
import joblib
import re
import nltk

nltk.download('punkt', quiet=True)
nltk.download('wordnet', quiet=True)
nltk.download('stopwords', quiet=True)
from nltk.stem import WordNetLemmatizer
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords

# ======================
#  Cargar modelo y tokenizer
# ======================
try:
    model = load_model("modelo_recurrente_lstm.h5")
    tokenizer = joblib.load("tokenizer_sentimientos.pkl")
except Exception as e:
    print(json.dumps({"error": f"No se pudieron cargar los modelos: {str(e)}"}))
    sys.exit(1)

# ======================
#  Limpieza de texto
# ======================
stop_words = set(stopwords.words('english')) - {'no', 'not', 'never'}
lemmatizer = WordNetLemmatizer()

def preprocess_text(text):
    text = str(text).lower()
    text = re.sub(r'[^a-z\s]', '', text)
    tokens = word_tokenize(text)
    tokens = [lemmatizer.lemmatize(w) for w in tokens if w not in stop_words]
    return " ".join(tokens)

# ======================
#  Predicción
# ======================
def predict_sentiment(texts):
    cleaned_texts = [preprocess_text(t) for t in texts]
    sequences = tokenizer.texts_to_sequences(cleaned_texts)
    padded = pad_sequences(sequences, maxlen=100, padding='post')
    preds = model.predict(padded, verbose=0)
    return preds.flatten().tolist()

# ======================
#  Lectura desde PHP
# ======================
try:
    import sys, json

    input_text = sys.stdin.read().strip()

    if not input_text:
        print(json.dumps({"error": "No se recibió ningún input desde PHP"}))
        sys.exit(0)

    try:
        data = json.loads(input_text)
    except Exception as e:
        print(json.dumps({"error": f"Error al decodificar JSON: {str(e)}", "raw_input": input_text}))
        sys.exit(0)

    frases = [data.get(f"frase{i}", "") for i in range(1, 6)]
    if not any(frases):
        print(json.dumps({"error": "No se recibieron frases válidas", "input_data": data}))
        sys.exit(0)

    probabilidades = predict_sentiment(frases)
    promedio = float(np.mean(probabilidades))
    resultado = int(promedio >= 0.5)

    print(json.dumps({
        "resultado": resultado,
        "probabilidad": round(promedio, 4),
        "detalle": [
            {"frase": f, "probabilidad": round(p, 4)} for f, p in zip(frases, probabilidades)
        ]
    }))

except Exception as e:
    import traceback
    print(json.dumps({
        "error": str(e),
        "trace": traceback.format_exc()
    }))
    sys.exit(0)
