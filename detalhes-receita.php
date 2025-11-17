<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Receita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/detalhes.css">
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
    
    <script src="js/detalhes.js"></script>
</body>
</html>