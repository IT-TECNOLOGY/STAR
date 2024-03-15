<?php
include './conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['destinatario']) && isset($_POST['remetente'])) {
  $remetente = $_POST['remetente'];
  $destinatario = $_POST['destinatario'];

    // Recuperar as mensagens da tabela "conversa"
    $query = "SELECT remetente, mensagem FROM conversa WHERE (remetente = ? AND destinatario = ?) OR (remetente = ? AND destinatario = ?) ORDER BY data";

    if ($stmt = $db->prepare($query)) {
      $stmt->bind_param("iiii", $remetente, $destinatario, $destinatario, $remetente);
      $stmt->execute();
      $stmt->bind_result($mensagemRemetente, $mensagem);
      
      // Construa uma string com as mensagens
      $mensagens = "";

      // $query2 = "SELECT foto FROM usuarios WHERE id = ?";
      // $stmt2 = $db->prepare($query2);
      // $stmt2->bind_param("i", $remetente);
      // $stmt2->execute();
      // $stmt2->bind_result($foto1);

      // $query3 = "SELECT foto FROM usuarios WHERE id = ?";
      // $stmt3 = $db->prepare($query3);
      // $stmt3->bind_param("i", $destinatario);
      // $stmt3->execute();
      // $stmt3->bind_result($foto2);

      // $fotoR = '<img src="'.$foto1.'" width="70px;">';
      // $fotoD = '<img src="'.$foto2.'" width="70px;">';
      

      while ($stmt->fetch()) {
        $display = ($mensagemRemetente == $remetente) ? "flex-end" : "flex-start";
        //$foto = ($mensagemRemetente == $remetente) ? $fotoR : $fotoD;
        $mensagens .= '<div class="convBox" style="display: flex; justify-content: ' . $display . '; width: 100%;"><div >' . $mensagem .'</div></div>' . "<br>";
      }

      $stmt->close();

      // Retorne as mensagens para exibição na interface
      echo json_encode(array('mensagens' => $mensagens, 'remetente' => $remetente));
    } else {
      // Lide com erros, se houver algum problema na consulta
      echo "Erro ao recuperar as mensagens.";
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
