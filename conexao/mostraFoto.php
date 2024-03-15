<?php
include 'conexao/conexao.php';
$id = $_GET['id'];
$foto = $_POST['foto'];

$target_dir = "../fotos/";
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);

echo '<img src="../fotos/' . $imagem . '">';


?>