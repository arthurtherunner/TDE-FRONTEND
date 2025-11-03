<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas</title>
</head>
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="styles/responsive.css">
<body>
    <div class="container">
        <div class="left">
            <h1 class="inicio">Bem-vindo de volta!</h1>
            <div class="img">
                <img src="assets/ilustracao_sem_fundo 1.png" alt="">
            </div>
            <p>Entre e compartilhe suas receitas favoritas!</p>
        </div>

        <div class="right">
            <span><h2>LOGIN</h2></span>

            <form action="backend/teste-login.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password"  name="senha" id="senha" placeholder="Senha" required>

            <div class="remember">
                <label for="">
                    <input type="checkbox">
                    Lembre-me
                </label>

                <a href="#">Esqueci a senha</a>
            </div>
            <button type="submit" name="submit" id="submit" class="login">Entrar</button>
            </form>
            <div class="registro">
                <p>Não tem uma conta? <a href="cadastro.php" target="_blank">Cadastre-se</a></p>
            </div>

        </div>
    </div>
</body>
</html>