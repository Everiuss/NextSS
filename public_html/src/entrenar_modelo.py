import pickle
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.tree import DecisionTreeClassifier

# 🔹 Datos de entrenamiento (puedes cambiarlos según tu chatbot)
X_train = ["hola", "registro","reportes", "adiós", "gracias", "requisitos", "contactar"]
y_train = ["Que tal, soy SERVIBOT🤖🎩, ¿En que te puedo ayudar?🤔",
"✅ Para registrarte, ve al portal y en el inicio hay un ⭕Botón que dice VIDEO, dale play y sigue las instrucciones.", "📝 Los reportes deben subirse en la plataforma oficial. 📌Debes entregarlos en las fechas establecidas y subirlos en PDF al sistema.", "BYE, Hasta pronto.😋", "No hay de que, para eso estoy programado, si necesitas más a SERVIBOT debes llamar🏆", "📘 Requisitos para licenciatura: Tener 70% de créditos aprobados, registrarte en la plataforma oficial y cumplir 480 horas de servicio. Y para 🎓  posgrado: Haber cursado al menos 1 año y completar 300 horas de servicio.","📩 Puedes contactar a la coordinación en: contacto@udg.mx"]
# 🔹 Convierte el texto a una representación numérica
vectorizer = TfidfVectorizer()
X_train_vectorized = vectorizer.fit_transform(X_train)

# 🔹 Entrena el modelo de Árbol de Decisión
modelo = DecisionTreeClassifier()
modelo.fit(X_train_vectorized, y_train)

# 🔹 Guarda el modelo y el vectorizador
with open("modelo.pkl", "wb") as model_file:
    pickle.dump(modelo, model_file)

with open("vectorizer.pkl", "wb") as vectorizer_file:
    pickle.dump(vectorizer, vectorizer_file)

print("✅ Modelo y vectorizador guardados exitosamente.")
