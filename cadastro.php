<?php
    if(isset($_POST['submit'])){

    include_once('backend/config.php');
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios (nome, email, senha) 
    VALUES ('$nome','$email','$senha')");

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/responsive.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <h1>Bem-vindo(a)!</h1>
            <div class="img">
                <img src="assets/ilustracao_sem_fundo 1.png" alt="">
            </div>
            <p>Entre e visualize suas receitas favoritas!</p>
        </div>

        <div class="right">
            <span><h2 class="new">Criar conta</h2></span>

            <form id="formCadastro" action="cadastro.php" method="POST" novalidate>
                <input type="text" name="nome" id="nome" placeholder="Nome" required>
                <p class="erro"  id="erroNome"></p>

                <input type="email" name="email" id="email" placeholder="Email" required>
                <p class="erro"  id="erroEmail"></p>

                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                <p class="erro"  id="erroSenha"></p>

                <input id="confirmar_senha" type="password" placeholder="Confirmar senha" required>
                <p class="erro"  id="erroConfirmar"></p>

                <button type="submit" name="submit" id="submit" class="login">Cadastrar</button>
            </form>
        </div>
    </div>

    <script src="js/validacao.js"></script>
</body>
</html>