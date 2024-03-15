<?php include './header.php'; ?>
<title>STAR - Leitura</title>
</head>
<?php include './navbar.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

 date_default_timezone_set('America/Recife');
?>
<div style="background-color: #ffffff96;">
  <div class="container" style="display: inline-block;">
    <p class="text-center" style="font-size: 30px; padding: 6%; font-weight: 600;">
      Aqui o vendedor pode ver os detalhes das informações da embalagem.<br>
    </p>
      <div class="container">
        <h5>Aqui você fará uma simulação da verificação do código RFID sendo analizado</h5>
      </div>

    <?php
include './lista2.php';
?>
</div>
<?php include './footer.php'; ?>
