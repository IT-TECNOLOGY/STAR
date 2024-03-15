<?php
include './conexao.php'; // Inclua o arquivo de conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receba os dados do formulário
    $username = $_POST['email'];
    $password = $_POST['senha'];

    // Valide os dados
    if (empty($username) || empty($password)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Consulta SQL para verificar as credenciais
        $query = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

      if ($result->num_rows === 1) {
          // As credenciais são válidas, o usuário pode entrar
          if (!isset($_SESSION)) {
              session_start();
          }

          $user = $result->fetch_assoc(); // Recupere a linha de dados do usuário
          $_SESSION['userID'] = $user['id']; // Armazene o ID do usuário em uma sessão

          header('Location: ../index.php'); // Redirecione para a área restrita
      } else {
          echo "Credenciais inválidas. Por favor, tente novamente.";
      }
    }
}
?>