# Documentación del Proyecto: Tienda Virtual "ExtremeTech"

**Curso:** Tecnologías y Sistemas Web II (ITI-523)
**Docente:** Ing. Milena Vargas Blanco
**Integrantes:** Keylin Martinez, Ingrid Carvajal y Royner Gutierrez

---

## 1. Descripción del Proyecto
El presente proyecto consiste en el desarrollo de una tienda virtual completa y funcional utilizando el framework **Laravel (PHP)** como tecnología backend principal y **SQLite** como motor de base de datos. El diseño y la temática de la tienda están inspirados en "ExtremeTech Costa Rica", enfocándose en la venta de hardware de computadora, periféricos, laptops y monitores.

La aplicación permite a los clientes registrarse de forma segura, navegar por un catálogo dinámico con filtros (por categoría, nombre y precio máximo), visualizar especificaciones detalladas de los productos, agregar productos a un carrito de compras y completar un proceso de *checkout* simulado. Adicionalmente, el sistema envía comprobantes de pago en formato PDF al correo del usuario. A nivel administrativo, el sistema permite la generación de reportes de ventas (por mes y por cliente) en formato PDF.

## 2. Tecnologías Utilizadas
* **Backend:** PHP 8.x con Laravel Framework.
* **Base de Datos:** SQLite (`database.sqlite`).
* **Frontend:** HTML5, CSS3 mediante Tailwind CSS (framework utilitario de diseño rápido), Blade Templates y JavaScript (Alpine.js / Vanilla JS).
* **Servidor Web:** Apache / Servidor integrado de PHP (`php artisan serve`).
* **Generación de PDFs:** Librería `barryvdh/laravel-dompdf`.

---

## 3. Instrucciones de Uso (Instalación Local)

Para ejecutar este proyecto en un entorno local, siga los siguientes pasos:

1. **Requisitos Previos:** Asegúrese de tener instalado PHP (>= 8.1), Composer y Node.js en su equipo.
2. **Descomprimir:** Extraiga la carpeta del proyecto `ProyectoFinal-Keylin-Ingrid-Royner`.
3. **Instalar Dependencias Backend:** Abra una terminal en la raíz del proyecto y ejecute:
   ```bash
   composer install
   ```
4. **Instalar Dependencias Frontend:** Compile los recursos estáticos (Tailwind) ejecutando:
   ```bash
   npm install
   npm run build
   ```
5. **Configurar el Entorno:** Haga una copia del archivo `.env.example` y renómbrela a `.env`. (Si la base de datos no existe, cree un archivo vacío llamado `database.sqlite` dentro de la carpeta `database`).
   ```bash
   cp .env.example .env
   ```
6. **Generar Llave y Migrar:** 
   ```bash
   php artisan key:generate
   php artisan migrate:fresh --seed
   ```
   *(El comando `--seed` poblará la base de datos con los usuarios de prueba, categorías de hardware y 10 productos reales de tecnología).*
7. **Iniciar Servidor:**
   ```bash
   php artisan serve
   ```
8. **Acceso:** Abra su navegador e ingrese a `http://127.0.0.1:8000`. Puede iniciar sesión con el usuario de prueba generado (correo: `test@example.com`, contraseña: `password`) o registrar uno nuevo.

---

## 4. Diagrama de Caso de Uso: Proceso de Compra

El siguiente diagrama describe las interacciones del Cliente durante el proceso de compra (Checkout) dentro del sistema.

```mermaid
usecaseDiagram
    actor Cliente as "Cliente Registrado"
    
    rectangle "Tienda Virtual ExtremeTech" {
        usecase UC1 as "Agregar Productos al Carrito"
        usecase UC2 as "Ver Carrito y Totales"
        usecase UC3 as "Proceder al Pago (Checkout)"
        usecase UC4 as "Ingresar Dirección y Correo"
        usecase UC5 as "Seleccionar Método de Pago"
        usecase UC6 as "Confirmar Pedido"
        usecase UC7 as "Generar Factura (PDF)"
        usecase UC8 as "Enviar Factura por Correo"
    }
    
    Cliente --> UC1
    Cliente --> UC2
    Cliente --> UC3
    
    UC3 ..> UC4 : <<include>>
    UC3 ..> UC5 : <<include>>
    
    Cliente --> UC6
    UC6 ..> UC7 : <<include>>
    UC6 ..> UC8 : <<include>>
```

**Descripción del Flujo de Compra:**
1. El cliente inicia sesión y navega por el catálogo para **agregar productos al carrito**.
2. Al ir al carrito, el sistema calcula automáticamente subtotal, impuestos (13%) y costo de envío.
3. El cliente da clic en **Proceder al pago**.
4. En la pantalla de confirmación, el cliente debe validar o ingresar su **Correo para recibo** y su **Dirección de envío**.
5. Se seleccionan opciones de pago simuladas (Tarjeta de crédito / PayPal).
6. Al presionar **Confirmar**, el sistema guarda el pedido en la base de datos con estado "Confirmado" y un número de seguimiento único (ej. `TT-A1B2C3D4`).
7. El sistema desencadena la **generación de un PDF** de la factura y su posterior **envío por correo electrónico**.
8. Se redirige al cliente a la vista de "Mis Pedidos" mostrando un mensaje de éxito.
