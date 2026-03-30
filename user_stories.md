# Historias de Usuario - ProductosPro Laravel

Este documento detalla las funcionalidades de la aplicación desde la perspectiva del usuario final.

## 🔑 Autenticación y Seguridad

### HU01: Registro de Usuario Personalizado
**Como** nuevo usuario del sistema,
**Quiero** registrarme usando un nombre de usuario único de máximo 15 caracteres,
**Para** poder acceder a la gestión de productos de forma segura.
- **Criterios de Aceptación:**
    - El sistema debe validar que el `user_name` sea único.
    - No se requiere una cuenta de correo electrónico.
    - La contraseña debe confirmarse para evitar errores.

### HU02: Inicio de Sesión
**Como** usuario registrado,
**Quiero** iniciar sesión con mi `user_name` y contraseña,
**Para** acceder a mis herramientas de gestión.

---

## 📦 Gestión de Productos (CRUD)

### HU03: Creación de Productos con Imagen
**Como** administrador de inventario,
**Quiero** crear un nuevo producto subiendo una imagen desde mi computadora,
**Para** que sea más fácil de identificar visualmente en la tienda.
- **Criterios de Aceptación:**
    - Permitir subir formatos JPEG, PNG, JPG y GIF.
    - Validar que el precio sea un número positivo.
    - La imagen debe guardarse correctamente en el servidor.

### HU04: Visualización de Inventario
**Como** usuario del sistema,
**Quiero** ver una lista elegante de todos mis productos con miniaturas de sus fotos,
**Para** tener un control visual de mi stock actual.

---

## 🛒 Carrito de Compras

### HU05: Añadir al Carrito
**Como** comprador,
**Quiero** hacer clic en "Añadir" desde la lista de productos,
**Para** ir seleccionando los artículos que deseo comprar.
- **Criterios de Aceptación:**
    - El carrito debe persistir durante mi sesión.
    - El contador en la barra de navegación debe actualizarse al instante.

### HU06: Gestión del Carrito
**Como** comprador,
**Quiero** ver el total de mi compra y poder cambiar las cantidades,
**Para** ajustar mi pedido antes de finalizar.

---

## 👤 Perfil y Cuenta

### HU07: Edición de Perfil
**Como** usuario registrado,
**Quiero** cambiar mi nombre de usuario o mi contraseña,
**Para** mantener mis datos actualizados o por seguridad.
