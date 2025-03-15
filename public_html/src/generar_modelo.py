import pickle
from sklearn.tree import DecisionTreeClassifier

# Simulación de entrenamiento (ajusta con tu modelo real)
modelo = DecisionTreeClassifier()
modelo.fit([[0], [1], [2]], [0, 1, 2])  # Datos de ejemplo

# Guardar el modelo en modelo.pkl en la misma carpeta del script
with open("modelo.pkl", "wb") as model_file:
    pickle.dump(modelo, model_file)

print("✅ Archivo modelo.pkl creado correctamente en", __file__)
