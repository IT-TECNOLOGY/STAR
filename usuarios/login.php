<?php
include '../conexao/conexao.php';


if (isset($_SESSION['userID'])) {
  header("Location: ../index.php");
}

include '../components/header.php'; ?>
<title>STAR - Cadastro</title>
</head>
<?php include '../components/navbar.php'; ?>

<?php

  
if (isset($_GET['erro'])) {
    $msg = $_GET['erro'];
} else {
  $msg = '';
}
?>

<style>
  #perfil {
    display: none;
  }

  #login,
  #cad {
    border-radius: 20px;
    width: auto;
    height: 300px;
    padding: 3%;
  }

  #cad {
    display: flex;
    align-items: center;
  }

  #cad .btn {
    width: 230px;
    height: 100px;
    font-size: 30px;
    color: darkorange;
    font-weight: 900;
  }

  #Lbox {
    color: lightcoral;
    background-color: black;
    border-radius: 20px;
    display: flex;
    justify-content: space-between;
    flex-direction: row;
    box-shadow: 0px 0px 15px 1px;
  }

  .input {
    color: floralwhite;
    width: 250px;
    height: 40px;
    border-radius: 50px;
    padding-left: 5px;
    border: 5px solid orange;
    background-color: black;
  }

  #voltar,
  #entrar {
    margin: 10px;
  }

  #entrar {
    transform: rotateY(90deg);
    transition: all 0.3s;
  }

  #anim {
    display: flex;
    align-items: center;
  }

  #anim #msg {
    font-size: 25px;
  }

  @media (max-width: 500px) {
    #Lbox {
      flex-direction: column;
    }

    #anim {
      justify-content: center;
    }

    #cad {
      justify-content: center;
    }
  }
</style>
<center>
  <div id="loginBox" style="padding: 4% 12%;">
    <div id="Lbox">
      <div id="login">
        <form action="../conexao/validacao.php" method="POST">
        <label style="font-size: 24px;">Digite seu email e sua senha</label>
        <div>
          <label>Email:</label></br>
          <input class="input" type="email" name="email" placeholder="Digite seu email" id="email"></br>
          <label>Senha:</label></br>
          <input class="input" type="password" name="senha" maxlength="8" placeholder="Digite sua senha" id="senha"></br>
          <div>
            <button class="btn btn-warning" id="voltar" type="button">Voltar</button>
            <button class="btn btn-success" id="entrar">Entrar</button>
          </div>
        </div>
            </form>
      </div>
      <div id="anim">
        <p id="msg"></p>
      </div>

      <!-- Cadastro-->

<style>
  .modal-content form input {
      border-radius: 20px;
      border: 3px solid orange !important;
      background: none;
      color: orange;
  }

  .modal-content {
      color: cornsilk;
    background: none !important;
      font-weight: 600;
      font-size: 20px;
  }
  </style>
      
      <div id="cad">
        <button id="cadbtn" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">SIGN IN</button>
      </div>
    </div>
  </div>

  <style>
    #cadBox input {
      border-top: 0px;
      border-left: 0px;
      border-right: 0px;
      border-bottom: 0px;
      width: 0px;
      height: 50px;
      font-size: 16px;
      transition: all 0.5s;
      border-bottom: 2px solid mediumblue;
    }
  </style>
  <!-- Modal -->
  <div class="modal" style="backdrop-filter: blur(2px);" fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="../conexao/addUser.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container" id="cadBox">
          Escolha a foto de perfil:</br>
          <div id="mostraFT"></div>
          <input type="file" name="imagem" class="form-control" style="border: none !important; height: auto;" onchange="mostraFT(this)"></br>
          <script>
          function mostraFT(input) {
              var file = input.files[0];

              if (file) {
                  var reader = new FileReader();

                  reader.onload = function(e) {
                      $('#mostraFT').html('<img src="' + e.target.result + '" style="width: 25%;">');
                  };

                  reader.readAsDataURL(file);
              } else {
                  $('#mostraFT').html('');
              }
          }
          </script>
          <label>Nome:</label></br>
          <input type="text" name="nome" id="nome2" placeholder="Digite seu nome"></br>
          <label>Email:</label></br>
          <input type="email" name="email" id="email2" placeholder="Digite seu e-mail"></br>
          <label>Crie uma senha:</label></br>
          <input type="password" name="senha" id="senha2" maxlength="8" placeholder="Digite sua senha"></br>
          <label>Confirme sua senha:</label></br>
          <input type="password" name="Csenha" id="Csenha" maxlength="8" placeholder="Confirme sua senha"></br>
          <label>Telefone:</label></br>
          <input type="tel" name="tel" id="tel" placeholder="Digite seu telefone"></br>
          <label>Data de nascimento:</label></br>
          <input type="date" name="dataN" id="dataN" placeholder="Digite sua data de nascimento"></br>
          <label>Nome da sua empresa</label></br>
          <input type="text" name="empresa" id="empresa" placeholder="Diga-nos qual é a sua empresa"></br>
          <p id="aviso" style="color: red"></p>
          <input type="button" id="verifica" value="Varificar" class="btn btn-secondary" style="margin: 10px;">
        </div>
        <div class="modal-footer">
          <input class="btn btn-secondary" data-bs-dismiss="modal" value="Voltar">
          <input id="cadBtn" type="submit" style="display: none" class="btn btn-success" value="Cadastrar">
        </div>
</form>
      </div>
    </div>
  </div>

</center>

<script>

  $('#verifica').click(function(){
    var nome = $('#nome2').val();
    var email = $('#email2').val();
    var senha = $('#senha2').val();
    var Csenha = $('#Csenha').val();
    var tel = $('#tel').val();
    var nasc = $('#nasc').val();
    var empresa = $('#empresa').val();
    if(nome == '' || email == '' || senha == '' || Csenha == '' || tel == '' || nasc == '' || empresa == ''){
      $('#aviso').html('Preencha todos os campos');
    }else if(senha != Csenha){
      $('#aviso').html('As senhas não conferem');
    }else if(senha.length < 8){
      $('#aviso').html('A senha deve ter no mínimo 8 caracteres');
    }else{
      $('#cadBtn').css('display', 'block');
    }
  });

  $('#cadbtn').click(function () {
      $('#cadBox input').delay(500).queue(function (next) {
          $(this).animate({ width: '350px' }, 200); // 500ms de duração da animação
          next();
      });
  });

  function animateText(texts, index) {
    if (index < texts.length) {
      var text = texts[index];
      var speed = 100;
      var currentText = "";
      var targetElement = $('#msg');

      function writeText(innerIndex) {
        if (innerIndex < text.length) {
          currentText += text[innerIndex];
          targetElement.text(currentText);
          if (index === texts.length - 1) {
            targetElement.css('font-weight', 'bold');
            targetElement.css('font-size', '30px');
          } else {
            targetElement.css('font-weight', 'normal');
            targetElement.css('font-size', '25px');
          }
          setTimeout(function() {
            writeText(innerIndex + 1);
          }, speed);
        } else {
          setTimeout(function() {
            targetElement.empty();
            animateText(texts, (index + 1) % texts.length); // Próximo índice, com loop
          }, 1000); // Aguarde 1 segundo entre animações
        }
      }

      writeText(0);
    }
  }

  var texts = ["Faça seu cadastro", "Aqui nos inovamos juntos", "Venha ser um STAR"];
  animateText(texts, 0);

  function checkPasswordLength() {
    var senha = $('#senha').val();
    var email = $('#email').val();

    if (senha.length == 8 && email != '') {
      $('#entrar').css('transform', 'rotateY(0deg)');
    } else {
      $('#entrar').css('transform', 'rotateY(90deg)');
    }
  }

  // Execute a verificação de senha a cada 500 milissegundos (0,5 segundos)
  setInterval(checkPasswordLength, 500);
</script>

<?php include '../components/footer.php'; ?>