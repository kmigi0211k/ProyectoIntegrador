# Arquitectura del Sistema — Proyecto Integrador (PRODUCTOS PRO)

## 1. Introducción

El presente documento describe la arquitectura del sistema web desarrollado como proyecto integrador. La aplicación permite la gestión de productos mediante operaciones CRUD y la exposición de una API para su consumo cuya aplicacion fue una idea de hacer una pagina de productos electronicos.

El objetivo es definir la estructura, modelado, lógica de funcionamiento y stack tecnológico utilizado.

---

## 2. Tipo de Arquitectura

Se adopta una arquitectura **MVC (Modelo — Vista — Controlador)**.

Este patrón permite separar las responsabilidades del sistema en tres componentes principales:

- Modelo: Manejo de datos y lógica de negocio
- Vista: Interfaz de usuario
- Controlador: Procesamiento de solicitudes

---

## 3. Arquitectura en Capas

El sistema se organiza en tres capas:

### 3.1 Capa de Presentación
Responsable de mostrar la información al usuario.

Tecnologías:
- PHP
- HTML5
- CSS3
- Bootstrap
- JavaScript
- SweetAlert
- Laragon

Archivos ubicados en:

application/view/

---

### 3.2 Capa de Lógica de Negocio
Gestiona el flujo de la aplicación y procesa las solicitudes.

Componentes principales:

- Controladores
- Validaciones
- Reglas de negocio

Ubicación:

application/controller/

---

### 3.3 Capa de Datos
Encargada de la interacción con la base de datos.

Incluye:

- Modelos
- Consultas SQL
- Conexión a la base de datos

Ubicación:

application/model/

---

## 4. Front Controller

El sistema utiliza un punto único de entrada:

public/index.php

Este archivo se encarga de:

- Recibir todas las solicitudes HTTP
- Enrutar hacia el controlador adecuado
- Iniciar la aplicación

---

## 5. Estructura del Proyecto

ProyectoJuan/
│
├── application/
│   ├── controller/   (Controladores MVC)
│   ├── core/         (Clases base del sistema)
│   ├── libs/         (Funciones auxiliares)
│   ├── model/        (Acceso a datos)
│   └── view/         (Interfaz de usuario)
│
├── public/
│   ├── admin/        (Plantilla administrativa)
│   │   ├── css/
│   │   ├── js/
│   │   ├── img/
│   │   └── html/
│   │
│   ├── login/        (Interfaz de autenticación)
│   │   ├── css/
│   │   ├── imagenes/
│   │   └── login.html
│   │
│   └── index.php     (Punto único de entrada)
│
├── .htaccess         (Configuración del servidor)
├── README.MD
└── ARQUITECTURA.MD

---

La carpeta `public/` contiene todos los recursos accesibles desde el navegador, incluyendo interfaces gráficas, archivos estáticos y el punto único de entrada del sistema. La plantilla administrativa y la interfaz de login se encuentran separadas para mejorar la organización y seguridad.

## 6. Base de Datos

El sistema utiliza una base de datos relacional.

Gestor: MySQL  
Administrador: phpMyAdmin  

Características:

- Tablas relacionadas
- Claves primarias
- Operaciones CRUD

---

## 7. Servidor de Desarrollo

Se utiliza Laragon como entorno local.

Incluye:

- Servidor Apache
- Motor PHP
- MySQL
- Herramientas de administración

---

## Stack Tecnológico

El sistema Productos Pro fue desarrollado utilizando el siguiente conjunto de tecnologías:

### Backend
- PHP como lenguaje principal del lado del servidor
- Arquitectura Modelo–Vista–Controlador (MVC)
- Base del proyecto MINI (barebone PHP application)

### Frontend
- HTML5 para la estructura
- CSS3 para estilos
- JavaScript para interactividad
- Bootstrap para diseño responsivo
- SweetAlert para alertas dinámicas

### Base de Datos
- MySQL como gestor de base de datos relacional
- phpMyAdmin para administración de la base de datos

### Entorno de Desarrollo
- Laragon como servidor local (Apache + MySQL + PHP)



## 9. Flujo de Funcionamiento del Sistema

1. El usuario accede a la aplicación desde el navegador
2. La solicitud llega al servidor web
3. public/index.php recibe la petición
4. Se enruta hacia el controlador correspondiente
5. El controlador valida la información
6. El modelo interactúa con la base de datos
7. Se obtienen los resultados
8. El controlador envía los datos a la vista
9. La vista genera la respuesta al usuario

---

## 10. Ventajas de la Arquitectura MVC

- Separación de responsabilidades
- Facilita el mantenimiento
- Permite escalabilidad
- Reutilización de código
- Organización clara del proyecto

---

## 11. Proyección Futura

Posibles mejoras del sistema:

- Implementación de autenticación avanzada
- Desarrollo de API REST completa
- Migración a framework moderno como Laravel
- Despliegue en servidor en la nube

---

## 12. Conclusión

La arquitectura MVC permite un desarrollo estructurado, organizado y mantenible. El uso de tecnologías web estándar garantiza compatibilidad y facilidad de implementación
tambien permite la reutilizacion de codigo y es una arquitectura muy usada hoy en dia en el desarrollo de software.