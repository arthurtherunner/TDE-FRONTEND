        const recipeForm = document.getElementById('recipeForm');
        if (recipeForm) {
            recipeForm.addEventListener('submit', function(e) {
                
            });
        }
        
        
        // chave para armazenar no localStorage
        const USER_RECIPES_KEY = 'userRecipes';

        // inicializar lista de receitas do usuario
        function initializeUserRecipes() {
            if (!localStorage.getItem(USER_RECIPES_KEY)) {
                localStorage.setItem(USER_RECIPES_KEY, JSON.stringify([]));
            }
        }

        // pegaar receitas do usuario
        function getUserRecipes() {
            return JSON.parse(localStorage.getItem(USER_RECIPES_KEY)) || [];
        }

        // salvar receitas do usuario
        function saveUserRecipes(recipes) {
            localStorage.setItem(USER_RECIPES_KEY, JSON.stringify(recipes));
        }

        // adicionar ingrediente
        function addIngredient() {
            const ingredientsList = document.getElementById('ingredientsList');
            const newItem = document.createElement('div');
            newItem.className = 'list-item';
            newItem.innerHTML = `
                <input type="text" class="ingredient-input" placeholder="ex: 2 xícaras de farinha de trigo">
                <button type="button" class="remove-btn" onclick="removeListItem(this)">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            ingredientsList.appendChild(newItem);
        }

        // adicionar instruçao
        function addInstruction() {
            const instructionsList = document.getElementById('instructionsList');
            const newItem = document.createElement('div');
            newItem.className = 'list-item';
            newItem.innerHTML = `
                <input type="text" class="instruction-input" placeholder="ex: Pré-aqueça o forno a 180°C">
                <button type="button" class="remove-btn" onclick="removeListItem(this)">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            instructionsList.appendChild(newItem);
        }

        // remover da lista
        function removeListItem(button) {
            const listItem = button.closest('.list-item');
            if (listItem) {
                listItem.remove();
            }
        }

        // salvar receita
        function saveRecipe(recipeData) {
            const userRecipes = getUserRecipes();
            
            // gera ID único
            const newId = 'user_' + Date.now();
            recipeData.id = newId;
            
            // adicionar imagem padrão se não for fornecida
            if (!recipeData.image) {
                recipeData.image = 'assets/default-recipe.png';
            }
            
            userRecipes.push(recipeData);
            saveUserRecipes(userRecipes);
            
            // atualizar também para aparecer na home
            updateGlobalRecipesData(recipeData);
            
            return newId;
        }

        // atualizar dados globais de receitas
        function updateGlobalRecipesData(recipeData) {
            let globalRecipes = JSON.parse(localStorage.getItem('recipesData')) || {};
            globalRecipes[recipeData.id] = recipeData;
            localStorage.setItem('recipesData', JSON.stringify(globalRecipes));
        }

        // carregar receitas do usuario
        function loadUserRecipes() {
            const myRecipesList = document.getElementById('myRecipesList');
            const userRecipes = getUserRecipes();
            
            if (userRecipes.length === 0) {
                myRecipesList.innerHTML = `
                    <div class="no-recipes">
                        <i class="bi bi-journal-plus"></i>
                        <p>Você ainda não criou nenhuma receita</p>
                    </div>
                `;
                return;
            }
            
            myRecipesList.innerHTML = '';
            
            userRecipes.forEach(recipe => {
                const recipeCard = document.createElement('div');
                recipeCard.className = 'recipe-card';
                recipeCard.innerHTML = `
                    <h3>${recipe.name}</h3>
                    <p><strong>Descrição:</strong> ${recipe.description}</p>
                    <p><strong>Tempo:</strong> ${recipe.time}</p>
                    <p><strong>Dificuldade:</strong> ${recipe.difficulty}</p>
                    <p><strong>Quantidade:</strong> ${recipe.servings}</p>
                    <div class="recipe-actions">
                        <button class="btn-edit" onclick="editRecipe('${recipe.id}')">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                        <button class="btn-delete" onclick="deleteRecipe('${recipe.id}')">
                            <i class="bi bi-trash"></i> Excluir
                        </button>
                    </div>
                `;
                myRecipesList.appendChild(recipeCard);
            });
        }

        // excluir receita
        function deleteRecipe(recipeId) {
            if (confirm('Tem certeza que deseja excluir esta receita?')) {
                let userRecipes = getUserRecipes();
                userRecipes = userRecipes.filter(recipe => recipe.id !== recipeId);
                saveUserRecipes(userRecipes);
                
                // remover também dos dados globais
                let globalRecipes = JSON.parse(localStorage.getItem('recipesData')) || {};
                delete globalRecipes[recipeId];
                localStorage.setItem('recipesData', JSON.stringify(globalRecipes));
                
                loadUserRecipes();
                alert('Receita excluída com sucesso!');
            }
        }

        // editar receita
        function editRecipe(recipeId) {
            alert('Ainda não fiz');
        }

        // inicializar a página
        document.addEventListener('DOMContentLoaded', function() {
            initializeUserRecipes();
            loadUserRecipes();
            
            // menu lateral
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('openBtn');
            const closeBtn = document.getElementById('closeBtn');
            
            openBtn.addEventListener('click', function() {
                sidebar.classList.add('active');
            });
            
            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('active');
            });

            // formulário de receita
            document.getElementById('recipeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // coletar dados do formulário
                const recipeData = {
                    name: document.getElementById('recipeName').value,
                    image: document.getElementById('recipeImage').value,
                    description: document.getElementById('recipeDescription').value,
                    time: document.getElementById('recipeTime').value,
                    difficulty: document.getElementById('recipeDifficulty').value,
                    servings: document.getElementById('recipeServings').value,
                    ingredients: Array.from(document.querySelectorAll('.ingredient-input'))
                        .map(input => input.value)
                        .filter(value => value.trim() !== ''),
                    instructions: Array.from(document.querySelectorAll('.instruction-input'))
                        .map(input => input.value)
                        .filter(value => value.trim() !== '')
                };
                
                // validar dados
                if (recipeData.ingredients.length === 0 || recipeData.instructions.length === 0) {
                    alert('Por favor, adicione pelo menos um ingrediente e uma instrução.');
                    return;
                }
                
                // salvar receita
                saveRecipe(recipeData);
                
                // limpar formulário
                this.reset();
                document.getElementById('ingredientsList').innerHTML = `
                    <div class="list-item">
                        <input type="text" class="ingredient-input" placeholder="ex: 2 xícaras de farinha de trigo">
                        <button type="button" class="remove-btn" onclick="removeListItem(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
                document.getElementById('instructionsList').innerHTML = `
                    <div class="list-item">
                        <input type="text" class="instruction-input" placeholder="ex: Pré-aqueça o forno a 180°C">
                        <button type="button" class="remove-btn" onclick="removeListItem(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
                
                // recarregar lista
                loadUserRecipes();
                
                alert('Receita salva com sucesso!');
            });
        });