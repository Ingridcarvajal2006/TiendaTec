<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Pedido</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-w: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #ff6600; text-align: center;">¡Gracias por tu compra en ExtremeTech!</h2>
        <p>Hola <strong>{{ $pedido->user->name }}</strong>,</p>
        <p>Hemos recibido tu pedido correctamente. Tu número de seguimiento es: <strong>{{ $pedido->numero_seguimiento }}</strong>.</p>
        
        <p>Adjunto a este correo encontrarás el recibo en formato PDF con todos los detalles de tu compra y la dirección de envío proporcionada.</p>
        
        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #888; font-size: 12px;">
            <p>Este es un correo automático, por favor no respondas.</p>
            <p>&copy; {{ date('Y') }} ExtremeTech Costa Rica.</p>
        </div>
    </div>
</body>
</html>
