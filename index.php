<?php
include './conexao/conexao.php';

include './components/header.php'; ?>
<title>STAR - Inicio</title>
</head>
<?php include './components/navbar.php'; ?>

  <style>
    #bv, #star, #msg1, #box{
      display: none;
    }
    #bv {
      display: none;
      animation: scale 5s linear;
    }

    @keyframes scale {
      0% {
        transform: scale(1);
      }
      25% {
        transform: scale(1.2);
      }
      50% {
        transform: scale(1);
      }
      75% {
        transform: scale(1.2);
      }
      100% {
        transform: scale(1);
      }
    }

section{
  height: 500px;
}

    .parallax {
    /* The image used */
    background-image: url("./images/capa-linguagens-em-alta.jpg");
    }
    .parallax2 {
    /* The image used */
    background-image: url("./images/capa-dart.png");
    }
    .parallax3 {
    /* The image used */
    background-image: url("./images/4973553-web-programacao-isometrica-ilustracoes-web-programacao-conceito-linguagem-programacao-codigo-programa-big-data-processing-on-laptop-screen-vector-illustration-vetor.jpg");
    }
.parallax, .parallax2, .parallax3 {
  /* Set a specific height */
  min-height: 500px;
  height: 500px !important;

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  padding: 2%;
}
  </style>

<?php include './components/backup.php' ?>

<section class="parallax">
  <div style="padding: 0px 40px 0px 40px;">
    <div id="wpp" style="
      display: none;
      color: white;
      filter: drop-shadow(5px 5px 2px black);">
<a href="https://wa.me//5587991384872?text=Queria%20fazer%20um%20orçamento" class="btn">
  <img style="width: 60px;" src="./images/zap.png"">
</a>
  Entrar em contato pelo whatsapp
    </div>
    <div id="bv">
      <p class="text-center" style="
        color: white;
        font-size: 40px;">
        Bem vindo
      </p>
    </div>
    <div id="star" style="filter: drop-shadow(5px 5px 2px black);">
      <p><h1 style="color: white;">Laboratório STAR</h1><h5 style="color: lightgray;">(Laboratório de Sistemas Ricos em Tecnologia Avançada).</h5></p>
    </div>
    <div id="msg1" style="filter: drop-shadow(5px 5px 2px black);">
      <p style="text-align: right; color: white; margin-top: 30px; transition: all 1s;">
        A maior plataforma de desenvolvimento de todas.
      </p>
    </div>
  </div>
</section>

<section class="parallax2">
<div id="box">
    <div>
      
        <div style="display: flex;
          flex-direction: column;
          align-items: center;">

          <div style="color: white;">
            <h2>Sistemas</h2>
          </div>
  
          <style>
            p{
              font-size: 20px;
              padding: 3%;
              font-weight: 600;
            }
            
            button{
              transform-style: preserve-3d;
              transform: perspective(1000px);
            }

            .btn2{
              width: 200px;
              height: 350px;
              box-shadow: 0px 0px 20px;
              margin-right: 10px;
              background-color: black;
              margin-bottom: 20px;
              color: white;
              border-radius: 40px;
              transition: all 0.2s;
              margin: 30px;
              }

            .p1{
              font-size: 25px;
              transform: translateZ(80px);
            }

            @media(max-width: 500px){
              

              .btn2{
                width: 250px;
                height: 150px;
                display: flex;
                flex-direction: row;
                border-radius: 15px;
              }

      btn2 p i{
        font-size: 46px;
      }

              .p1{
                font-size: 16px;
              }
              
              .p2{
                font-size: 15px;
              }

              #cell{
                height: 450px !important;
                width: 200px !important;
              }

              #t1, #t2{
                font-size: 21px;
              }

              #lg{
                width: 130px !important;
              }
              
    }

            .btn2:hover{
              transform: scale(1.05);
              color: white !important;
            }
            
            </style>
          <!-- Full Business Manager -->
          
          <a href="https://fullbusinessmanager.000webhostapp.com/index.php" style="color: black;">
          <button class="btn btn2">
            <p class="p1">  
            Full Business Manager
              <p style="
                font-size: 51px;
                padding: 0px;
                color: orange;">FBM</p>
            </p>
            <p class="p2">  
             Sistema de gerenciamento empresarial completo.
            </p>
          </button>
          </a>
          
          <!-- Proximo sistema -->
        </div>
      
    </div>
      <script>
        

                       if(localStorage.msg){
                         $('#bv').delay(1000).fadeIn("slow");
                         $('#bv').delay(2000).fadeOut("slow");
                         $('#star').delay(3000).fadeIn("slow");
                         $('#msg1').delay(3500).fadeIn("slow");
                         $('#box').delay(4000).fadeIn("slow");
                       }else{
        // Use jQuery to delay and fadeIn #bv
        $('#bv').delay(3000).fadeIn("slow");
        $('#bv').delay(5000).fadeOut("slow");
        $('#star').delay(10000).fadeIn("slow");
        $('#msg1').delay(13000).fadeIn("slow");
        $('#box').delay(16000).fadeIn("slow");
                           localStorage.setItem("msg", JSON.stringify('enviada'));
                       }
      </script>
</div>
        </section>
<style>
  section div h2{
    color: white;
  }

  @media(max-width: 500px){
    .parallax3 div{
      width: 100% !important;
    }
  }

</style>
    <section class="parallax3">
        <div class="text-center">
          <h2>Quem somos</h2>
        </div>
        <div style="
          width: 50%;
          height: 420px;
          border-radius: 25px;
          backdrop-filter: blur(4px);
          background-color: #ffffff26;
          display: flex;
          ">
          <div style="
            text-align: justify;
            padding: 10px;
            font-size: x-large;
            color: orange;">
            Somos uma startup de desenvolvimento de sistemas para empresas que querem automatizar seus serviços e economizar tempo e dinheiro.
            </div>
          </div>
    </section>
    <?php include './components/footer.php'; ?>