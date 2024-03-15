<?php
include './conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de que o ID foi passado na solicitação
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Evite possíveis problemas de segurança usando prepared statements
        $query = "UPDATE notificacao SET mensagem = 'sim' WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);

        // Execute a atualização
        if ($stmt->execute()) {
            echo "Atualização bem-sucedida!";
        } else {
            echo "Erro ao atualizar a notificação.";
        }

        $stmt->close();
    } else {
        echo "ID não fornecido na solicitação.";
    }
} else {
    echo "Método de solicitação não suportado.";
}
?>
