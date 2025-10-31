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
</head>
<body>
    <div class="container">
        <div class="left">
            <h1>Bem-vindo(a)!</h1>
            <div class="img">
                <img src="assets/ilustracao_sem_fundo 1.png" alt="">
            </div>
            <p>Entre e compartilhe suas receitas favoritas!</p>
        </div>

        <div class="right">
            <span><h2 class="new">Criar conta</h2></span>

            <form action="cadastro.php" method="POST">
                <input type="text" name="nome" id="nome" placeholder="Nome" required>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                <input type="password" placeholder="Confirmar senha" required>
                <button type="submit" name="submit" id="submit" class="login">Cadastrar</button>
            </form>
        </div>
    </div>
</body>
</html>