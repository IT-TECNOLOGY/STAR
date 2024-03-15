<?php
include '../conexao/conexao.php';

include '../components/header.php'; ?>
<title>STAR - Inicio</title>
</head>
<?php include '../components/navbar.php';

if (!isset($_SESSION['userID'])) {
  header("Location: ../index.php");
}

?>

<style>

  #contratarBtn{
    display: none;
  }
  
  .titulo{
    padding: 3%;
  }

  .mb-3 {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    padding: 3%;
    width: 50%;
  }

  .mb-3 label{
    margin: 2%;
    font-weight: bold;
  }

  @media(max-width: 500px){
    #contratarBox{
      width: 100% !important;
    }
  }
</style>

<div class="contBox">

  <div class="titulo text-center">

    <h2>Cadastre aqui as informações do serviço que deseja</h2>
    
  </div>

  <div>

    <form action="addProd.php" method="post">

      <div class="mb-3" id="contratarBox">

        <div class="dropdown">
          <input id="servico" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" value="Escolha o tipo de serviço">
          <input type="hidden" id="tipoServico" name="servico" value="">
          <ul class="dropdown-menu">
            <li><input class="btn sistema" value="Sistema" readonly></li>
            <li><input class="btn site" value="Site" readonly></li>
          </ul>
        </div>

        <input readonly hidden value="<?php echo $_SESSION['userID']; ?>" name="idCliente">
        
        <label for="nome" class="form-label">Nome do <l>...</l>:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">

        <label for="descricao" class="form-label">Objetivo do <l>...</l>:</label>
        <textarea class="form-control" id="objetivo" name="objetivo" rows="3"></textarea>
        <label for="descricao" class="form-label">Design:</label>
        <textarea class="form-control" id="desgin" name="design" rows="3"></textarea>
        <label for="descricao" class="form-label">Funcionamento:</label>
        <textarea class="form-control" id="func" name="func" rows="3"></textarea>

        A descrição não tem limites, descreva com detalhes o funcionamento e o design do site, sistema ou serviço que tem em mente. Que iremos ilustrar o mais rápido possível.

        <button class="btn btn-success" style="width: 100px;">Enviar</button>
  </div>
  </form>
  
</div>

  <script>
    $(document).ready(function() {
      $('.sistema').click(function() {
        $('#tipoServico').val('Sistema');
        $('#servico').val('Sistema');
      });
      $('.site').click(function() {
        $('#tipoServico').val('Site');
        $('#servico').val('Site');
      });
    });
  </script>

<?php include '../components/footer.php'; ?>
