<?php
include './conexao/conexao.php';
if (!isset($_SESSION['userID'])) {
  header("Location: ./index.php");
}

if ($_SESSION['userID'] == 3) {
  header("Location: ./index.php");
}

include './components/header.php';
include './components/navbar.php';

$idProd = $_GET['id'];

$query = "SELECT * FROM produtos WHERE id = ".$idProd;
$resultado = $db->query($query);

$prod2 = $resultado->fetch_assoc();
  ?>

<style>
  .carousel-inner{
    height: 500px;
    display: flex;
    align-items: center;
  }

  .infoBox{
    padding: 2%;
  }
  .box input{
    padding: 8px;
    font-size: 22px;
    border: none;
  }

.box textarea{
  width: 50%;
}

  .chatB1{
    display: flex !important;
  }


</style>
  
<div class="pddBox">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <?php foreach ($resultado as $prod) { ?>
        <div class="carousel-item active">
          <img src="<?php echo $prod['foto']; ?>" class="d-block w-100">
        </div>
        <div class="carousel-item active">
          <img src="<?php echo $prod['foto2']; ?>" class="d-block w-100">
        </div>
        <div class="carousel-item active">
          <img src="<?php echo $prod['foto3']; ?>" class="d-block w-100">
        </div>
        <div class="carousel-item active">
          <img src="<?php echo $prod['foto4']; ?>" class="d-block w-100">
        </div>
      <?php } ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<div class="infoBox">
  <h2>    
Informações do serviço
  </h2>
  <div class="box">
    <h3>Descrição</h3>
    <p>Nome</p>
    <input type="text" value="<?php echo $prod2['nome']; ?>" readonly>
    <p>Design</p>
    <textarea><?php echo $prod2['design']; ?></textarea>
    <p>Funcionamento</p>
    <textarea><?php echo $prod2['func']; ?></textarea>
    <p>Objetivo</p>
    <textarea><?php echo $prod2['objetivo']; ?></textarea>
  </div>
</div>

<?php include './components/footer.php'; ?>