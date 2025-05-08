import pickle
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.tree import DecisionTreeClassifier

# Definir los tokens y respuestas 
X_train = [
    "datos", "registro", "orden", "ofertas", "plazas", "acreditacion",
    "requisitos", "horarios", "documentos", "reportes", "certificado",
    "fecha limite", "informacion", "contacto", "asesoria", "guia", "formularios",
    "evaluacion", "noticias", "novedades", "calendario", "reporte", "plataforma",
    "inscripcion", "plazo", "consulta", "material", "plaza disponible",
    "entrega reportes", "subir documentos", "periodo", "actividades",
    "proceso registro", "informes", "inscripcion en linea", "completado",
    "registro horas", "trabajo final", "formulario", "certificado horas",
    "validacion", "evaluacion horas", "reglamento", "orden pago", "notificacion",
    "informacion oficial", "fecha inicio", "fecha fin", "planificacion",
    "sistema", "plazo entrega", "consulta en linea", "solicitud", "comentarios",
    "oferta plazas", "fecha corte", "registro servicio", "consultar plaza",
    "subir informe", "horario de trabajo", "detalles plazo",
    "requisitos servicio social", "registro oficial", "inscripcion semestral",
    "fecha registro", "detalles informes", "plazo de entrega",
    "ubicacion plazas", "atencion personal", "horarios de servicio",
    "plazo formal", "programa academico", "reporte final", "tarea final",
    "cursos servicio social", "acceso sistema", "plazo final",
    "consultar horarios", "formato reporte", "programar cita",
    "registro completo", "plataforma educativa", "eventos universidad",
    "registro horas laborales", "solicitar acceso", "resultados evaluacion",
    "encuesta", "cuestionario", "instrucciones", "horarios actividad",
    "validez horas", "completitud tarea", "detalles solicitud",
    "plazos establecidos", "subir solicitud", "comentarios finales",
    "manual usuario", "estado solicitud", "estado reportes", "revision informes",
    "confirmacion registro", "finalizacion servicio", "seguimiento servicio",
    "hola", "gracias","adios"
]

y_train = [
    "🗣Accede a tus datos personales dentro del portal de servicio social. aqui podras encontrar todos tus datos de alumno y modificar algunos datos personales.",
    "👀selecciona (REGISTRO) aqui puedes registrarte unicamente si ya cumples con el 60%, en creditos. en el inicio de la pagina hay un apartado de video aqui explica detalladamente como hacerlo.",
    "💰la orden de pago la puedes descargar y hacer tu pago solicitado en cualquier ventanilla de tu banco preferido. Es un pago unico. así que no olvides guardarla bien.",
    "📑Revisa las ofertas de plazas vigentes en el sistema (OFERTAS DISPONIBLES), previamente ya deberias haber hecho tu registro.",
    "📕Consulta en (LISTADO DE PLAZAS) la plaza que has elegido.",
    "✔Una vez hayas subido todos tus reportes y hayas tenido validados todos, tendras disponible la informacion en el apartado de ACREDITACION de todos los documentos que necesitas para llevar a cabo el proceso.",
    "🖊Necesitas el 60%, de creditos para iniciar tu servicio social y poderte registrar de lo contrario no se puede.",
    "⏱Cada CU tiene su unidad de servicio social y opera a diferentes horas. aqui tengo algunos: Estos son algunos numeros y datos:🔹Unidad de Servicio Social General de la UdeG🔹 Titular: Mtro. Alan Alvarado Peña Correo electrónico: alan.alvarado@udg.mx Teléfono: 33 3134 2222, 🔸Centro Universitario de Ciencias Económico Administrativas (CUCEA)🔸 Titular: Lic. Francisco Martínez Sánchez Correo electrónico: fmartinez@cucea.udg.mx Teléfono: 33 3770 3300 Ubicación: Edificio A-204 Horario de atención: Lunes a viernes de 9:00 a 15:00 y de 16:00 a 19:00 horas Facebook: Unidad de Servicio Social CUCEA, 🔹Centro Universitario de Ciencias Biológicas y Agropecuarias (CUCBA)🔹 Titular: M.V.Z. Leonardo Felipe Alvarado Valencia Correo electrónico: leonardo.alvarado@academicos.udg.mx Teléfono: 33 3777 1150 Ubicación: Edificio H, Planta Baja, Camino Ramón Padilla Sánchez #2100, Nextipac,Zapopan, Jalisco, 🔸Centro Universitario de Ciencias Exactas e Ingenierías (CUCEI)🔸 Titular: Lic. Lucero Araceli Ríos Espinoza Correo electrónico: ussocial@cucei.udg.mx Teléfono: 33 1378 5900, 🔹Centro Universitario de Ciencias de la Salud (CUCS)🔹 Titular: Dra. Alma Marina Sánchez Sánchez orreo electrónico: marina.sanchez@academicos.udg.mx Teléfono: 33 1058 5200 Ext. 33944 Facebook: Unidad de Servicio Social CUCS, 🔸Centro Universitario de Ciencias Sociales y Humanidades (CUCSH)🔸 Titular: Lic. Alfredo Don Olivera Correo electrónico: alfredo.don@hotmail.com Teléfono: 33 3819 3300, 🔹Centro Universitario de Arte, Arquitectura y Diseño (CUAAD)🔹 Titular: Lic. María Elena Aranda Becerra Correo electrónico: elena.aranda@cuaad.udg.mx Teléfono: 33 1202 3000", 
    "💬Para recibir asesoría mas detallada si tienes dudas sobre tu proceso de servicio social tienes que marcar a la unidad de servicio social de tu centro universitario",
    "📎Descarga todos los documentos necesarios desde el portal.",
    "📝Sube tus reportes bimestrales en el apartado de reportes bimestrales en LISTADO DE PLAZAS.",
    "📜Obtendrás tu certificado una vez terminado el servicio social.",
    "📆Recuerda la fecha límite para completar el registro y entrega de reportes. ⚠DATO: te recomendamos que hagas tus reportes bimestrales (cada 2 meses), para que tu proceso de acreditacion sea mucho más rápido.",
    "🔎Toda la información oficial se encuentra en el portal del servicio social al inicio puedes consulatar los videos y visitar el mismo canal de youtube para tener mas clara la informacion paso a paso.",
    "📣En caso de dudas, contáctanos a través de los medios oficiales.",
    "📨Consulta la guía del alumno para completar tu servicio social.",
    "💿Descarga y llena los formularios disponibles para tu inscripción.",
    "📝Al final del servicio, recibirás una evaluación por parte de tu supervisor.",
    "✉Entérate de las últimas noticias y actualizaciones en el portal.",
    "🚩Revisa las novedades importantes sobre procesos y fechas en las paginas de facebook de tu servicio social correspondiente a tu CU.",
    "🔹Consulta el calendario académico relacionado con el servicio social.",
    "📖Debes entregar el reporte bimestral conforme a lo solicitado.",
    "🔑Utiliza la plataforma oficial para todas las gestiones, no utilices otra diferente.",
    "✅Realiza tu inscripción al servicio social directamente en línea y desde esta pagina certificada.",
    "⭕Consulta el plazo máximo para registrar tu servicio social en el correo que te mandarán o que ya te mandaron.",
    "🔝Consulta tu estatus o datos de servicio social en la plataforma en el apartado de (REGISTRO).",
    "📚 Accede al material de apoyo disponible para tu servicio social.",
    "🏢 Visualiza las plazas disponibles y postúlate a la que prefieras.",
    "⏰ Entrega tus reportes en los plazos indicados en el calendario.",
    "📤 Sube tus documentos oficiales a través del sistema de registro.",
    "📅 Consulta el periodo en que deberás realizar tu servicio social.",
    "✅ Verifica las actividades específicas asignadas a tu plaza.",
    "📝 Sigue el proceso de registro como se indica en la guía.",
    "📄 Súbete informes de avance en la plataforma de servicio social.",
    "💻 Puedes completar tu inscripción 100% en línea desde el portal.",
    "🔁 Asegúrate de haber completado todos los pasos de registro.",
    "⌚ Registra correctamente tus horas de servicio en el sistema.",
    "📘 Elabora tu reporte final conforme a las instrucciones oficiales.",
    "🖨️ Descarga el formulario de reporte y llénalo conforme a lo solicitado.",
    "🎓 El certificado de horas será expedido al completar tu servicio social.",
    "📊 Valida tus horas de servicio una vez subidos tus reportes.",
    "🧮 La evaluación de horas se realiza una vez finalizado el servicio.",
    "📖 Consulta el reglamento vigente de servicio social de la UDG.",
    "💳 La orden de pago es requisito indispensable para completar tu inscripción.",
    "📢 Consulta las notificaciones oficiales de la coordinación de servicio social.",
    "🖥️ Verifica toda la información oficial dentro del sistema SIIAU.",
    "🕐 Consulta tu fecha de inicio registrada en la plataforma.",
    "📆 Consulta la fecha de finalización de tu servicio social.",
    "🗓️ Planifica todas tus actividades de acuerdo al calendario oficial.",
    "👨‍🎓 Accede al sistema con tu código de estudiante para revisar información.",
    "📬 Consulta los plazos de entrega de reportes y documentos.",
    "🔎 Accede a la consulta en línea para verificar tu estatus de inscripción.",
    "📝 Solicita tu registro o cambios mediante el apartado de solicitudes.",
    "💬 Puedes enviar tus comentarios sobre el servicio social a través del sistema.",
    "📌 Consulta todas las plazas ofertadas este semestre.",
    "⛔ La fecha de corte de inscripciones es estricta, revisa la programación.",
    "🧾 Registra oficialmente tu servicio social en el sistema.",
    "📍 Consulta los datos y requisitos específicos de cada plaza.",
    "📄 Sube el informe final al terminar tu servicio social.",
    "🕘 Consulta el horario de actividades de tu plaza asignada.",
    "📅 Revisa los detalles de los plazos límite para cada etapa.",
    "📑 Consulta los requisitos específicos del programa de servicio social.",
    "✔️ Confirma tu registro oficial en el portal al terminar tu inscripción.",
    "🌐 La inscripción semestral se realiza mediante el sistema en línea.",
    "📆 Consulta las fechas oficiales para realizar tu registro.",
    "📂 Consulta qué informes debes subir para cada etapa del proceso.",
    "⏳ Verifica los plazos de entrega de los reportes bimestrales.",
    "🗺️ Ubica las plazas disponibles mediante el mapa interactivo.",
    "🙋‍♂️ Solicita atención personal en caso de incidencias.",
    "🕓 Revisa los horarios disponibles para tus actividades de servicio social.",
    "⚠️ Respeta los plazos formales establecidos para completar tu servicio.",
    "📚 Consulta tu programa académico para coordinar tus actividades.",
    "📤 Sube tu reporte final antes de la fecha límite estipulada.",
    "📄 Entrega tu tarea final como evidencia complementaria del servicio social.",
    "🎓 Consulta cursos adicionales de formación para alumnos en servicio social.",
    "🔐 Accede al sistema con tu matrícula y contraseña para continuar.",
    "🚨 Cumple con la entrega antes del plazo final para evitar sanciones.",
    "🕘 Revisa los horarios de tus actividades asignadas en el portal.",
    "📥 Descarga el formato de reporte bimestral desde la plataforma.",
    "📅 Agenda tu cita de atención personalizada si tienes dudas.",
    "✅ Confirma que tu registro esté completo verificando en el sistema.",
    "🌐 Utiliza la plataforma educativa para subir todos tus documentos.",
    "🎓 Participa en los eventos académicos vinculados al servicio social.",
    "🕒 Registra correctamente las horas laborales realizadas cada semana.",
    "❓ Solicita acceso a la plataforma si tienes problemas de ingreso.",
    "📈 Consulta los resultados de tu evaluación al finalizar tu servicio.",
    "📝 Llena la encuesta de satisfacción sobre tu experiencia en servicio social.",
    "📊 Contesta el cuestionario de evaluación de finalización de servicio.",
    "📑 Sigue las instrucciones oficiales para completar tu inscripción.",
    "🕖 Revisa los horarios de actividades extra que puedan surgir.",
    "🧾 Valida las horas trabajadas en tu registro final.",
    "📋 Verifica que todas tus tareas estén completas antes de la entrega.",
    "🗃️ Consulta los detalles de la solicitud de inscripción o cambios.",
    "📆 Cumple con los plazos establecidos para cada actividad.",
    "📎 Sube correctamente tu solicitud a través de la plataforma.",
    "📣 Envía tus comentarios finales al terminar tu servicio social.",
    "📘 Consulta el manual de usuario de la plataforma en caso de dudas.",
    "🌐 Consulta el estado de tu solicitud directamente en línea.",
    "📁 Consulta el estado de tus reportes entregados en el sistema.",
    "🧾 Revisa el avance y revisión de tus informes bimestrales.",
    "✅ Confirma tu registro finalizando el último paso en el sistema.",
    "📋 Consulta las instrucciones para la finalización oficial del servicio social.",
    "🔄 Revisa el seguimiento que debes dar una vez concluido tu servicio.",
    "Que tal, soy SERVIBOT🤖🎩, ¿En que te puedo ayudar?🤔",
    "No hay de que, para eso estoy programado, si necesitas más a SERVIBOT debes llamar🏆",
    "BYE, Hasta pronto.😋"
]

# Verificación que las longitudes coincidan
if len(X_train) != len(y_train):
    raise ValueError(f"Las longitudes no coinciden. X_train tiene {len(X_train)}, y y_train tiene {len(y_train)}.")

# Entrenamiento
vectorizer = TfidfVectorizer()
X_train_tfidf = vectorizer.fit_transform(X_train)

model = DecisionTreeClassifier()
model.fit(X_train_tfidf, y_train)

# Guardar modelo y vectorizador
with open("modelo.pkl", "wb") as model_file:
    pickle.dump(model, model_file)

with open("vectorizer.pkl", "wb") as vectorizer_file:
    pickle.dump(vectorizer, vectorizer_file)

print("Modelo entrenado y guardado exitosamente con tokens y respuestas.")
