<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Receitas</title>
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
            display: flex;
            min-height: 100vh;
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

        #sidebar.active {
            transform: translateX(0);
        }

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

        .menu a.active {
            background-color: #E88A70;
            font-weight: bold;
        }

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

        /* Conteúdo Principal */
        .right-total {
            width: calc(100% - 320px);
            margin-left: 320px;
            padding: 20px;
            transition: margin-left 0.4s ease;
        }

        .page-title {
            color: #E27D60;
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Formulário de Nova Receita */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.2em;
            color: #E27D60;
            margin-bottom: 15px;
            border-bottom: 2px solid #E27D60;
            padding-bottom: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #E27D60;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* Ingredientes e Instruções Dinâmicas */
        .dynamic-list {
            margin-top: 10px;
        }

        .list-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: flex-start;
        }

        .list-item input {
            flex: 1;
        }

        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .remove-btn:hover {
            background: #c82333;
        }

        .add-btn {
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .add-btn:hover {
            background: #218838;
        }

        /* Botões */
        .btn-primary {
            background: #E27D60;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background: #d2694d;
        }

        /* Minhas Receitas Salvas */
        .my-recipes-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .my-recipes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .recipe-card {
            border: 2px solid #E27D60;
            border-radius: 10px;
            padding: 15px;
            background: #fff;
        }

        .recipe-card h3 {
            color: #E27D60;
            margin-bottom: 10px;
        }

        .recipe-card p {
            color: #666;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .recipe-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-edit {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .no-recipes {
            text-align: center;
            color: #888;
            padding: 40px;
        }

        .no-recipes i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #E27D60;
        }

        /* Responsividade */
        @media (min-width: 992px) {
            #sidebar {
                transform: translateX(0);
                position: fixed;
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
                    <h2>Olá, Usuário!</h2>
                </div>

                <ul class="menu">
                    <li><a href="home.php"><i class="bi bi-house-door"></i> Início</a></li>
                    <li><a href="minhas-receitas.php" class="active"><i class="bi bi-book"></i> Minhas receitas</a></li>
                    <li><a href="favoritos.php"><i class="bi bi-bookmark"></i> Favoritos</a></li>
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
            <h1 class="page-title">Minhas Receitas</h1>
            
            <!-- Formulário para Criar Nova Receita -->
            <div class="form-container">
                <h2 class="section-title">Criar Nova Receita</h2>
                <form id="recipeForm">
                    <div class="form-section">
                        <div class="form-group">
                            <label for="recipeName">Nome da Receita *</label>
                            <input type="text" id="recipeName" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeImage">URL da Imagem</label>
                            <input type="text" id="recipeImage" placeholder="https://exemplo.com/imagem.jpg">
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeDescription">Descrição *</label>
                            <textarea id="recipeDescription" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeTime">Tempo de Preparo *</label>
                            <input type="text" id="recipeTime" placeholder="ex: 30 min" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeDifficulty">Dificuldade *</label>
                            <select id="recipeDifficulty" required>
                                <option value="">Selecione...</option>
                                <option value="Fácil">Fácil</option>
                                <option value="Médio">Médio</option>
                                <option value="Difícil">Difícil</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="recipeServings">Rendimento *</label>
                            <input type="text" id="recipeServings" placeholder="ex: 4 porções" required>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">Ingredientes</h3>
                        <div id="ingredientsList" class="dynamic-list">
                            <div class="list-item">
                                <input type="text" class="ingredient-input" placeholder="ex: 2 xícaras de farinha de trigo">
                                <button type="button" class="remove-btn" onclick="removeListItem(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="add-btn" onclick="addIngredient()">
                            <i class="bi bi-plus"></i> Adicionar Ingrediente
                        </button>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title">Modo de Preparo</h3>
                        <div id="instructionsList" class="dynamic-list">
                            <div class="list-item">
                                <input type="text" class="instruction-input" placeholder="ex: Pré-aqueça o forno a 180°C">
                                <button type="button" class="remove-btn" onclick="removeListItem(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="add-btn" onclick="addInstruction()">
                            <i class="bi bi-plus"></i> Adicionar Passo
                        </button>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="bi bi-save"></i> Salvar Receita
                    </button>
                </form>
            </div>

            <!-- Lista de Receitas Salvas -->
            <div class="my-recipes-container">
                <h2 class="section-title">Minhas Receitas Salvas</h2>
                <div id="myRecipesList" class="my-recipes-grid">
                    <!-- As receitas serão carregadas aqui -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Chave para armazenar no localStorage
        const USER_RECIPES_KEY = 'userRecipes';

        // Inicializar lista de receitas do usuário
        function initializeUserRecipes() {
            if (!localStorage.getItem(USER_RECIPES_KEY)) {
                localStorage.setItem(USER_RECIPES_KEY, JSON.stringify([]));
            }
        }

        // Obter receitas do usuário
        function getUserRecipes() {
            return JSON.parse(localStorage.getItem(USER_RECIPES_KEY)) || [];
        }

        // Salvar receitas do usuário
        function saveUserRecipes(recipes) {
            localStorage.setItem(USER_RECIPES_KEY, JSON.stringify(recipes));
        }

        // Adicionar ingrediente
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

        // Adicionar instrução
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

        // Remover item da lista
        function removeListItem(button) {
            const listItem = button.closest('.list-item');
            if (listItem) {
                listItem.remove();
            }
        }

        // Salvar receita
        function saveRecipe(recipeData) {
            const userRecipes = getUserRecipes();
            
            // Gerar ID único
            const newId = 'user_' + Date.now();
            recipeData.id = newId;
            
            // Adicionar imagem padrão se não for fornecida
            if (!recipeData.image) {
                recipeData.image = 'assets/default-recipe.png';
            }
            
            userRecipes.push(recipeData);
            saveUserRecipes(userRecipes);
            
            // Atualizar também o recipesData global para aparecer na home
            updateGlobalRecipesData(recipeData);
            
            return newId;
        }

        // Atualizar dados globais de receitas
        function updateGlobalRecipesData(recipeData) {
            let globalRecipes = JSON.parse(localStorage.getItem('recipesData')) || {};
            globalRecipes[recipeData.id] = recipeData;
            localStorage.setItem('recipesData', JSON.stringify(globalRecipes));
        }

        // Carregar receitas do usuário
        function loadUserRecipes() {
            const myRecipesList = document.getElementById('myRecipesList');
            const userRecipes = getUserRecipes();
            
            if (userRecipes.length === 0) {
                myRecipesList.innerHTML = `
                    <div class="no-recipes">
                        <i class="bi bi-journal-plus"></i>
                        <p>Você ainda não criou nenhuma receita.</p>
                        <p>Use o formulário acima para criar sua primeira receita!</p>
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
                    <p><strong>Rendimento:</strong> ${recipe.servings}</p>
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

        // Excluir receita
        function deleteRecipe(recipeId) {
            if (confirm('Tem certeza que deseja excluir esta receita?')) {
                let userRecipes = getUserRecipes();
                userRecipes = userRecipes.filter(recipe => recipe.id !== recipeId);
                saveUserRecipes(userRecipes);
                
                // Remover também dos dados globais
                let globalRecipes = JSON.parse(localStorage.getItem('recipesData')) || {};
                delete globalRecipes[recipeId];
                localStorage.setItem('recipesData', JSON.stringify(globalRecipes));
                
                loadUserRecipes();
                alert('Receita excluída com sucesso!');
            }
        }

        // Editar receita (simplificado - poderia ser expandido)
        function editRecipe(recipeId) {
            alert('Funcionalidade de edição será implementada em breve!');
        }

        // Inicializar a página
        document.addEventListener('DOMContentLoaded', function() {
            initializeUserRecipes();
            loadUserRecipes();
            
            // Menu lateral
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('openBtn');
            const closeBtn = document.getElementById('closeBtn');
            
            openBtn.addEventListener('click', function() {
                sidebar.classList.add('active');
            });
            
            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('active');
            });

            // Formulário de receita
            document.getElementById('recipeForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Coletar dados do formulário
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
                
                // Validar dados
                if (recipeData.ingredients.length === 0 || recipeData.instructions.length === 0) {
                    alert('Por favor, adicione pelo menos um ingrediente e uma instrução.');
                    return;
                }
                
                // Salvar receita
                saveRecipe(recipeData);
                
                // Limpar formulário
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
                
                // Recarregar lista
                loadUserRecipes();
                
                alert('Receita salva com sucesso! Ela aparecerá na página inicial.');
            });
        });
    </script>
</body>
</html>