import mysql.connector

conexion = mysql.connector.connect(
    host = "localhost",
    user = "root",
    password = "",
    database = "inventario_universidad"
)

cursor = conexion.cursor()

sql = """
INSERT INTO USUARIO (nombre, apellido, correo, contrasena)
VALUES (%s, %s, %s, %s)
"""

cursor.execute (sql)

conexion.commit()

print ("Usuario registrado")