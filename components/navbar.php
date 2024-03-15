<style>
  .parallax {
    height: 1000px;
    background-color: white;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;

    @media(max-width: 1000px) {
      #inicio {
        width: 80px;
      }
    }

    @media(min-width: 500px) {
      .form {
        margin-left: 50%;
        margin-right: 0px;
      }
    }

    #contratarBtn {
      width: 150px;
      padding: 12px;
    }

  #contratarBtn, #usersBtn, #pedidosBtn{
    font-weight: bold;
    font-size: 19px;
    color: darkorange;
  }

  }

  .notif {
    display: flex;
  }

  #nav{
    background-color: black;
    color: orange;
  }
</style>

<?php

if (isset($_SESSION['userID'])) {
  $query = "SELECT * FROM usuarios WHERE id = " . $_SESSION['userID'];
  $resultado = $db->query($query);

  $user = $resultado->fetch_assoc();
  // Resto do código
}

?>

<body class="parallax" style="background-position-y: 0px; display: contents;">
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding: 0px;">
    <div class="container-fluid" id="nav">
      <a href="../index.php">
        <img src="../images/STARlogo.png" style="width: 70px; margin: 20px; background-color: white; border-radius: 100px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon bg-white" style="border-radius: 5px;"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="display: flex; align-items: center; justify-content: center;">
          <li class="nav-item form" style="margin-right: 10px;">
            <form style="border-radius: 30px; border: 4px solid orange;" class="d-flex" role="search" method="GET">
              <input id="pesquisa" class="btn" type="search" placeholder="Pesquisar na página" aria-label="Search" name="busca">
              <button class="btn" type="submit" style="border-radius: 0px 20px 20px 0px;
              background-color: white;
              "><img style="width: 20px;" src="../images/search.svg"></button>
            </form>
          </li>
          <li>
            <?php if (isset($_SESSION['userID'])) { ?>
          <li>
            <a href="../usuarios/contratar.php">
              <button class="btn" id="contratarBtn">
                Contratar Serviço
              </button>
            </a>
          </li>

            <li>
              <a href="../produtos/listaPedidos.php">
                <button class="btn" id="pedidosBtn">
                  Pedidos
                </button>
              </a>
            </li>
          <?php if ($user['tipo'] == 1) { ?>
            <li>
              <a href="../usuarios/usuarios.php">
                <button class="btn" id="usersBtn">
                  Usuarios
                </button>
              </a>
            </li>

          <?php } ?>
  <?php
                                                   $current_file = $_SERVER["PHP_SELF"];
                                                   
                                                   if($user['tipo'] == 3){  ?>
                                         <li class="chatB1" style="display: none">
                                               <?php include '../usuarios/conversa.php'; ?>
                                         </li>
                                                   <?php }else{ ?>
                                         <li class="chatB1" style="display: block">
     <?php if($current_file == "/index.php"){ ?>
                                               <?php include './usuarios/conversa.php'; ?>
                                            <?php }else{ ?>
                                               <?php include '../usuarios/conversa.php'; ?>
                                                        <?php } ?>
                                         </li>

                                                               <?php
                                                               
                                                              }
                                                               ?>
<li style="display: flex;">
          <!-- dropdown do notificações -->
          <?php
              $queryNot = "SELECT * FROM notificacao WHERE idCliente = " . $_SESSION['userID'] . " ORDER BY data";

              $resultadoNot = $db->query($queryNot);

          ?>
          <div class="dropdown">
            <button class="btn notif dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <p></p><l><i class="bi bi-bell" style="font-size: 25px; color: cornflowerblue;"></i></l>
            </button>
            <ul class="dropdown-menu" style="width: 300px; padding: 10px;">
              <div class="text-center">
                <p>Notificações</p>
              </div>
              <?php
              if ($resultadoNot->num_rows > 0) {
                foreach ($resultadoNot as $not) { ?>
                  <li><?php echo $not['mensagem'] ?></li>
              <?php }
              } else {
                echo "<li>Nenhuma notificação</li>";
              } ?>
            </ul>
          </div>
  
         <script>
           $(document).ready(function () {
             // Função para verificar notificações
             function verificarNotificacoes() {
               $.ajax({
                 type: "POST",
                 url: "contarN.php",
                 success: function (data) {
                   // Atualize o conteúdo do botão de notificação com o número de novas notificações
                   $(".notif p").text(data.total);
                   // Verifique se a notificação foi checada ou não
                   if (data.checado == "sim") {
                     $('.notif l').html('<i class="bi bi-bell-fill" style="font-size: 25px;"></i>');
                   } else {
                     $('.notif l').html('<i class="bi bi-bell" style="font-size: 25px;"></i>');
                   }
                 },
                 error: function () {
                   console.error("Erro ao verificar notificações.");
                 }
               });
             }

             // Verifique notificações a cada 1 segundos (1000 milissegundos)
             setInterval(verificarNotificacoes, 1000);
           });
         </script>
                                                   
          <!-- dropdown do perfil de usuario -->
          <div class="dropdown" id="perfil" style="
            margin-right: 30px;
            display: flex;
            align-items: center;">
            <img src="../fotos/<?php echo $user['foto']; ?>" style="
              border-radius: 100px;
              width: 54px;
              height: 54px;
              margin: 10px;
              border: 4px solid orange;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $user['nome']; ?>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../usuarios/perfil.php">Perfil</a></li>
              <li><a class="dropdown-item" href="../conexao/logout.php">Sair</a></li>
            </ul>
          </div>
        <?php
            } else { ?>
          <a href="../usuarios/login.php">
            <button class="btn" style="
              width: 110px;
              padding: 13px;
              font-size: 23px;
              font-weight: 900;
              color: orange;">LOG IN</button></a>
        <?php } ?>

        </li>
        </ul>

        <style>
          #pesquisa {
            width: 250px;
            /* Largura inicial do campo de pesquisa */
            border-radius: 20px 0px 0px 20px;
            background-color: white;
            text-align: left;
            cursor: text;
            color: black;
            transition: all 0.6s;
            margin-right: 0px !important;

          }
        </style>
      </div>
    </div>
  </nav>

<script>
  $(document).ready(function(){
    $(".notif").click(function(){
      var userID = <?php echo $_SESSION['userID']; ?>;
      $.ajax({
        type: "GET",
        url: "checar.php",
        data: { id: userID },
        success: function(data){
          
        },
        error: function(){
          console.error("Não foi possivel abrir as notificações");
        }
      });
    });
  });
</script>