<?php
include './conexao.php';

$queryUser = "SELECT * FROM usuarios WHERE id = ".$_SESSION['userID'];
$resultUser = $db->query($queryUser);

$user = $resultUser->fetch_assoc();

$id = $_SESSION['userID'];
$nome = $_POST['nome'];
$tel = $_POST['tel'];
$dataN = $_POST['dataN'];
$empresa = $_POST['empresa'];
$target_dir = "../fotos/";
if (!empty($_FILES["imagem"]["name"])) {
    // O campo de imagem não está vazio, então faça o upload do arquivo
    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
} else {
    // O campo de imagem está vazio, use a foto do banco
    $target_file = $user['foto'];  // Substitua isso pelo caminho real da foto no banco
}

if(empty($dataN)){
  $dataN = $user['dataN'];
}

$queryFoto = "UPDATE usuarios SET foto = '$target_file', nome = '$nome', telefone = '$tel', empresa = '$empresa' WHERE id = $id";
$db->query($queryFoto);
header("Location: ../usuarios/perfil.php");
?>