<?php
include './conexao.php';

if (!isset($_SESSION['userID'])) {
  header("Location: ./index.php");
}

include './header.php'; ?>
<title>STAR - Chat de suporte</title>
</head>
<?php include './navbar.php'; ?>

<style>
  #fullBox,
  #users,
  #chat {
    border-radius: 20px;
    border: 2px solid black;
    margin: 10px;
    padding: 10px;
    height: 90%;
  }

  #fullBox {
    display: flex;
    background-color: aliceblue;
  }

  #users {
    width: 30%;
  }

  #chat {
    width: 70%;
  }

  #users, #chat{
    background-color: #b2ffc9;
  }

  #titulo {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .user {
    height: 70px;
    border-radius: 20px;
    align-items: center;
    display: flex;
    padding: 2%;
    box-shadow: 0px 0px 3px 0px;
    margin: 1%;
    cursor: pointer;
    background-color: white;
  }

  .chatBox{
    height: 85%;
  }
  .ChaTools{
    height: 13%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .ChaTools, .chatBox, #caixa{
    width: 100%;
    border: 2px solid black;
    border-radius: 20px;
    margin-bottom: 10px;
    display: none;
  }

  .chatInput{
    width: 500px;
    height: 55px;
    margin: 15px;
    border-radius: 100px;
    padding-left: 10px;
    border: 2px solid black;
    display: flex;
    align-content: center;
  }

  .chatInput input{
    border-radius: 100px 0px 0px 100px;
    width: 90%;
    border: none;
    cursor: text;
    text-align: inherit;
  }
  .chatInput button{
    border-radius: 0px 100px 100px 0px;
    width: 55px;
    border: none;
    background-color: #5dff5d;
  }

  .msg{
    border: 2px solid black;
    margin: 10px;
    border-radius: 20px;
    padding: 5px;
    width: 50%;
  }

  .msg-remetente {
    text-align: right; /* Alinha mensagens do remetente à direita */
    /* Adicione outros estilos desejados */
  }

  .msg-destinatario {
    text-align: left; /* Alinha mensagens do destinatário à esquerda */
    /* Adicione outros estilos desejados */
  }

  #caixa{
    width: 100%;
    height: 100%;
    border: 2px solid black;
    border-radius: 20px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
  }

  #caixa p{
    box-shadow: 0px 0px 10px 0px;
    border-radius: 100px;
    margin: 236px;
    padding: 46px;
    background-color: white;
    font-family: inherit;
    font-size: 50px;
    font-weight: 600;
    text-align: center;
  }
  #perfil{
    display: none;
  }
</style>

<?php

if (isset($_SESSION['userID'])) {
  $query = "SELECT * FROM usuarios WHERE id = " . $_SESSION['userID'];
  $resultado = $db->query($query);

  foreach ($resultado as $linha) {
    if ($linha['tipo'] == 3) {
      $query2 = "SELECT * FROM usuarios WHERE tipo != 3";
    } else if ($linha['tipo'] == 2) {
      $query2 = "SELECT * FROM usuarios WHERE tipo != 2";
    } else if ($linha['tipo'] == 1) {
      $query2 = "SELECT * FROM usuarios WHERE tipo != 1";
    }
  }

  // Verifique se há resultados em $resultado2
  $resultado2 = $db->query($query2);

}

?>

<div id="titulo">
  <h3>
    Entre em contato a equipe para solicitar um sistema, suporte ou tirar dúvidas.
  </h3>
</div>

<div id="fullBox">
  <div id="users">
    <?php
  if ($resultado2->num_rows > 0) {
    foreach ($resultado2 as $linha2) {
      ?>
      <div class="user" id="user<?php echo $linha2['id']; ?>">
        <img src="./images/perfil.png" style="width: 50px; margin-right: 5px;">
        <?php echo $linha2['nome']; ?>
      </div>

      <script>
        $(document).ready(function() {
          $("#user<?php echo $linha2['id']; ?>").click(function() {
            // Outras ações que você deseja realizar ao clicar no usuário
            $('#caixa').css('display', 'none');
            $('.chatBox').hide();
          });
        });
      </script>

      <?php }
    } else {
      // Adicione uma mensagem caso não haja resultados
      ?>
      <div class="user btn">
        Nenhum usuário encontrado.
      </div>
    <?php }
    ?>
  </div>
  <div id="chat">
    <div id="caixa">
      <p>
        Bem-vindo a área de mensagem, selecione uma conversa para começar.
      </p>
    </div>
    <div id="perfil">
    </div>
    <div class="chatBox mensagem">

    </div>
    <div class="ChaTools">
      <div class="chatInput">
        <input class="btn" type="search" placeholder="Digite sua mensagem" id="mensagem-input">
        <button id="enviar-mensagem"><i class="bi bi-send" style="font-size: 30px;"></i></button>
      </div>
    </div>
  </div>
</div>

<script>
  // Declare destinatarioID como uma variável global
    var destinatarioID = null;
    var userSelecionado = null;
  $(document).ready(function() {

<?php foreach ($resultado2 as $linha3) { ?>
    $("#user<?php echo $linha3['id']; ?>").click(function() {
      userSelecionado = <?php echo $linha3['id']; ?>;
      destinatarioID = <?php echo $linha3['id']; ?>;
      // Agora você tem o ID do destinatário, que pode ser usado na solicitação AJAX
      console.log("Destinatário ID: " + destinatarioID);
      // Limpe as mensagens antigas
      $(".mensagem").html("");
      // Outras ações que você deseja realizar ao clicar no usuário
      $('#caixa').hide();
      $('.chatBox').show();
      $('.ChaTools').show();
      $('#perfil').show();

      // Atualize a div perfil com os nomes das pessoas na conversa
      atualizarPerfis(destinatarioID);
    });
    <?php } ?>
    // Evento de clique no botão "enviar mensagem"
    $("#enviar-mensagem").click(function() {
      var mensagem = $("#mensagem-input").val();
      if (destinatarioID !== null) {
        $.ajax({
          type: "POST",
          url: "enviar_mensagem.php",
          data: { mensagem: mensagem, destinatario: destinatarioID },
          success: function(response) {
            $("#mensagem-input").val(""); // Limpe a caixa de entrada
            $(".mensagem").append(response); // Adicione a mensagem à interface
          }
        });
      } else {
        console.log("Nenhum destinatário selecionado.");
      }
    });

    function atualizarMensagens() {
      if (destinatarioID !== null) {
        $.ajax({
          type: "POST",
          url: "recuperar_mensagens.php",
          data: { destinatario: destinatarioID },
          success: function(response) {
            $(".mensagem").html(response); // Atualize a interface com as mensagens
          }
        });
      } else {
        console.log("Nenhum destinatário selecionado.");
      }
    }

    function atualizarPerfis(destinatarioID) {
      // Recupere os perfis das pessoas na conversa
      $.ajax({
        type: "POST",
        url: "recuperar_perfis.php", // Substitua com o nome do arquivo PHP correto
        data: { destinatario: destinatarioID },
        success: function(response) {
          $("#perfil").html(response); // Atualize a div perfil com os nomes das pessoas
        }
      });
    }

    setInterval(atualizarMensagens, 1000);
  });

</script>

<?php include './footer.php'; ?>
