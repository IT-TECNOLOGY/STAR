<?php
include './conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['mensagem']) && isset($_POST['destinatario'])) {
    $remetente = $_SESSION['userID'];
    $destinatario = $_POST['destinatario'];
    $mensagem = $_POST['mensagem'];

    // Inserir a mensagem na tabela "conversa"
    $query = "INSERT INTO conversa (remetente, destinatario, mensagem, data) VALUES (?, ?, ?, NOW())";

    if ($stmt = $db->prepare($query)) {
      $stmt->bind_param("iis", $remetente, $destinatario, $mensagem);
      $stmt->execute();
      $stmt->close();

      // Retorne a mensagem para exibição na interface, se desejar
      echo $mensagem;
    } else {
      // Lide com erros, se houver algum problema na inserção
      echo "Erro ao enviar a mensagem.";
    }
  } else {
    // Lide com entradas ausentes ou inválidas
    echo "Parâmetros de entrada inválidos.";
  }
} else {
  // Lide com outros tipos de solicitações (por exemplo, GET)
  echo "Método de solicitação não suportado.";
}
?>