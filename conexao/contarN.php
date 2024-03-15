<?php
include './conexao.php';

// Verifique o número de novas notificações e se foi checado ou não
$query = "SELECT COUNT(*) as total, MAX(mensagem) as checado FROM notificacao WHERE idCliente = " . $_GET['id'];

$resultado = $db->query($query);

if ($resultado) {
    $dados = $resultado->fetch_assoc();
    echo json_encode($dados);
} else {
    echo json_encode(["error" => "Erro ao verificar notificações."]);
}
?>