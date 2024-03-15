<?php
date_default_timezone_set('America/Recife');

$caminho = "./array.txt";
$pegaArray = file_get_contents($caminho);
$embalagens = json_decode($pegaArray, true);

$novaEmbalagem = array(
    "id" => count($embalagens) + 1, // Incrementa o último ID
    "RFID" => $_POST['rfid'],
    "tipo" => $_POST['tipo'],
    "data" => date('d/m/Y H:i:s'),
    "local" => $_POST['local'],
    "verificacao" => 'Não',
    "dataLeitura" => date('d/m/Y H:i:s'),
);

$embalagens[] = $novaEmbalagem;

$arrayForm = json_encode($embalagens);
file_put_contents($caminho, $arrayForm);

echo json_encode(array("success" => true, "message" => "Embalagem adicionada com sucesso!"));
?>