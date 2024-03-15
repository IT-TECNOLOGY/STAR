<?php
include '../conexao/conexao.php';
if (!isset($_SESSION['userID'])) {
  header("Location: ../index.php");
}

if ($_SESSION['userID'] == 3) {
  header("Location: ../index.php");
}

include '../components/header.php';
include '../components/navbar.php';

$query2 = "SELECT * FROM produtos WHERE foto != ''";
$resultado2 = $db->query($query2);

$query3 = "SELECT * FROM produtos";
$resultado3 = $db->query($query3);

?>

<style>
  .titulo {
    font-size: 35px;
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: center;
  }

  .pedidos {
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .pedidos .dropdown,
  .pedidos label {
    margin: 10px;
  }

  .pedidos label {
    font-weight: bold;
  }

  .prodBox {
    box-shadow: 0px 0px 10px 0px;
    border-radius: 20px;
    margin: 10px;
    padding: 10px;
    width: 200px;
    display: flex;
    flex-direction: column;
  }

  .chatB1{
    display: flex !important;
  }

</style>

<div style="<?php
if(isset($_POST['id'])){
      echo 'display: none';
    }
  ?>">
  <?php foreach ($resultado2 as $prod) {
    foreach ($resultado as $user) {
      if ($user['tipo'] != 3) {
        $query = "SELECT * FROM usuarios WHERE id = " . $prod['idCliente'];
        $resultado = $db->query($query);

  ?>
        <!-- Tela para os funcionários -->
        <div class="titulo">
          Cadastre os entregaveis aqui
        </div>
        <form action="../conexao/entregar.php" method="POST" enctype="multipart/form-data">
          <div class="pedidos">
            <label>Esolha o serviço</label></br>
            <div class="dropdown">
              <input readonly hidden id="id" name="id" required>
              <input readonly class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" value="Nenhum selecionado">
              <ul class="dropdown-menu">
                <?php foreach ($resultado3 as $nomes) { ?>
                  <li><a class="dropdown-item" id="pedido<?php echo $nomes['id']; ?>"><?php echo $nomes['nome']; ?></a></li>
                  <script>
                    $('#pedido<?php echo $nomes['id']; ?>').click(function() {
                      $('.dropdown-toggle').val("<?php echo $nomes['nome']; ?>");
                      $('#id').val("<?php echo $nomes['id']; ?>");
                    });
                  </script>
                <?php } ?>
              </ul>
            </div>
            <label>Coloque as fotos entregaveis</label>
            <input type="file" name="imagem" class="form-control" required>
            <label>Foto 2</label>
            <input type="file" name="imagem2" class="form-control" required>
            <label>Foto 3</label>
            <input type="file" name="imagem3" class="form-control" required>
            <label>Foto 4</label>
            <input type="file" name="imagem4" class="form-control" required>
            <button class="btn" type="submit">Enviar</button>
          </div>
        </form>

        <div>
          <?php
          if ($resultado->num_rows > 0) {
            foreach ($resultado2 as $prod) {
          ?>
              <div class="prodBox">
                <img src="<?php echo $prod['foto']; ?>" width="100%"></br>
                Nome: <?php echo $prod['nome']; ?></br>
                Cliente: <?php echo $prod['cliente']; ?>
              </div>
          <?php
            }
          } else {
            echo "Nenhum produto encontrado";
          }
          ?>
        </div>
</div>
<?php
      }
    }
}
?>
  <!-- Tela para os clientes -->

<?php

        $queryUser = "SELECT * FROM usuarios WHERE id = ".$_SESSION['userID'];
        $resultadoUser = $db->query($queryUser);
        $user2 = $resultadoUser->fetch_assoc();
  if ($user2['tipo'] == 3 || isset($_POST['id'])) {

            $idProd = $_POST['id'];

            $queryProd = "SELECT * FROM produtos WHERE id = ".$idProd;
            $resultadoProd = $db->query($queryProd);

            $prod2 = $resultadoProd->fetch_assoc();
    $row = $resultadoProd->num_rows;

    ?>

    <style>

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

      div.scroll-container {
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
        padding: 10px;
      }

      div.scroll-container img {
        padding: 10px;
    width: 30%;
      }


    @media(max-width: 500px){
    .modal-content{
    width: 320px !important;
    }

    .box textarea{
    width: 100% !important;
    }

    }
    @media(max-height: 500px){
    .modal-content{
    width: 111% !important;
    }

    .box textarea{
    width: 100% !important;
    }

    }
    </style>

<?php
    $meuArray = array(1, 2, 3, 4);
    ?>

    <div class="titulo">
      Pedido - <?php echo $prod2['nome']; ?>
    </div>
<div>

  <div class="scroll-container">
    <?php if($prod2['foto'] != ''){ ?><img id="f1" data-bs-toggle="modal" data-bs-target="#exampleModal1" src="<?php echo $prod2['foto']; ?>"><?php } ?>
    <?php if($prod2['foto2'] != ''){ ?><img id="f2"  data-bs-toggle="modal" data-bs-target="#exampleModal2" src="<?php echo $prod2['foto2']; ?>"><?php } ?>
    <?php if($prod2['foto3'] != ''){ ?><img id="f3"  data-bs-toggle="modal" data-bs-target="#exampleModal3" src="<?php echo $prod2['foto3']; ?>"><?php } ?>
    <?php if($prod2['foto4'] != ''){ ?><img id="f4"  data-bs-toggle="modal" data-bs-target="#exampleModal4" src="<?php echo $prod2['foto4']; ?>"><?php } ?>
  </div>

  <?php 
  for ($i = 0; $i < 4; $i++) {
  foreach ($meuArray as $item) {
  ?>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal<?php echo $item; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="
    display: flex;
    justify-content: center;">
      <div class="modal-content" style="width: 1044px;">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $prod2['nome']; ?></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <img id="ft<?php echo $item; ?>">
      </div>
    </div>
  </div>

    <script>
        // Aguarde o carregamento do DOM
        $(document).ready(function() {
            // Adicione o evento de clique ao elemento com o ID 'f<?php echo $item; ?>'
            $('#f<?php echo $item; ?>').click(function(){
                // Obtenha a referência da imagem
                var img = document.getElementById("ft<?php echo $item; ?>");

                // Obtenha o caminho da imagem
                var foto = $('#f<?php echo $item; ?>').attr('src');
                img.src = foto;

            });
        });
    </script>
  
    <?php
  }
  }
    ?>

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
<?php } ?>

<?php include '../components/footer.php'; ?>
