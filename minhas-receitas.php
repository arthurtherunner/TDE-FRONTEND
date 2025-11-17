<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Receitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/minhas-receitas.css">
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
                            <label for="recipeServings">Quantidade *</label>
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

            <div class="my-recipes-container">
                <h2 class="section-title">Minhas Receitas Salvas</h2>
                <div id="myRecipesList" class="my-recipes-grid"></div>
            </div>
        </div>
    </div>
    <script src="js/minhas-receitas.js"></script>
</body>
</html>