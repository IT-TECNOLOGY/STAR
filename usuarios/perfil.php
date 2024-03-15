<?php
include '../conexao/conexao.php';
if (!isset($_SESSION['userID'])) {
  header("Location: ../index.php");
}
include '../components/header.php';
include '../components/navbar.php';


$queryUser = "SELECT * FROM usuarios WHERE id = ".$_SESSION['userID'];
$resultUser = $db->query($queryUser);

$user = $resultUser->fetch_assoc();

$queryServ = "SELECT * FROM produtos WHERE idCliente = ".$_SESSION['userID'];
$resultServ = $db->query($queryServ);

$serv = $resultServ->fetch_assoc();
?>

    <title>Perfil - <?php echo $user['nome']; ?></title>
</head>

<style>
  .dds{
    padding: 20px;
  }

  .dds input, .dds textarea{
    margin: 10px;
    padding: 10px;
    border-radius: 20px;
    font-size: 20px;
  }

  .dds input, .dds h3, .dds textarea{
    margin-left: 20px;
  }

@media(max-width: 500px){
  #dadosPessoais{
    flex-direction: column;
  }
}

#dadosPessoais input, #dadosPessoais textarea{
  color: darkorange;
}
</style>

<div style="display: flex; justify-content: center; align-items: center; background-color: black; color: orange;">
  <img src="../fotos/<?php echo $user['foto']; ?>" style="width: 80px; height: 80px; border-radius: 50px; border: 3px solid black;">
    <h1><?php echo $user['nome']; ?></h1>
    </div>
    <div style="background-color: black; color: orange;">
        <ul class="nav nav-tabs">
            <li class="nav-item dados">
                <a class="nav-link active" data-bs-toggle="tab" href="#dadosPessoais">Dados Pessoais</a>
            </li>
            <li class="nav-item config">
                <a class="nav-link" data-bs-toggle="tab" href="#configuracoes">Configurações</a>
            </li>
        </ul>
      <div>
        <div id="dadosPessoais" class="tab-pane fade show active flex-container" style="display: flex">
            <div class="dds container">
              <h2>Dados Pessoais</h2>
              <h3>Nome:</h3>
              <input type="text" value="<?php echo $user['nome']; ?>" disabled>
              <h3>Email:</h3>
              <input type="email" value="<?php echo $user['email']; ?>" disabled>
              <h3>Telefone:</h3>
              <input type="tel" value="<?php echo $user['telefone']; ?>" disabled>
              <h3>Data de Nascimento:</h3>
              <input type="date" value="<?php echo $user['dataN']; ?>" disabled>
              <h3>Empresa:</h3>
              <input type="text" value="<?php echo $user['empresa']; ?>" disabled>
            </div>
          <div class="dds container">
            <?php
$numRows = $resultServ->num_rows;
if($numRows > 0){
?>
            <h2><?php echo $serv['servico']; ?> contatado</h2>
            <h3>Nome do <?php echo $serv['servico']; ?>:</h3>
            <input type="text" value="<?php echo $serv['nome']; ?>" disabled>
            <h3>Tipo</h3>
            <input type="text" value="<?php echo $serv['servico']; ?>" disabled>
            <h3>Design</h3>
            <textarea class="form-control" style="height: auto; margin: 10px;" rows="3" disabled><?php echo $serv['design']; ?></textarea>
            <h3>Funcionamento</h3>
            <input type="text" value="<?php echo $serv['func']; ?>" disabled>
            <?php
}else{
  ?>
  <h2>Nenhum serviço contratado</h2>
  <?php } ?>
          </div>
        </div>
        <div id="configuracoes" class="tab-pane fade" style="display: none;">
          <form action="../conexao/updatePerfil.php" method="POST" enctype="multipart/form-data">
              <div class="dds container">
                <h2>Alterar informações</h2>
                <h3>Nome:</h3>
                <input type="text" value="<?php echo $user['nome']; ?>" name="nome">
                <h3>Email:</h3>
                <input type="email" style="color: orange;" value="<?php echo $user['email']; ?>" disabled>
                <h3>Telefone:</h3>
                <input type="tel" value="<?php echo $user['telefone']; ?>" name="tel">
                <h3>Data de Nascimento:</h3>
              <p>Caso não precise alterar, pode deixar vázio</p>
                <input type="date" value="<?php echo $user['dataN']; ?>" name="data">
                <h3>Empresa:</h3>
                <input type="text" value="<?php echo $user['empresa']; ?>" name="empresa">
                <h3>Foto:</h3>
                <input id="foto" type="file" name="imagem" style="width: 90%;" class="form-control" onchange="mostraFT(this)"></br>
                <div id="mostraFT"></div>
                <script>
                function mostraFT(input) {
                    var file = input.files[0];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#mostraFT').html('<img src="' + e.target.result + '" style="width: 35%;">');
                        };

                        reader.readAsDataURL(file);
                    } else {
                        $('#mostraFT').html('');
                    }
                }
                </script>
                <button class="btn" style="color: orange;">Enviar</button>
              </div> 
            </form>
        </div>
    </div>
      <script>
        $('.dados').click(function(){
          $('#dadosPessoais').css('display', 'flex');
          $('#configuracoes').css('display', 'none');
        });

        $('.config').click(function(){
          $('#configuracoes').css('display', 'flex');
          $('#dadosPessoais').css('display', 'none');
        });
        </script>
      
<?php include '../components/footer.php'; ?>