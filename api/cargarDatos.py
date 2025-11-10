#LIBRERIAS E IMPORTS
#pip install textblob vaderSentiment gensim pyLDAvis sentence-transformers -q

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
import warnings

from nltk.corpus import stopwords

warnings.filterwarnings('ignore')

from collections import Counter
import math
import re
import nltk
from wordcloud import WordCloud
from textblob import TextBlob
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
from itertools import combinations

# Topic modeling
from gensim import corpora
from gensim.models import LdaModel, CoherenceModel
from gensim.parsing.preprocessing import STOPWORDS

# Clustering preliminar
from sklearn.decomposition import PCA, TruncatedSVD
from sklearn.feature_extraction.text import TfidfVectorizer, CountVectorizer
from sklearn.preprocessing import StandardScaler, LabelEncoder, MultiLabelBinarizer
from scipy.cluster.hierarchy import dendrogram, linkage
from scipy.spatial.distance import pdist, squareform

# Estadísticas
from scipy import stats
from scipy.stats import chi2_contingency, spearmanr, pearsonr

# Sentence embeddings
from sentence_transformers import SentenceTransformer

# Configuración de gráficos
plt.style.use('seaborn-v0_8-darkgrid')
sns.set_palette("husl")
pd.set_option('display.max_columns', None)
np.random.seed(42)

# Descarga de recursos NLTK
nltk.download('punkt', quiet=True)
nltk.download('stopwords', quiet=True)
nltk.download('wordnet', quiet=True)
nltk.download('vader_lexicon', quiet=True)
nltk.download('averaged_perceptron_tagger', quiet=True)

#CARGA DE DATOS

print("\nCargando dataset...")
df01 = pd.read_json("combined_dataset.json", lines=True)
print("Dimensiones:", df01.shape)
print(df01.head())

#PROCESAMIENTO TEXTO

stop_words = set(stopwords.words('english'))
lemmatizer = nltk.WordNetLemmatizer()

def clean_text(text):
    if not isinstance(text, str):
        return ""
    text = text.lower()
    text = re.sub(r"http\S+|www\S+|https\S+", "", text)
    text = re.sub(r"[^a-z\s]", "", text)
    tokens = nltk.word_tokenize(text)
    tokens = [lemmatizer.lemmatize(w) for w in tokens if w not in stop_words]
    return " ".join(tokens)

print("\nLimpieza de texto...")
df01["clean_text"] = df01["Context"].apply(clean_text)
print("Ejemplo de texto limpio:\n", df01["clean_text"].iloc[0])

#ANÁLISIS DE SENTIMIENTOS

analyzer = SentimentIntensityAnalyzer()

def get_sentiment_vader(text):
    if not isinstance(text, str) or text.strip() == "":
        return 0.0
    return analyzer.polarity_scores(text)["compound"]

df01["sentiment_vader"] = df01["clean_text"].apply(get_sentiment_vader)

def get_sentiment_textblob(text):
    if not isinstance(text, str) or text.strip() == "":
        return 0.0
    return TextBlob(text).sentiment.polarity

df01["sentiment_textblob"] = df01["clean_text"].apply(get_sentiment_textblob)

#VECTORIZACIÓN Y EMBEDINGS

print("\nVectorizando texto (TF-IDF)...")
vectorizer = TfidfVectorizer(max_features=500)
X_tfidf = vectorizer.fit_transform(df01["clean_text"])

print("Reduciendo dimensionalidad (SVD)...")
svd = TruncatedSVD(n_components=2, random_state=42)
X_reduced = svd.fit_transform(X_tfidf)
df01["dim1"] = X_reduced[:, 0]
df01["dim2"] = X_reduced[:, 1]

#GRAFICAS

plt.figure(figsize=(8,6))
sns.scatterplot(x="dim1", y="dim2", data=df01, hue="sentiment_vader", palette="coolwarm", alpha=0.6)
plt.title("Distribución semántica según sentimiento (VADER)")
plt.show()

#EMBEDINGS AVANZADOS

print("\nGenerando embeddings con SentenceTransformer...")
model = SentenceTransformer('all-MiniLM-L6-v2')
embeddings = model.encode(df01["clean_text"].tolist(), show_progress_bar=True)

#MATRIZ SIMILITUD

from sklearn.metrics.pairwise import cosine_similarity
similarity_matrix = cosine_similarity(embeddings)
print("\nMatriz de similitud calculada:", similarity_matrix.shape)

#WORD CLOUS¿D

text_all = " ".join(df01["clean_text"])
wc = WordCloud(width=1000, height=600, background_color='white').generate(text_all)
plt.imshow(wc, interpolation='bilinear')
plt.axis('off')
plt.title("Nube de Palabras - Dataset combinado")
plt.show()
