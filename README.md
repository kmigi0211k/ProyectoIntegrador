# ProductosPro Laravel - Gestión de Inventario & E-commerce

Este proyecto es una modernización de un sistema CRUD de productos, migrado de PHP nativo a **Laravel 10**, integrando un sistema de autenticación seguro, gestión de imágenes y un carrito de compras funcional.

## 🚀 Características (Sprint 1)

- **⚙️ Autenticación Personalizada**: Implementación de Laravel Breeze adaptado a un esquema de base de datos con `user_name` en lugar de `email`.
- **📦 Gestión de Productos (CRUD)**:
    - Creación, edición, visualización y eliminación de productos.
    - Soporte para **subida de imágenes** reales.
    - Interfaz moderna con **Bootstrap 5** y **Bootstrap Icons**.
- **🛒 Carrito de Compras**:
    - Sistema basado en sesiones.
    - Actualización de cantidades por AJAX.
    - Indicador de carrito en la barra de navegación.
- **👤 Mi Perfil**: Gestión de datos de usuario con historial de cambios.
- **🤝 Mercado Solidario (Sprint 4)**:
    - Registro de voluntariado para obtención de productos.
    - Integración con WhatsApp para coordinación directa.
    - Automatización de pruebas y CI/CD con GitHub Actions.


## 🛠️ Stack Tecnológico

- **Framework**: Laravel 10
- **Frontend**: Blade, Bootstrap 5, jQuery
- **Base de Datos**: MySQL
- **Autenticación**: Laravel Breeze (Refactorizado)

## 📋 Requerimientos de Instalación

1. Clonar el repositorio.
2. Ejecutar `composer install`.
3. Configurar el archivo `.env` con tus credenciales de base de datos.
4. Ejecutar las migraciones: `php artisan migrate`.
5. Crear el enlace simbólico para imágenes: `php artisan storage:link`.
6. Compilar assets: `npm install && npm run dev` (o use `npm run build`).

---

## 🧪 Pruebas y Despliegue (Sprint 4)

### Ejecución de Pruebas
Para ejecutar las pruebas automatizadas (Feature y Unit tests):
```bash
php artisan test
```

### CI/CD
El proyecto cuenta con un flujo de **GitHub Actions** configurado para ejecutar las pruebas automáticamente en cada `push` a las ramas `main`, `develop` y ramas de `feature/`.

## 🔗 Enlaces del Proyecto

- **Repositorio**: [GitHub - Proyecto Integrador](https://github.com/kmigi0211k/ProyectoIntegrador)
- **Documentación**: [User Stories](user_stories.md) | [Arquitectura](arquitectura.md)
- **Producción**: [Enlace de Producción (si aplica)](https://proyectointegrador-prod.com)

---
*Desarrollado para el Proyecto Integrador - Desarrollo de Aplicaciones Web - Sprint 4.*

