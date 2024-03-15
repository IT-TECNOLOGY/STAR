<?php
include '../conexao/conexao.php';
if (!isset($_SESSION['userID'])) {
  header("Location: ../index.php");
}

include '../components/header.php';
?>
<title>Lista de pedidos</title>
</head>
<?php
include '../components/navbar.php';

$query2 = "SELECT * FROM produtos";
$resultado2 = $db->query($query2);
$query3 = "SELECT * FROM usuarios WHERE id = ".$_SESSION['userID'];
$resultado3 = $db->query($query3);
$user2 = $resultado3->fetch_assoc();

?>

<style>
  .titulo{
    font-size: 35px;
    font-weight: bold;
    padding: 20px;
    text-align: center;
  }

    .pedidos{
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      align-items: center;
    }

  .pedidos div{
    width: 300px;
    height: 300px;
    margin: 20px;
    border-radius: 20px;
    background-color: #f2f2f2;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
  }

.addPedido{
  padding: 2%;
}
  .parallax{
    background-image: url("https://media-cdn.tripadvisor.com/media/photo-s/0d/c3/8c/60/ceu-claro-o-dia-estava.jpg");
  }

  .parallax, .parallax2{
    /* Set a specific height */
    min-height: 500px;
    height: 500px !important;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
<div class="parallax">
<div class="parallax2">
  <div class="titulo text-white">
    Pedidos cadastrados
  </div>
  <?php if($user2['tipo'] != 3){ ?>
  <div class="addPedido">
    <a href="../usuarios/pedidos.php">
    <button class="btn btn-warning" type="button">
      Adicionar pedido
    </button>
    </a>
</div>
  <?php } ?>

                         
    <?php
  $rows = $resultado2->num_rows;
      if($rows > 0 ){
 ?>
  <div class="pedidos">

        <style>
        th, td{
        border-left: 2px solid mediumorchid;
        padding: 0px 14px 11px 12px;
        border-top: 2px solid mediumorchid;
        }
        </style>

    <table style="
        width: 100%;
        background-color: black;
        padding: 15px;
        border-radius: 20px;
        display: block;">
      <thead>
        <tr style="
        color: orchid;
        font-size: 22px;">
          <th scope="col">Id</th>
          <th scope="col">Nome</th>
          <th scope="col">Serviço</th>
          <th scope="col">Objetivo</th>
          <th scope="col">Cliente</th>
          <th scope="col">Status</th>
          <?php if($user['tipo'] != 3){
    ?>
    <th scope="col">Começar</th>
          <?php
          }
?>
         <th>Visualizar</th>
        </tr>
      </thead>
  <?php foreach($resultado2 as $prod){

  $query = "SELECT * FROM usuarios WHERE id = ".$prod['idCliente'];
  $resultado = $db->query($query);


  foreach($resultado as $user){
  ?>
      <tbody>
        <tr style="
    color: orange;
    font-size: 20px;">
          <th scope="row"><?php echo $prod['id']; ?></th>
          <td><?php echo $prod['nome']; ?></td>
          <td><?php echo $prod['servico']; ?></td>
          <td><?php echo $prod['objetivo']; ?></td>
          <td><?php echo $user['nome']; ?></td>
          <td style="color: <?php if($prod['status'] == "A verificar"){
    echo "red";
  }else if($prod['status'] == "Em andamento"){
    echo "orange";
  }else if($prod['status'] == "Finalizado"){
    echo "lime";
  }
    ?>">
    <?php echo $prod['status']; ?>
    </td>
          <?php if($user2['tipo'] != 3 && $prod['status'] == 'A verificar'){
            ?>
            <td scope="col"><button class="btn btn-success" id="comecar<?php echo $prod['id']; ?>">Começar</button></td>
                  <?php
  }else if($prod['status'] == 'Em andamento' && $user2['tipo'] != 3){ ?>
          <td scope="col"></td>
  <?php
  }
    ?>
    <form action="../usuarios/pedidos.php" method="POST">
    <input value="<?php echo $prod['id']; ?>" name="id" hidden>
    <?php if ($prod['status'] == 'Em andamento' && $user2['tipo'] == 3) { ?>
      <td><a href="../usuarios/pedidos.php"><button class="btn btn-success">Ver</button></a></td>
    <?php } else if (($user2['tipo'] == 1 || $user2['tipo'] == 2) && $prod['status'] == 'Em andamento') { ?>
       <form action="../usuarios/pedidos.php" method="POST">
         <input value="<?php echo $prod['id']; ?>" hidden>
      <td><button class="btn btn-success">Ver</button></td>
       </form>
    <?php } else if ($prod['status'] == 'A verificar') { ?>
      <td scope="col"><button class="btn btn-success" hidden>Ver</button></td>
    <?php } ?>
    </form>
        </tr>
      </tbody>
       <script>
          $('#comecar<?php echo $prod['id']; ?>').click(function(){
            var pergunta = prompt('Ao continuar, o status do pedido será alterado para "Em andamento".\n1-Para continuar\nCancele pra voltar');

            if(pergunta == 1){
              window.location.href = "../conexao/notificar.php?id="+<?php echo $user['id']; ?>;
            }
          })
        </script>

        <?php }
      } ?>
    </table>
    
  </div>
<?php }else{ ?>
            <div style="font-size: 4pc;
              text-align: center;
              font-weight: bold;">
  Nenhum pedido encontrado.
              <?php } ?>
            </div>

 
</div>
</div>
<?php
date_default_timezone_set('America/Recife');
$hora = date('H');
?>

<script>
  // Obtém a hora do PHP
  var hora = <?php echo $hora; ?>;

  // Exibe a hora
  var graus = hora*15;
  $('.parallax2').css('background-image', 'linear-gradient('+graus+'deg, transparent, #000000c7)');
</script>
<?php include '../components/footer.php'; ?>