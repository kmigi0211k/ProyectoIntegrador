# 🛒 Productos Pro — Sistema de Gestión de Productos

## 📌 Descripción del Proyecto

**Productos Pro** es un sistema web desarrollado en PHP que permite la administración eficiente de productos electronicos  mediante operaciones CRUD (Crear, Leer, Actualizar y Eliminar). 

El sistema dispone de una página principal donde se muestran los productos disponibles para consulta general. Esta sección permite a los visitantes visualizar información básica del inventario sin necesidad de autenticación.

Cuando un usuario decide registrarse o iniciar sesión, es redirigido al panel administrativo (dashboard), desde el cual puede acceder a funcionalidades adicionales, como la visualización detallada del stock disponible.

La aplicación fue diseñada bajo un esquema de control de acceso basado en roles, contemplando dos perfiles principales: administrador y usuario. El rol de administrador cuenta con privilegios completos para la gestión de productos, mientras que el rol de usuario posee permisos de consulta.

Actualmente, el sistema se encuentra en una fase inicial de desarrollo y solo dispone de un usuario registrado correspondiente al desarrollador. No obstante, se proyecta habilitar el registro público en futuras versiones para permitir el acceso a cualquier persona interesada en utilizar la plataforma.

---

## 🎯 Objetivo

Desarrollar una aplicación web funcional que permita gestionar productos de manera centralizada, optimizando procesos administrativos y facilitando el acceso a la información.

---

## ❗ Problema que Resuelve

Muchos negocios pequeños o proyectos académicos no cuentan con herramientas digitales para administrar sus productos.  
Productos Pro ofrece una solución sencilla para registrar, modificar y consultar información de productos en tiempo real.

---

## 🌍 Impacto

El sistema permite digitalizar el manejo de inventario, reduciendo errores manuales y mejorando la organización.  
Puede ser utilizado por:

- Pequeños negocios
- Emprendimientos
- Proyectos académicos
- Desarrolladores como base para sistemas más complejos

---

## ⚙️ Funcionalidades Principales


- Registrar Usuario
- ver Usuario
- Registro de productos
- Edición de información
- Visualización de inventario
- (Crear, Editar, Eliminar)
- Panel administrativo
- Navegación web estructurada

---

## 🏗️ Arquitectura del Sistema

Productos Pro implementa el patrón de diseño:

# MVC — Modelo, Vista y Controlador

Este patrón separa el sistema en tres componentes principales para mejorar la organización, mantenimiento y escalabilidad.

---

### 📊 Modelo (Model)

El modelo es responsable del manejo de datos y la lógica de negocio basicamente se encarga de manejar los datos del usuario.

Funciones principales:

- Conexión a la base de datos
- Consultas SQL
- Inserción, actualización y eliminación de registros
- Validación básica de datos


---

### 🖥️ Vista (View)

La vista representa la interfaz de usuario, es decir, todo lo que el usuario ve en pantalla.

Incluye:

- Formularios
- Tablas de productos
- Panel administrativo
- Elementos gráficos

Tecnologías utilizadas:

- HTML5
- CSS3
- Bootstrap
- JavaScript
- SweetAlert

Ubicación:
---

### 🧠 Controlador (Controller)

El controlador actúa como intermediario entre el modelo y la vista.

Funciones principales:

- Recibir solicitudes del usuario
- Validar datos de entrada
- Llamar al modelo correspondiente
- Enviar resultados a la vista

Ubicación:


application/controller/


---

## 💻 Stack Tecnológico

### Backend
- PHP
- MySQL

### Frontend
- HTML5
- CSS3
- Bootstrap
- JavaScript
- SweetAlert

### Herramientas
- Laragon (Servidor local)
- phpMyAdmin (Administración de base de datos)
- Visual Studio Code
- Git y GitHub

---

## 🗄️ Base de Datos

Gestor: MySQL  
Administrador: phpMyAdmin  

La base de datos almacena la información de productos y permite realizar operaciones CRUD.

---

## 🖥️ Requisitos para Ejecutar

- Servidor local (Laragon, XAMPP o similar)
- PHP 7 o superior
- MySQL
- Navegador web

---

## ▶️ Instalación

1. Descargar o clonar el repositorio
2. Copiar la carpeta al servidor local
3. Importar la base de datos en phpMyAdmin
4. Configurar los datos de conexión
5. Acceder desde el navegador a la ruta del proyecto

---

## 🔮 Proyección Futura

El sistema puede evolucionar hacia:

- Plataforma de ventas en línea
- API REST de productos
- Integración con aplicaciones móviles
- Sistema completo de inventario
- Migración a framework moderno como Laravel

---

## 👤 Autor

**Juan Camilo**

Proyecto desarrollado con fines académicos como parte del Proyecto Integrador.

---

## 📄 Documentación Técnica

Para información detallada sobre la arquitectura del sistema consultar a la arquitectura MD

👉 **ARQUITECTURA.MD**