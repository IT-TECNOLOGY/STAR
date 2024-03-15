<?php
include './conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['destinatario'])) {
    $destinatario = $_POST['destinatario'];

    // Recupere os perfis das pessoas na conversa
    $query = "SELECT nome FROM usuarios WHERE id = ?"; // Substitua "usuarios" pelo nome da sua tabela de usuários

    $perfis = "";

    // Preparar e executar a consulta
    if ($stmt = $db->prepare($query)) {
      $stmt->bind_param("i", $destinatario);
      $stmt->execute();
      $stmt->bind_result($nome);

      while ($stmt->fetch()) {
        $perfis .= '<div>' . $nome . '</div>';
      }

      $stmt->close();

      // Retorne os perfis para exibição na interface
      echo $perfis;
    } else {
      // Lide com erros, se houver algum problema na consulta
      echo "Erro ao recuperar perfis.";
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
