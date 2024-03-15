<?php
include './conexao.php';
$id = $_GET['id'];
$query = "SELECT * FROM usuarios WHERE id = $id";
$resultado = $db->query($query);
$user = $resultado->fetch_assoc();

$query2 = "SELECT * FROM produtos WHERE idCliente = $id";
$resultado2 = $db->query($query2);
$prod = $resultado2->fetch_assoc();

$msg = "O desenvolvimento do seu ".$prod['servico']." foi iniciado";
$checado = "não";
date_default_timezone_set('America/Recife');
$data = date("Y/m/d H:i:s");

$query4 = "UPDATE produtos SET status = 'Em andamento' WHERE idCliente = $id";
$db->query($query4);

$query3 = "INSERT INTO notificacao (idCliente, mensagem, checado, data) VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($query3);
$stmt->bind_param('isss', $id, $msg, $checado, $data);
$stmt->execute();
$stmt->close();

header('Location: https://replit.com');
?>