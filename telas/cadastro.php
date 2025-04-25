<?php
include("conexao.php");

// Validações básicas
if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
    die("Preencha todos os campos!");
}

$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = trim($_POST['senha']);

// Verifica se email já existe
$check = $conn->prepare("SELECT id FROM cadastro WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("Email já cadastrado!");
}

// Insere sem hash (APENAS PARA TESTES)
$stmt = $conn->prepare("INSERT INTO cadastro (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {
    header("Location: login.php?sucesso=1");
    exit();
} else {
    die("Erro no cadastro: " . $conn->error);
}
?>