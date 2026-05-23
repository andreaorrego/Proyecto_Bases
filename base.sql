-- Active: 1778449660132@@127.0.0.1@3307
CREATE DATABASE inventario_universidad;
USE inventario_universidad;

CREATE TABLE USUARIO (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    estado ENUM ('Activo', 'Inactivo')
);

CREATE TABLE ADMINISTRADOR (
    id_usuario INT PRIMARY KEY,
    FOREIGN KEY (id_usuario) 
        REFERENCES USUARIO(id_usuario)
);

CREATE TABLE CLIENTE (
    id_usuario INT PRIMARY KEY,
    cedula INT NOT NULL UNIQUE,
    cargo VARCHAR(100) NOT NULL,
    dependencia VARCHAR(150) NOT NULL,
    FOREIGN KEY (id_usuario) 
        REFERENCES USUARIO(id_usuario)
);

CREATE TABLE PROVEEDOR (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    NIT VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(150) UNIQUE,
    telefono VARCHAR(20)
);

CREATE TABLE EQUIPO (
    id_equipo INT PRIMARY KEY AUTO_INCREMENT,
    serie VARCHAR(100) NOT NULL UNIQUE,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    tipo_equipo VARCHAR(50) NOT NULL,
    estado ENUM ('Disponible', 'Prestado', 'Mantenimiento', 'Dañado') 
        DEFAULT 'Disponible',
    id_proveedor INT NOT NULL,
    FOREIGN KEY (id_proveedor) 
        REFERENCES PROVEEDOR(id_proveedor)
);

CREATE TABLE SOLICITUD_CLIENTE (
    id_solicitud INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_equipo INT NOT NULL,
    observacion VARCHAR(255),
    cantidad INT NOT NULL,
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_retorno DATE,
    responsable VARCHAR(150),
    dependencia VARCHAR(150),
    estado ENUM ('Pendiente', 'Aprobada', 'Rechazada', 'Entregada', 'Devuelta')
        DEFAULT 'Pendiente',
    FOREIGN KEY (id_cliente) 
        REFERENCES CLIENTE(id_usuario),
    FOREIGN KEY (id_equipo) 
        REFERENCES EQUIPO(id_equipo)
);

CREATE TABLE PRESTAMO (
    id_prestamo INT PRIMARY KEY AUTO_INCREMENT,
    id_solicitud INT NOT NULL,
    fecha_entrega DATE NOT NULL,
    fecha_devolucion DATE,
    estado ENUM ('En préstamo', 'Devuelto', 'Retrasado') DEFAULT 'En préstamo',
    FOREIGN KEY (id_solicitud)
        REFERENCES SOLICITUD_CLIENTE (id_solicitud)
)

CREATE TABLE SOLICITUD_COMPRA (
    id_solicitud_compra INT PRIMARY KEY AUTO_INCREMENT,
    id_admin INT NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    fecha_solicitud DATE NOT NULL,
    estado ENUM ('Pendiente', 'Aprobada', 'Rechazada', 'Comprada', 'Recibida')
        DEFAULT 'Pendiente',
    FOREIGN KEY (id_admin) 
        REFERENCES ADMINISTRADOR(id_usuario)
);

CREATE TABLE HISTORIAL_EQUIPO (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_equipo INT,
    evento VARCHAR(50),
    descripcion VARCHAR(255),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_equipo) 
        REFERENCES EQUIPO(id_equipo)
);