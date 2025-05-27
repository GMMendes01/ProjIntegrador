<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../img/BE9291F6-A43A-4824-99E8-EF4B582472B4.png" type="image/x-icon">
    <title>Login - EcoPoints</title>
</head>
<body>

<button href="index.php" class="button" id="backBtn"onclick="window.location.href='index.php'">
        <div class="button-box">
          <span class="button-elem">
            <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
              ></path>
            </svg>
          </span>
          <span class="button-elem">
            <svg viewBox="0 0 46 40">
              <path
                d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
              ></path>
            </svg>
          </span>
        </div>
      </button>
      
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