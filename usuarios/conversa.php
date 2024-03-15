<style>
  .chat{
    width: 300px;
    background-color: lightblue;
    border-radius: 10px 10px 0px 0px;
    padding: 5px;
  }

    .chatIn{
      height: 0px;
      width: 100%;
      border: 2px solid black;
      background-color: black;
      transition: all 0.3s;
      display: none;
    }

    .chatBox{
      flex-direction: column;
      align-items: flex-end;
      border-radius: 10px;
      background-color: white;
    }

  .convBox{
    font-size: 16px;
    padding: 5px;
  }

  .convBox div{
    border: 3px solid blue;
    border-radius: 20px;
    color: orange;
    font-weight: 600;
    width: 75% !important;
    padding: 10px;
  }

  .userlist{
    height: auto;
    transition: all 0.3s;
  }
</style>

<div class="dropdown chatB">
  <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-chat-dots" style="font-size: 25px; color: cornflowerblue;"></i>
  </button>

  <?php
$query = "SELECT * FROM usuarios WHERE id = ".$_SESSION['userID'];
$resultado = $db->query($query);
$user = $resultado->fetch_assoc();

if($user['tipo'] == 3){
$queryUser = "SELECT * FROM usuarios WHERE tipo != 3";
}else if($user['tipo'] != 3){
$queryUser = "SELECT * FROM usuarios WHERE tipo != ".$user['tipo'];
}
$resulUser = $db->query($queryUser);

?>

  <div class="dropdown-menu chatBox">
  <div class="chat">Chat</div>
    <div class="overflow-scroll userlist">
    <?php foreach($resulUser as $row){ ?>
    <div class="users btn" id="user<?php echo $row['id']; ?>" style="width: 100%; text-align: left;">
        <input disabled hidden id="remetenteInput<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                                      <img src="<?php echo $row['foto'] ?>" style="width: 40px;">
      <?php echo $row['nome']; ?>
</div>
                                      <?php } ?>
    </div>
    <div class="mostraPerfil" style="display: flex;">
<i class="bi bi-arrow-90deg-up vt" style="
  cursor: pointer;
  margin: 10px;
  font-size: 22px;
  border: 2px solid;
  width: 30px;
  border-radius: 10px;
  text-align: center;"></i>
      <div>
      </div>
    </div>
  <div class="chatIn">
  </div>
    <div style="
      width: 300px;
      display: flex;
      justify-content: center;">
      <div style="
width: 90%;
border: 2px solid;
border-radius: 30px;
display: flex;
align-items: center;">
        <input type="text" name="msg" id="mensagem" style="
width: 83%;
height: 100%;
border: 0px;
border-radius: 30px 0px 0px 30px;">
        <button class="btn" style="
border-radius: 0px 30px 30px 0px;
width: 40px;
height: 40px;
padding: 2%;" id="enviar"><i class="bi bi-send-fill"></i></button>
      </div>
    </div>
      </div>
  <input disabled hidden id="remetente">

</div>

<script>

  // Impedir que o dropdown seja fechado quando você clica dentro dele
  $('.chatBox').click(function (event) {
    event.stopPropagation();
  });

  $(".chatB").on("shown.bs.dropdown", function () {
    // Inicie a função atualizarMensagens quando o dropdown é mostrado
    atualizarMensagens();
  });
  // Evento de clique no botão "enviar mensagem"
  var destinatarioID = null;

  <?php foreach($resulUser as $row2){ ?>
  $('#user<?php echo $row2['id']; ?>').click(function () {
    destinatarioID = $('#remetenteInput<?php echo $row2['id']; ?>').val();
    $('#remetente').val(destinatarioID);
    $('.mostraPerfil div').html('<img src="<?php echo $row2['foto']; ?>" style="width: 40px; margin: 5px;"><?php echo $row2['nome']; ?>');
    $('.chatIn').css('height', '300px');
    $('.userlist').css('height', '0px');
    $('.chatIn').css('display', 'block');
    $('.vt').css('display', 'block');
    atualizarMensagens();
  });
  <?php } ?>

  $('.vt').click(function(){
    $('.userlist').css('height', '300px');
    $('.chatIn').css('height', '0px');
    $('.chatIn').css('display', 'none');
    $('.vt').css('display', 'none');
  });
 
  $("#enviar").click(function() {
    var mensagem = $("#mensagem").val();
    if (destinatarioID !== null) {
      $.ajax({
        type: "POST",
        url: "../enviar_mensagem.php",
        data: { mensagem: mensagem, destinatario: destinatarioID },
        success: function(response) {
          $("#mensagem").val(""); // Limpe a caixa de entrada
          $(".chatIn").append(response); // Adicione a mensagem à interface
        }
      });
    } else {
      console.log("Nenhum destinatário selecionado.");
    }
  });

      var remetenteID = <?php echo $_SESSION['userID']; ?>;

  function atualizarMensagens() {
      $.ajax({
        type: "POST",
        url: "../recuperar_mensagens.php",
        data: { destinatario: destinatarioID, remetente: remetenteID },
        dataType: 'json', // Indica que você está esperando um JSON como resposta
        success: function(response) {
          if(response.mensagens != ''){
          $(".chatIn").html(response.mensagens); // Atualize a interface com as mensagens
          // Use a variável response.remetente conforme necessário
            }else{
            $(".chatIn").html('<div class="text-center" style="color: white;">Nenhuma mensagem encontrada.</div>');
            }
          $("#remetenteInput").val(response.remetente); // Coloque o remetente em algum lugar, como em um input
        }
      });
  }

  setInterval(atualizarMensagens(), 1000);
</script>