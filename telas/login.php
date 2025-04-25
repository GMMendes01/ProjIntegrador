<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login - EcoPoints</title>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if(isset($_GET['erro'])) { ?>
            <p style="color:red;">Usuário ou senha incorretos!</p>
        <?php } ?>
        <div class="content">
            <form action="verifica_login.php" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" required>
                    <a href="#" class="forgot-password">Esqueci minha senha</a>
                </div>
                <input type="submit" value="ENTRAR" class="submit-btn">
            </form>
            <div class="teste">
                <label for="">Não tem um cadastro? </label>
                <a href="cadastro.html">Registre-se</a>
        </div>
    </div>
</body>
</html>