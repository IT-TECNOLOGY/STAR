<?php
include './conexao.php';

$id = $_POST['id'];

$target_dir = "../fotoProdutos/";
$target_file = $target_dir . basename($_FILES["imagem"]["name"]);
$target_file2 = $target_dir . basename($_FILES["imagem2"]["name"]);
$target_file3 = $target_dir . basename($_FILES["imagem3"]["name"]);
$target_file4 = $target_dir . basename($_FILES["imagem4"]["name"]);

// Verifique o tipo de arquivo
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
    // Se o arquivo não for uma imagem válida, você pode lidar com isso adequadamente
    echo "Somente arquivos JPG, JPEG, PNG e GIF são permitidos.";
    exit;
}

// Verifique se ocorreu algum erro durante o upload
if ($_FILES["imagem"]["error"] !== UPLOAD_ERR_OK) {
    echo "Erro durante o upload do arquivo.";
    exit;
}

// Faça o upload do arquivo
move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file);
move_uploaded_file($_FILES["imagem2"]["tmp_name"], $target_file);
move_uploaded_file($_FILES["imagem3"]["tmp_name"], $target_file);
move_uploaded_file($_FILES["imagem4"]["tmp_name"], $target_file);

// Atualize o banco de dados
$query = "UPDATE produtos SET foto = ?, foto2 = ?, foto3 = ?, foto4 = ? WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('ssssi', $target_file, $target_file2, $target_file3, $target_file4, $id);
$stmt->execute();
$stmt->close();

header('Location: ../usuarios/pedidos.php');
?>