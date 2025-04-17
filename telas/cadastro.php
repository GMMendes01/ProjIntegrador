<?php
include("conexao.php");

// Validação básica dos dados
if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
    die("Preencha todos os campos obrigatórios!");
}

// Limpeza e validação dos inputs
$nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
$sobrenome = mysqli_real_escape_string($conn, trim($_POST['sobrenome']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));

// Validação de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Formato de email inválido!");
}

// Verifica se email já existe
$check_email = mysqli_prepare($conn, "SELECT id FROM cadastro WHERE email = ?");
mysqli_stmt_bind_param($check_email, "s", $email);
mysqli_stmt_execute($check_email);
mysqli_stmt_store_result($check_email);

if (mysqli_stmt_num_rows($check_email) > 0) {
    die("Este email já está cadastrado!");
}

// Hash da senha
$senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Preparação da query com parâmetros seguros
$stmt = mysqli_prepare($conn, "INSERT INTO cadastro (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $nome, $sobrenome, $email, $senha_hash);

// Execução e tratamento de erros
if (mysqli_stmt_execute($stmt)) {
    session_start();
    $_SESSION['cadastro_sucesso'] = true;
    $_SESSION['nome_usuario'] = $nome;
    
    // Redirecionamento seguro
    header("Location: index.php");
    exit();
} else {
    error_log("Erro no cadastro: " . mysqli_error($conn));
    die("Ocorreu um erro ao cadastrar. Por favor, tente novamente.");
}

// Fechar statements e conexão
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>