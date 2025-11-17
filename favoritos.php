<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - Receitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/favoritos.css">
</head>
<body>
   <div class="container">
        <nav id="sidebar">
            <button id="closeBtn" class="close-btn">
                <i class="bi bi-x"></i>
            </button>

            <div class="sidebar-content">
                <div class="user-section">
                    <i class="bi bi-person-circle"></i>
                    <h2>Olá, <?php echo $_SESSION['nome'];?>!</h2>
                </div>

                <ul class="menu">
                    <li><a href="home.php"><i class="bi bi-house-door"></i> Início</a></li>
                    <li><a href="minhas-receitas.php"><i class="bi bi-book"></i> Minhas receitas</a></li>
                    <li><a href="favoritos.php" class="active"><i class="bi bi-bookmark"></i> Favoritos</a></li>
                    <li><a href="perfil.html"><i class="bi bi-person-square"></i> Perfil</a></li>
                </ul>
            </div>
            
            <ul class="logout">
                <li><a href="index.php"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
            </ul>
        </nav>
        
        <button id="openBtn" class="open-btn">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="right-total">
            <h1 class="page-title">Minhas Receitas Favoritas</h1>
            
            <div class="search-container">
                <input type="text" placeholder="Pesquisar receita..." id="searchInput">
                <i class="bi bi-search"></i>
            </div>
            
            <div class="right" id="favorites-container">
                <!-- As receitas favoritas serão carregadas aqui dinamicamente -->
            </div>
        </div>
    </div>
    
    <script src="js/favoritos.js"></script>
</body>
</html>