<!doctype html>
<html>
<head>
    <title>Pagar</title>
</head>
<body>
<!-- SDK Client-Side Mercado Pago-->
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    // Agrega credenciales de SDK
    const PublicKey = "<?php echo env('MERCADO_PAGO_PUBLIC_KEY') ?>";
    const mp = new MercadoPago(PublicKey, {
        locale: 'es-CO'
    });
    const preferenceId = "<?php echo $preference->id; ?>";
    // Inicializa el checkout
    mp.checkout({
        preference: {
            id: preferenceId
        },
        // render: {
        //     container: '.cho-container', // Indica dónde se mostrará el botón de pago
        //     label: 'Pagar con Mercado Pago', // Cambia el texto del botón de pago (opcional)
        //     type: 'wallet', // Aplica la marca de Mercado Pago al botón
        // }
        autoOpen: true,
    });
</script>
</body>
</html>
