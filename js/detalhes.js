    document.addEventListener('DOMContentLoaded', () => {
    loadRecipeDetails();

    document.getElementById('favoriteBtn').addEventListener('click', function() {
    });
});
       
       // carregar dados da receita
        function loadRecipeDetails() {
            const recipeId = localStorage.getItem('selectedRecipe');

            if (!recipeId) {
                document.getElementById('recipe-content').innerHTML = '<p>Nenhuma receita selecionada.</p>';
                return;
            }

            // buscar primeiro nas receitas
            let recipesData = JSON.parse(localStorage.getItem('recipesData')) || {};
            let recipe = recipesData[recipeId];
            
            // se não encontrou nas receitas padrão, buscar nas receitas do usuário
            if (!recipe) {
                const userRecipes = JSON.parse(localStorage.getItem('userRecipes')) || [];
                recipe = userRecipes.find(rec => rec.id === recipeId);
                
                if (recipe) {
                }
            } else {
            }
            
            if (!recipe) {
                document.getElementById('recipe-content').innerHTML = `
                    <div style="text-align: center; padding: 50px;">
                        <i class="bi bi-exclamation-triangle" style="font-size: 48px; color: #E27D60;"></i>
                        <h2 style="color: #E27D60; margin: 20px 0;">Receita não encontrada</h2>
                        <p>ID da receita: ${recipeId}</p>
                        <p>A receita que você está tentando acessar não foi encontrada.</p>
                    </div>
                `;
                return;
            }

            // verificar se é favorita
            const favorites = JSON.parse(localStorage.getItem('userFavorites')) || [];
            const isFavorited = favorites.some(fav => fav.id === recipeId);

            // atualizar botão de favorito
            const favoriteBtn = document.getElementById('favoriteBtn');
            if (isFavorited) {
                favoriteBtn.innerHTML = '<i class="bi bi-heart-fill"></i> Favoritado';
                favoriteBtn.classList.add('favorited');
            }

            // garantir que a imagem tenha fallback
            const recipeImage = recipe.image || 'assets/default-recipe.png';

            // html da receita
            const recipeHTML = `
                <div class="recipe-hero">
                    <img src="${recipeImage}" alt="${recipe.name}" class="recipe-image" onerror="this.src='assets/default-recipe.png'">
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
                        ${(recipe.ingredients || []).map(ingredient => 
                            `<li><i class="bi bi-check-circle" style="color: #E27D60;"></i> ${ingredient}</li>`
                        ).join('')}
                    </ul>
                </div>

                <div class="content-section">
                    <h2 class="section-title">Modo de Preparo</h2>
                    <ol class="instructions-list">
                        ${(recipe.instructions || []).map((instruction, index) => 
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

        // funcionalidade do botão de favoritar
        document.getElementById('favoriteBtn').addEventListener('click', function() {
            const recipeId = localStorage.getItem('selectedRecipe');
            
            if (!recipeId) {
                alert('Nenhuma receita selecionada.');
                return;
            }

            // buscar a receita nos 2
            let recipesData = JSON.parse(localStorage.getItem('recipesData')) || {};
            let recipe = recipesData[recipeId];
            
            if (!recipe) {
                const userRecipes = JSON.parse(localStorage.getItem('userRecipes')) || [];
                recipe = userRecipes.find(rec => rec.id === recipeId);
            }
            
            if (!recipe) {
                alert('Receita não encontrada para favoritar.');
                return;
            }

            const favorites = JSON.parse(localStorage.getItem('userFavorites')) || [];
            const isFavorited = favorites.some(fav => fav.id === recipeId);

            if (isFavorited) {
                // remover dos favoritos
                const updatedFavorites = favorites.filter(fav => fav.id !== recipeId);
                localStorage.setItem('userFavorites', JSON.stringify(updatedFavorites));
                this.innerHTML = '<i class="bi bi-heart"></i> Favoritar';
                this.classList.remove('favorited');
            } else {
                // adicionar aos favoritos
                favorites.push({
                    id: recipe.id,
                    name: recipe.name,
                    image: recipe.image || 'assets/default-recipe.png'
                });
                localStorage.setItem('userFavorites', JSON.stringify(favorites));
                this.innerHTML = '<i class="bi bi-heart-fill"></i> Favoritado';
                this.classList.add('favorited');
            }
        });

        // carregar a receita quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            loadRecipeDetails();
        });