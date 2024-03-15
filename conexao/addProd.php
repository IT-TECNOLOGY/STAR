<?php
include './conexao.php';

$idCliente = $_POST['idCliente']; // assuming this is the id of the client
$nome = $_POST['nome'];
$objetivo = $_POST['objetivo'];
$serv = $_POST['servico'];
$design = $_POST['design'];
$func = $_POST['func'];
$status = "A verificar";
date_default_timezone_set('America/Recife');
$data = date("Y/m/d H:i:s"); // current date

$query0 = "SELECT * FROM usuarios WHERE id = $idCliente";
$resultado0 = $db->query($query0);

$user = $resultado0->fetch_assoc();

$query = "INSERT INTO produtos (idCliente, nome, objetivo, servico, design, func, dataC, status, cliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('issssssss', $idCliente, $nome, $objetivo, $serv, $design, $func, $data, $status, $user['id']);
$stmt->execute();
$stmt->close();

header( 'Location: ../usuarios/perfil.php' );
?>