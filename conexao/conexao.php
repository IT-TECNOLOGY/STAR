<?php

//servidor onde fica o banco de dados
  $host = 'db4free.net'; // Nome ou endereço IP do servidor MySQL
  $port = 3306; // Porta do servidor MySQL
  $username = 'laboratoriostar'; // Nome de usuário do banco de dados
  $password = 'Leandro22'; // Senha do banco de dados
  $database = 'laboratoriostar'; // Nome do banco de dados

  // Conectar ao servidor MySQL
    $db = new mysqli($host, $username, $password, $database, $port);

    // Verificar a conexão
    if ($db->connect_error) {
        die('Erro na conexão: ' . $db->connect_error);
    }

      if (!isset($_SESSION)) session_start();
?>