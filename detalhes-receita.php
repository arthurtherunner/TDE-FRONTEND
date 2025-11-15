<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Receita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .back-btn {
            background: #E27D60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
        }

        .back-btn:hover {
            background: #d2694d;
        }

        .recipe-hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .recipe-image {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .recipe-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .recipe-title {
            font-size: 2.5em;
            color: #E27D60;
            margin-bottom: 10px;
        }

        .recipe-description {
            font-size: 1.1em;
            line-height: 1.6;
            color: #666;
        }

        .recipe-meta {
            display: flex;
            gap: 30px;
            margin-top: 20px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .meta-icon {
            font-size: 1.5em;
            color: #E27D60;
        }

        .meta-text {
            font-size: 0.9em;
            color: #666;
        }

        .favorite-btn {
            background: #E27D60;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            margin-top: 10px;
        }

        .favorite-btn:hover {
            background: #d2694d;
        }

        .favorite-btn.favorited {
            background: #dc3545;
        }

        .content-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.5em;
            color: #E27D60;
            margin-bottom: 20px;
            border-bottom: 2px solid #E27D60;
            padding-bottom: 10px;
        }

        .ingredients-list, .instructions-list {
            list-style: none;
        }

        .ingredients-list li, .instructions-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .ingredients-list li:last-child, .instructions-list li:last-child {
            border-bottom: none;
        }

        .instruction-number {
            background: #E27D60;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            flex-shrink: 0;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .recipe-hero {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .recipe-title {
                font-size: 2em;
            }

            .recipe-meta {
                justify-content: space-between;
            }

            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <button class="back-btn" onclick="window.history.back()">
                <i class="bi bi-arrow-left"></i> Voltar
            </button>
            <button class="favorite-btn" id="favoriteBtn">
                <i class="bi bi-heart"></i> Favoritar
            </button>
        </div>

        <div id="recipe-content">
            <!-- O conteúdo da receita será carregado aqui via JavaScript -->
        </div>
    </div>

    <script>
        // Carregar dados da receita
        function loadRecipeDetails() {
            const recipeId = localStorage.getItem('selectedRecipe');
            const recipesData = JSON.parse(localStorage.getItem('recipesData'));
            const recipe = recipesData[recipeId];
            
            if (!recipe) {
                document.getElementById('recipe-content').innerHTML = '<p>Receita não encontrada.</p>';
                return;
            }

            // Verificar se é favorita
            const favorites = JSON.parse(localStorage.getItem('userFavorites')) || [];
            const isFavorited = favorites.some(fav => fav.id === recipeId);

            // Atualizar botão de favorito
            const favoriteBtn = document.getElementById('favoriteBtn');
            if (isFavorited) {
                favoriteBtn.innerHTML = '<i class="bi bi-heart-fill"></i> Favoritado';
                favoriteBtn.classList.add('favorited');
            }

            // Construir HTML da receita
            const recipeHTML = `
                <div class="recipe-hero">
                    <img src="${recipe.image}" alt="${recipe.name}" class="recipe-image">
                    <div class="recipe-info">
                        <h1 class="recipe-title">${recipe.name}</h1>
                        <p class="recipe-description">${recipe.description}</p>
                        
                        <div class="recipe-meta">
                            <div class="meta-item">
                                <i class="bi bi-clock meta-icon"></i>
                                <span class="meta-text">${recipe.time}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-speedometer2 meta-icon"></i>
                                <span class="meta-text">${recipe.difficulty}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-people meta-icon"></i>
                                <span class="meta-text">${recipe.servings}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-section">
                    <h2 class="section-title">Ingredientes</h2>
                    <ul class="ingredients-list">
                        ${recipe.ingredients.map(ingredient => 
                            `<li><i class="bi bi-check-circle" style="color: #E27D60;"></i> ${ingredient}</li>`
                        ).join('')}
                    </ul>
                </div>

                <div class="content-section">
                    <h2 class="section-title">Modo de Preparo</h2>
                    <ol class="instructions-list">
                        ${recipe.instructions.map((instruction, index) => 
                            `<li>
                                <div class="instruction-number">${index + 1}</div>
                                <span>${instruction}</span>
                            </li>`
                        ).join('')}
                    </ol>
                </div>
            `;

            document.getElementById('recipe-content').innerHTML = recipeHTML;
        }

        // Funcionalidade do botão de favoritar
        document.getElementById('favoriteBtn').addEventListener('click', function() {
            const recipeId = localStorage.getItem('selectedRecipe');
            const recipesData = JSON.parse(localStorage.getItem('recipesData'));
            const recipe = recipesData[recipeId];
            
            if (!recipe) return;

            const favorites = JSON.parse(localStorage.getItem('userFavorites')) || [];
            const isFavorited = favorites.some(fav => fav.id === recipeId);

            if (isFavorited) {
                // Remover dos favoritos
                const updatedFavorites = favorites.filter(fav => fav.id !== recipeId);
                localStorage.setItem('userFavorites', JSON.stringify(updatedFavorites));
                this.innerHTML = '<i class="bi bi-heart"></i> Favoritar';
                this.classList.remove('favorited');
            } else {
                // Adicionar aos favoritos
                favorites.push({
                    id: recipe.id,
                    name: recipe.name,
                    image: recipe.image
                });
                localStorage.setItem('userFavorites', JSON.stringify(favorites));
                this.innerHTML = '<i class="bi bi-heart-fill"></i> Favoritado';
                this.classList.add('favorited');
            }
        });

        // Carregar a receita quando a página carregar
        document.addEventListener('DOMContentLoaded', loadRecipeDetails);
    </script>
</body>
</html>