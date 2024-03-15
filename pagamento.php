<?php
require_once './vendor/autoload.php';

$valor = 50.00; // Defina o valor da transação
$chavePix = '87991384872'; // Substitua pela sua chave Pix

$payload = [
    'chave' => $chavePix,
    'valor' => $valor,
];

$urlPayload = http_build_query($payload);
$url = "https://pix.example.com/pagar?$urlPayload";

$qrCode = new Endroid\QrCode\QrCode($url);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento via Pix</title>
</head>
<body>
    <h1>QR Code para Pagamento via Pix</h1>
    <p>Valor: R$ <?php echo number_format($valor, 2, ',', '.'); ?></p>
    <img src="<?php echo $qrCode->writeDataUri(); ?>" alt="QR Code Pix">
</body>
</html>
