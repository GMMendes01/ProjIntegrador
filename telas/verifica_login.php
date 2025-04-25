<?php
session_start();
require_once 'conexao.php';

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header("Location: login.php?erro=1"); // Campos obrigatórios
    exit();
}

$email = trim($_POST['email']);
$senha = trim($_POST['senha']);

// Consulta simplificada sem hash
$sql = "SELECT id, nome, email FROM cadastro WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $usuario = $result->fetch_assoc();
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    header("Location: index.php");
    exit();
}

header("Location: login.php?erro=2"); // Credenciais inválidas
exit();
?>