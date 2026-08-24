# Diagrama de caso de uso — Proceso de compra

```mermaid
graph TD
    Usuario((Usuario))
    Invitado((Visitante sin cuenta))

    Invitado --> UC1[Navegar catalogo de productos]
    Invitado --> UC2[Buscar y filtrar productos]
    Invitado --> UC7[Registrarse]

    Usuario --> UC1
    Usuario --> UC2
    Usuario --> UC3[Iniciar sesion]
    Usuario --> UC4[Agregar producto al carrito]
    Usuario --> UC5[Actualizar / eliminar items del carrito]
    Usuario --> UC6[Realizar checkout]
    UC6 --> UC6a[Elegir metodo de pago]
    UC6 --> UC6b[Confirmar compra]
    UC6b --> UC8[Generar pedido con numero de seguimiento]
    Usuario --> UC9[Ver historial de pedidos]
    Usuario --> UC10[Ver reportes de ventas PDF]
    Usuario --> UC11[Editar perfil]
    Usuario --> UC12[Cerrar sesion]
```

## Flujo textual del proceso de compra

1. El usuario navega el catalogo de productos (con opcion de buscar y filtrar
   por categoria o precio).
2. El usuario debe haber iniciado sesion para agregar productos al carrito.
3. El usuario agrega uno o mas productos al carrito, indicando cantidad.
4. El usuario puede modificar cantidades o eliminar productos del carrito antes
   de pagar.
5. El usuario entra a la pantalla de checkout, donde ve el resumen (subtotal,
   impuestos 13%, costo de envio, total) y elige un metodo de pago (Tarjeta de
   credito o PayPal).
6. Al confirmar, el sistema:
   - Crea un registro en `pedidos` con fecha, montos, metodo de pago y un
     numero de seguimiento unico (`TT-XXXXXXXX`).
   - Crea un registro en `detalle_pedidos` por cada producto comprado.
   - Vacia el carrito de la sesion.
7. El usuario ve la confirmacion del pedido y puede consultarlo despues en
   "Mis pedidos".
