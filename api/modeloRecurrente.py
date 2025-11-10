#pip install tensorflow
import cargarDatos
import tensorflow as tf
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Embedding, LSTM, Dense, Dropout
from tensorflow.keras.preprocessing.text import Tokenizer
from tensorflow.keras.preprocessing.sequence import pad_sequences
from sklearn.model_selection import train_test_split
import matplotlib.pyplot as plt
import joblib

texts = cargarDatos.df01["clean_text"].astype(str).tolist()

labels = cargarDatos.df01["sentiment_vader"].apply(lambda x: 1 if x >= 0.5 else 0).values

tokenizer = Tokenizer(num_words=10000, oov_token="<OOV>")
tokenizer.fit_on_texts(texts)
sequences = tokenizer.texts_to_sequences(texts)
padded_sequences = pad_sequences(sequences, maxlen=100, padding="post", truncating="post")

X_train, X_test, y_train, y_test = train_test_split(
    padded_sequences, labels, test_size=0.2, random_state=42
)

model = Sequential([
    Embedding(input_dim=10000, output_dim=128, input_length=100),
    LSTM(128, return_sequences=False),
    Dropout(0.5),
    Dense(64, activation='relu'),
    Dropout(0.3),
    Dense(1, activation='sigmoid')
])

model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])

print("\nEntrenando modelo LSTM...")
history = model.fit(X_train, y_train, epochs=1000, batch_size=64, validation_split=0.2, verbose=1)

model.save("modelo_recurrente_lstm.h5")
joblib.dump(tokenizer, "tokenizer_sentimientos.pkl")

loss, acc = model.evaluate(X_test, y_test)
print(f"\nPérdida: {loss:.4f} | Exactitud: {acc:.4f}")

plt.figure(figsize=(8,5))
plt.plot(history.history['accuracy'], label='Entrenamiento')
plt.plot(history.history['val_accuracy'], label='Validación')
plt.title("Exactitud del modelo LSTM")
plt.xlabel("Épocas")
plt.ylabel("Exactitud")
plt.legend()
plt.show()

sample_texts = [
    "I feel happy and optimistic today.",
    "I am really sad and disappointed."
]

sample_seq = tokenizer.texts_to_sequences(sample_texts)
sample_pad = pad_sequences(sample_seq, maxlen=100, padding="post")
preds = model.predict(sample_pad)

for text, pred in zip(sample_texts, preds):
    print(f"Texto: {text}\nProbabilidad de positivo: {pred[0]:.3f}\n")
