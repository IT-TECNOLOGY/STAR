<?php
include '../conexao/conexao.php';
if (!isset($_SESSION['userID'])) {
  header("Location: ../index.php");
}

$query1 = "SELECT * FROM usuarios WHERE id =".$_SESSION['userID'];
  $resultado1 = $db->query($query1);
$user = $resultado1->fetch_assoc();

if($user['tipo'] == 3 || $user['tipo'] == 2){
  header("Location: ../index.php");
}

include '../components/header.php';
include '../components/navbar.php';

$query = "SELECT * FROM usuarios";
  $resultado = $db->query($query);

?>

<style>
  .titulo{
    font-size: 35px;
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: center;
  }

    .pedidos{
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
      margin-bottom: 20px;
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
</style>

<div>
  <div class="titulo">
    Lista de usuarios
  </div>
  <div class="pedidos">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Foto</th>
          <th scope="col">Nome</th>
          <th scope="col">Email</th>
          <th scope="col">Telefone</th>
          <th scope="col">Empresa</th>
        </tr>
      </thead>
      <tbody>
<?php foreach($resultado as $user){ ?>
        <tr>
          <th scope="row"><?php echo $user['id']; ?></th>
          <td><img src="<?php echo $user['foto']; ?>" width="35px"></td>
          <td><?php echo $user['nome']; ?></td>
          <td><?php echo $user['email']; ?></td>
          <td><?php echo $user['telefone']; ?></td>
          <td><?php echo $user['empresa']; ?></td>
        </tr>
  <?php } ?>
      </tbody>
    </table>
    
  </div>
</div>

<?php include '../components/footer.php'; ?>