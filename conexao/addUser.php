<?php
include './conexao.php';

if (isset($_FILES['imagem'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tel = $_POST['tel'];
    $dataN = $_POST['dataN'];
    $empresa = $_POST['empresa'];
    $tipo = 3;

    $imagem = $_FILES['imagem']['name'];
    $temp = $_FILES['imagem']['tmp_name'];

    // Verifique se o arquivo foi carregado com sucesso antes de movê-lo
        move_uploaded_file($temp, '../fotos/' . $imagem);
        date_default_timezone_set('America/Recife');
        $dataC = date('Y/m/d H:i:s');

        $query = "INSERT INTO usuarios (nome, email, senha, dataN, telefone, dataC, tipo, empresa, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($query);
        $stmt->bind_param('ssssssiss', $nome, $email, $senha, $dataN, $tel, $dataC, $tipo, $empresa, $imagem);
        $stmt->execute();

        header("Location: ../usuarios/login.php");
} else {
    echo "O campo de imagem não está definido.";
}
?>