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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Cursive:wght@400..700&family=Nata+Sans:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Teko:wght@300..700&display=swap');

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            height: 100vh;
            width: 100%;
            font-family: poppins;
        }

        .container{
            display: flex;
            height: 100vh;
        }

        .img-home{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .left{
            width: 20%;
            height: 100%;
            background-color: #E27D60;
            color: #fff;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .paragrafos{
            margin: 10px;
            margin-top: 150px;
            font-size: 15px;
            
        }

        a{
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            margin-left: 25px;
            margin-bottom: 10px;
        }

        hr{
            border: 0.5px solid #FED8AC;
            width: 95%;
        }

        .paragrafos img{
            margin-top: 75px;
            margin-left: 20px;
        }

        .paragrafos p{
            font-size: 15px;
            text-align: center;
        }

        .right-total{
            width: calc(100% - 320px); 
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            margin-left: 320px; 
            padding: 0 20px; 
            transition: margin-left 0.4s ease; 
        }

        .right{
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            align-items: flex-start;
            padding: 40px;
            gap: 65px;
        }

        .search-container{
            border: 2px solid #E27D60;
            border-radius: 15px;
            padding: 5px 10px;
            width: 100%;
            max-width: 500px; 
        }

        .search-container input {
            border: none;
            outline: none;
            font-size: 14px;
            font-family: Poppins;
            width: 90%; 
        }

        .search-container i {
            color: #E27D60;
            cursor: pointer;
            font-size: 16px;
        }

        img{
            height: 280px;
        }

        .receitas{
            flex: 0 1 45%;
            height: 400px;
            text-align: center;
        }

        .receitas img{
            width: 100%;
            height: 100%;
            cursor: pointer;
            border-radius: 10px;
        }

        .desc {
            text-align: center;
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            box-sizing: border-box;
            gap: 20px;
        }

        .desc p{
            font-size: 15px;
            cursor: pointer;
        }

        .desc i{
            color:  #E27D60;
            font-size: 15px;
            cursor: pointer;
        }

        .desc i:hover{
            color: red;
            transition: 1s;
        }

        /* ===== SIDEBAR ===== */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 321px;
            height: 100vh;
            background-color: #E27D60;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px 10px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            transform: translateX(-100%);
            transition: transform 0.4s ease;
            z-index: 1000;
        }

        /* Sidebar ativa  */
        #sidebar.active {
            transform: translateX(0);
        }

        /* Ícone de fechar */
        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            display: block;
        }

        /* Seção do usuário */
        .user-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 60px;
        }

        .user-section i {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .user-section h2 {
            font-size: 22px;
        }

        /* Menu */
        .menu {
            list-style: none;
            margin-top: 40px;
        }

        .menu li {
            margin-bottom: 15px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .menu a:hover {
            background-color: #E88A70;
        }

        /* Botão Sair */
        .logout {
            list-style: none;
            margin-bottom: 10px;
        }

        .logout a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .logout a:hover {
            background-color: #E88A70;
        }

        /* Botão de abrir */
        .open-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background: none;
            border: none;
            font-size: 30px;
            color: #421205;
            cursor: pointer;
            z-index: 1100;
        }

        /* Estilos específicos para a página de favoritos */
        .page-title {
            margin: 20px 0;
            color: #E27D60;
            font-size: 28px;
            text-align: center;
        }

        .no-favorites {
            text-align: center;
            margin-top: 50px;
            color: #888;
            font-size: 18px;
        }

        .no-favorites i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #E27D60;
        }

        .favorite-heart {
            color: red !important;
        }

          
        .page-title {
            margin: 20px 0;
            color: #E27D60;
            font-size: 28px;
            text-align: center;
        }

        .no-favorites {
            text-align: center;
            margin-top: 50px;
            color: #888;
            font-size: 18px;
            width: 100%;
        }

        .no-favorites i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #E27D60;
        }

        .favorite-heart {
            color: red !important;
        }

        .menu a.active {
            background-color: #E88A70;
            font-weight: bold;
        }

        /* ====== RESPONSIVIDADE ====== */
        @media (min-width: 992px) {
            #sidebar {
                transform: translateX(0);
                position: fixed; /* sidebar fixo */
            }

            .open-btn,
            .close-btn {
                display: none;
            }
            
            .right-total {
                width: calc(100% - 320px);
                margin-left: 320px;
                padding: 0 20px;
            }
        }

        @media (max-width: 991px) {
            #sidebar.active + .right-total {
                margin-left: 0;
                width: 100%;
            }
        
            .right-total {
                width: 100%;
                margin-left: 0;
                padding: 0 15px;
            }
            .receitas{
                flex: 0 1 100%;
            }
        }
    </style>
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
                    <li><a href="minhas-receitas.html"><i class="bi bi-book"></i> Minhas receitas</a></li>
                    <li><a href="favoritos.html" class="active"><i class="bi bi-bookmark"></i> Favoritos</a></li>
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

    <script>
        // Sistema de Favoritos (mesmo sistema da página inicial)
        const FAVORITES_KEY = 'userFavorites';
        
        function getFavorites() {
            return JSON.parse(localStorage.getItem(FAVORITES_KEY)) || [];
        }
        
        function removeFromFavorites(recipeId) {
            let favorites = getFavorites();
            favorites = favorites.filter(fav => fav.id !== recipeId);
            localStorage.setItem(FAVORITES_KEY, JSON.stringify(favorites));
            return favorites;
        }

        // Função para redirecionar para detalhes da receita
        function redirectToRecipeDetails(recipeId) {
            // Salvar a receita selecionada no localStorage
            localStorage.setItem('selectedRecipe', recipeId);
            // Redirecionar para a página de detalhes
            window.location.href = 'detalhes-receita.php';
        }
        
        // Carregar e exibir receitas favoritas
        function loadFavorites() {
            const favoritesContainer = document.getElementById('favorites-container');
            const favorites = getFavorites();
            
            if (favorites.length === 0) {
                favoritesContainer.innerHTML = `
                    <div class="no-favorites">
                        <i class="bi bi-heart"></i>
                        <p>Você ainda não tem receitas favoritas.</p>
                        <p>Volte à página inicial e adicione algumas!</p>
                    </div>
                `;
                return;
            }
            
            favoritesContainer.innerHTML = '';
            
            favorites.forEach(recipe => {
                const recipeElement = document.createElement('div');
                recipeElement.className = 'receitas';
                recipeElement.setAttribute('data-id', recipe.id);
                recipeElement.innerHTML = `
                    <img src="${recipe.image}" alt="${recipe.name}">
                    <div class="desc">
                        <p>${recipe.name}</p>
                        <i class="bi bi-heart-fill favorite-heart" data-id="${recipe.id}"></i>
                    </div>
                `;
                favoritesContainer.appendChild(recipeElement);
            });

            // ADIÇÃO: Event listeners para redirecionamento (imagem e nome da receita)
            document.querySelectorAll('.receitas img, .desc p').forEach(element => {
                element.addEventListener('click', function(e) {
                    // Impedir que o clique dispare quando for no coração
                    if (e.target.closest('.desc i')) return;
                    
                    const recipeElement = this.closest('.receitas');
                    const recipeId = recipeElement.getAttribute('data-id');
                    redirectToRecipeDetails(recipeId);
                });
            });
            
            // Adicionar event listeners para remover dos favoritos (coração)
            document.querySelectorAll('.desc i').forEach(heart => {
                heart.addEventListener('click', function(e) {
                    e.stopPropagation(); // Impedir que o clique propague para o elemento pai
                    
                    const recipeId = this.getAttribute('data-id');
                    const recipeElement = this.closest('.receitas');
                    
                    // Remover dos favoritos
                    const updatedFavorites = removeFromFavorites(recipeId);
                    
                    // Feedback visual
                    this.style.transform = 'scale(1.3)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 300);
                    
                    // Recarregar a lista
                    if (updatedFavorites.length === 0) {
                        loadFavorites();
                    } else {
                        recipeElement.remove();
                    }
                });
            });
        }
        
        // Pesquisar receitas favoritas
        function searchFavorites(query) {
            const favorites = getFavorites();
            const filteredFavorites = favorites.filter(recipe => 
                recipe.name.toLowerCase().includes(query.toLowerCase())
            );
            
            const favoritesContainer = document.getElementById('favorites-container');
            
            if (filteredFavorites.length === 0) {
                favoritesContainer.innerHTML = `
                    <div class="no-favorites">
                        <i class="bi bi-search"></i>
                        <p>Nenhuma receita encontrada para "${query}".</p>
                    </div>
                `;
                return;
            }
            
            favoritesContainer.innerHTML = '';
            
            filteredFavorites.forEach(recipe => {
                const recipeElement = document.createElement('div');
                recipeElement.className = 'receitas';
                recipeElement.setAttribute('data-id', recipe.id);
                recipeElement.innerHTML = `
                    <img src="${recipe.image}" alt="${recipe.name}">
                    <div class="desc">
                        <p>${recipe.name}</p>
                        <i class="bi bi-heart-fill favorite-heart" data-id="${recipe.id}"></i>
                    </div>
                `;
                favoritesContainer.appendChild(recipeElement);
            });

            // ADIÇÃO: Event listeners para redirecionamento na pesquisa (imagem e nome da receita)
            document.querySelectorAll('.receitas img, .desc p').forEach(element => {
                element.addEventListener('click', function(e) {
                    if (e.target.closest('.desc i')) return;
                    
                    const recipeElement = this.closest('.receitas');
                    const recipeId = recipeElement.getAttribute('data-id');
                    redirectToRecipeDetails(recipeId);
                });
            });
            
            // Adicionar event listeners para remover dos favoritos (coração)
            document.querySelectorAll('.desc i').forEach(heart => {
                heart.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    const recipeId = this.getAttribute('data-id');
                    const recipeElement = this.closest('.receitas');
                    
                    removeFromFavorites(recipeId);
                    recipeElement.remove();
                    
                    // Se não há mais receitas após a remoção
                    if (document.querySelectorAll('.receitas').length === 0) {
                        loadFavorites();
                    }
                });
            });
        }
        
        // Inicializar a página
        document.addEventListener('DOMContentLoaded', function() {
            loadFavorites();
            
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('openBtn');
            const closeBtn = document.getElementById('closeBtn');
            const searchInput = document.getElementById('searchInput');
            
            // Funcionalidade do menu lateral
            openBtn.addEventListener('click', function() {
                sidebar.classList.add('active');
            });
            
            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('active');
            });
            
            // Pesquisar receitas
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query) {
                    searchFavorites(query);
                } else {
                    loadFavorites();
                }
            });
            
            // Fechar sidebar ao clicar fora
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnOpenBtn = openBtn.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnOpenBtn && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>