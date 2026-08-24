# TiendaTec — Proyecto Final

**Autores:** Keylin Martinez, Ingrid Carvajal y Royner Gutierrez

## Descripcion

TiendaTec es una tienda virtual desarrollada con Laravel (PHP) y SQLite que permite a
los usuarios registrarse, navegar por categorias de productos (Electronica, Ropa,
Hogar, Agencia de viajes), agregar productos a un carrito de compras, completar un
proceso de pago (simulado, con fines academicos) y gestionar el historial de sus
pedidos.

## Tecnologias utilizadas

- **Backend:** PHP 8.3+ con Laravel 13 (framework MVC)
- **Base de datos:** SQLite
- **Autenticacion:** Laravel Breeze
- **Frontend:** Blade + Tailwind CSS (via Vite)
- **Reportes:** barryvdh/laravel-dompdf (generacion de PDF)
- **Pruebas:** PHPUnit (pruebas de feature incluidas en `tests/Feature/TiendaTest.php`)

## Funcionalidades principales

1. **Autenticacion y gestion de usuarios**: registro, inicio/cierre de sesion
   (Laravel Breeze), perfil editable con historial de pedidos.
2. **Catalogo de productos**: categorizacion, busqueda por nombre, filtro por
   categoria y precio maximo.
3. **Carrito de compras**: agregar, actualizar cantidad y eliminar productos.
   Calculo automatico de subtotal, impuestos (13%) y costo de envio.
4. **Proceso de compra**: pantalla de checkout con seleccion de metodo de pago
   (Tarjeta de credito / PayPal — simulado), genera un pedido con numero de
   seguimiento unico y factura con fecha, usuario y monto.
5. **Cookies**: se guardan los ultimos 6 productos vistos por el usuario y se
   muestran al final del catalogo ("Vistos recientemente").
6. **Reportes en PDF**: ventas por mes y ventas por cliente, accesibles desde el
   perfil del usuario.

## Seguridad

- **Prevencion de inyeccion SQL**: todas las consultas usan Eloquent ORM
  (parametros vinculados automaticamente), sin SQL crudo concatenado con datos
  del usuario.
- **Prevencion de XSS**: las vistas Blade escapan automaticamente cualquier dato
  mostrado con `{{ }}`.
- **Contrasenas**: hasheadas con bcrypt por Laravel Breeze.
- **Sesiones**: manejadas por el sistema de sesiones de Laravel (firmadas y
  cifradas).
- **HTTPS**: en produccion, la aplicacion debe servirse bajo HTTPS (ver seccion
  de despliegue mas abajo).

## Instalacion local

```bash
composer install
npm install
npm run build
cp .env.example .env   # si no existe ya un .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Luego abrir `http://127.0.0.1:8000`, registrarse y navegar el catalogo.

## Ejecutar las pruebas unitarias

```bash
php artisan test
```

## Diagrama de caso de uso (proceso de compra)

Ver archivo `docs/diagrama-caso-de-uso.md` (diagrama en formato Mermaid, se puede
visualizar en GitHub o en cualquier visor de Mermaid).

## Publicar en GitHub (pendiente de hacer por el equipo)

```bash
git init
git add .
git commit -m "Proyecto final - TiendaTec"
git branch -M main
git remote add origin https://github.com/<usuario>/tiendatec.git
git push -u origin main
```

## Certificado SSL y hosting (pendiente de hacer por el equipo)

Para el hosting gratuito se puede usar un servicio como Railway, Render o un
hosting compartido con soporte para PHP/SQLite. La mayoria de estos servicios
otorgan un certificado SSL gratuito automaticamente (Let's Encrypt) al conectar
un dominio o al usar su subdominio por defecto (ej. `tiendatec.up.railway.app`
ya sirve bajo HTTPS sin configuracion adicional).
