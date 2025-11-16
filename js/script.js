const sidebar = document.getElementById("sidebar");
const openBtn = document.getElementById("openBtn");
const closeBtn = document.getElementById("closeBtn");

// Sistema de Detalhes da Receita
const RECIPES_DATA = {
    '1': {
        id: '1',
        name: 'Bolo de chocolate',
        image: 'assets/BOLO DE CHOCOLATE.png',
        description: 'Um delicioso bolo de chocolate fofinho e úmido, perfeito para qualquer ocasião.',
        ingredients: [
            '2 xícaras de farinha de trigo',
            '1 xícara de açúcar',
            '1 xícara de chocolate em pó',
            '1 xícara de leite',
            '1/2 xícara de óleo',
            '2 ovos',
            '1 colher de sopa de fermento em pó'
        ],
        instructions: [
            'Pré-aqueça o forno a 180°C.',
            'Misture todos os ingredientes secos em uma tigela.',
            'Adicione os ingredientes líquidos e misture bem.',
            'Despeje a massa em uma forma untada.',
            'Asse por 40 minutos ou até que um palito saia limpo.'
        ],
        time: '50 min',
        difficulty: 'Fácil',
        servings: '8 porções'
    },
    '2': {
        id: '2',
        name: 'Lasanha',
        image: 'assets/LASANHA.png',
        description: 'Lasanha tradicional italiana com camadas de massa, queijo e molho à bolonhesa.',
        ingredients: [
            '500g de massa para lasanha',
            '500g de carne moída',
            '1 cebola picada',
            '2 dentes de alho',
            '500g de molho de tomate',
            '200g de presunto',
            '200g de mussarela',
            '100g de parmesão ralado'
        ],
        instructions: [
            'Refogue a cebola e o alho.',
            'Adicione a carne moída e cozinhe até dourar.',
            'Acrescente o molho de tomate e temperos.',
            'Monte as camadas em uma forma: molho, massa, presunto, mussarela.',
            'Repita as camadas e finalize com parmesão.',
            'Asse por 30 minutos a 180°C.'
        ],
        time: '1h 30min',
        difficulty: 'Médio',
        servings: '6 porções'
    },
    '3': {
        id: '3',
        name: 'Massa de acarajé',
        image: 'assets/ACARAJIVIS.png',
        description: 'Massa tradicional baiana para acarajé, feita com feijão-fradinho.',
        ingredients: [
            '500g de feijão-fradinho',
            '1 cebola média',
            'Sal a gosto',
            'Azeite de dendê para fritar'
        ],
        instructions: [
            'Deixe o feijão de molho por 12 horas.',
            'Descasque o feijão e bata no liquidificador com cebola e sal.',
            'Bata até obter uma massa homogênea e aerada.',
            'Frite em azeite de dendê quente até dourar.',
            'Sirva com vatapá, caruru e camarão seco.'
        ],
        time: '40 min',
        difficulty: 'Difícil',
        servings: '15 unidades'
    },
    '4': {
        id: '4',
        name: 'Fricassé',
        image: 'assets/FRICASSE.png',
        description: 'Fricassé cremoso de frango com milho e batata palha.',
        ingredients: [
            '500g de frango desfiado',
            '1 lata de milho verde',
            '1 lata de creme de leite',
            '100g de batata palha',
            '200g de mussarela ralada',
            '1 cebola picada'
        ],
        instructions: [
            'Refogue a cebola e adicione o frango desfiado.',
            'Misture o milho e o creme de leite.',
            'Coloque em um refratário e cubra com mussarela.',
            'Leve ao forno até gratinar.',
            'Finalize com batata palha por cima.'
        ],
        time: '35 min',
        difficulty: 'Fácil',
        servings: '4 porções'
    }
};

// Sistema de Pesquisa
// Sistema de Pesquisa SIMPLES E EFICAZ
function iniciarPesquisa() {
    const campoPesquisa = document.getElementById('searchInput');
    const receitas = document.querySelectorAll('.receitas');
    
    // Carregar última pesquisa do localStorage
    const ultimaPesquisa = localStorage.getItem('ultimaPesquisa') || '';
    campoPesquisa.value = ultimaPesquisa;
    
    // Aplicar filtro se houver última pesquisa
    if (ultimaPesquisa) {
        filtrarReceitas(ultimaPesquisa, receitas);
    }
    
    // Pesquisa em tempo real
    campoPesquisa.addEventListener('input', function(e) {
        const termoPesquisa = e.target.value.toLowerCase().trim();
        
        // Salvar no localStorage
        localStorage.setItem('ultimaPesquisa', termoPesquisa);
        
        // Filtrar receitas
        filtrarReceitas(termoPesquisa, receitas);
    });
    
    // Limpar com Escape
    campoPesquisa.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            limparPesquisa();
        }
    });
}

    // Função para executar a pesquisa
    function executarPesquisa() {
        const termo = searchInput.value.toLowerCase().trim();
        const receitas = document.querySelectorAll(".receitas");
        let encontrouResultados = false;

        // Se o campo estiver vazio, mostrar todas as receitas
        if (termo === '') {
            receitas.forEach(receita => {
                receita.style.display = "";
                // Restaurar texto original (remover marcações)
                const textoOriginal = receita.querySelector("p").textContent;
                receita.querySelector("p").textContent = textoOriginal;
            });
            
            const mensagemSemResultados = document.querySelector(".no-results");
            if (mensagemSemResultados) {
                mensagemSemResultados.remove();
            }
            return;
        }

        receitas.forEach(receita => {
            const nomeElement = receita.querySelector("p");
            const nomeOriginal = nomeElement.textContent;
            const nome = nomeOriginal.toLowerCase();
            
            // Busca por qualquer parte do nome (mais flexível)
            const corresponde = nome.includes(termo);
            
            if (corresponde) {
                receita.style.display = "";
                encontrouResultados = true;
                
                // Destacar o texto encontrado
                const regex = new RegExp(`(${termo})`, 'gi');
                const textoDestacado = nomeOriginal.replace(regex, '<mark style="background-color: #E27D60; color: white; padding: 2px 4px; border-radius: 3px;">$1</mark>');
                nomeElement.innerHTML = textoDestacado;
            } else {
                receita.style.display = "none";
                // Garantir que o texto volte ao normal
                nomeElement.textContent = nomeOriginal;
            }
        });

        // Mostrar mensagem se não houver resultados
        const recipesContainer = document.getElementById("recipes-container");
        let mensagemSemResultados = recipesContainer.querySelector(".no-results");
        
        if (!encontrouResultados && termo !== '') {
            if (!mensagemSemResultados) {
                mensagemSemResultados = document.createElement('div');
                mensagemSemResultados.className = 'no-results';
                mensagemSemResultados.style.textAlign = 'center';
                mensagemSemResultados.style.padding = '2rem';
                mensagemSemResultados.style.color = '#666';
                
                mensagemSemResultados.innerHTML = `
                    <i class="bi bi-search" style="font-size: 3rem; color: #E27D60; margin-bottom: 1rem;"></i>
                    <p style="font-size: 1.2rem; margin-bottom: 0.5rem;">Nenhuma receita encontrada para "<strong style="color: #E27D60;">${termo}</strong>"</p>
                    <p style="font-size: 0.9rem; margin-top: 0.5rem;">Dica: tente buscar por palavras mais simples</p>
                `;
                recipesContainer.appendChild(mensagemSemResultados);
            } else {
                // Atualizar o termo na mensagem existente
                mensagemSemResultados.innerHTML = `
                    <i class="bi bi-search" style="font-size: 3rem; color: #E27D60; margin-bottom: 1rem;"></i>
                    <p style="font-size: 1.2rem; margin-bottom: 0.5rem;">Nenhuma receita encontrada para "<strong style="color: #E27D60;">${termo}</strong>"</p>
                    <p style="font-size: 0.9rem; margin-top: 0.5rem;">Dica: tente buscar por palavras mais simples</p>
                `;
            }
        } else {
            receita.style.display = 'none';
        }
    }

    // Evento de input (digitação) - BUSCA EM TEMPO REAL
    searchInput.addEventListener("input", executarPesquisa);

// Mostrar mensagem de nenhum resultado
function mostrarMensagem(encontrouResultados, termoPesquisa) {
    // Remover mensagem anterior
    const mensagemAnterior = document.querySelector('.sem-resultados');
    if (mensagemAnterior) {
        mensagemAnterior.remove();
    }
    
    // Adicionar nova mensagem se não encontrou resultados
    if (!encontrouResultados && termoPesquisa) {
        const divDireita = document.querySelector('.right');
        const mensagem = document.createElement('div');
        mensagem.className = 'sem-resultados';
        mensagem.innerHTML = `
            <p>Nenhuma receita encontrada para "<strong>${termoPesquisa}</strong>"</p>
        `;
        divDireita.appendChild(mensagem);
    }
}

    // Limpar pesquisa com ESC
    searchInput.addEventListener("keyup", function(e) {
        if (e.key === "Escape") {
            this.value = "";
            executarPesquisa();
            this.focus();
        }
        if (e.key === "Enter") {
            executarPesquisa();
        }
    });
    
    // Remover mensagem
    const mensagem = document.querySelector('.sem-resultados');
    if (mensagem) {
        mensagem.remove();
    }
}

    // Focar no input quando a função for chamada
    searchInput.focus();

    console.log("✅ Sistema de pesquisa EFICAZ inicializado!");
}

// Iniciar quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    adicionarEstilos();
    iniciarPesquisa();
});

// Salvar dados das receitas no localStorage
function saveRecipeData() {
    localStorage.setItem('recipesData', JSON.stringify(RECIPES_DATA));
}

// Redirecionar para página de detalhes
function redirectToRecipeDetails(recipeId) {
    // Salvar a receita selecionada no localStorage
    localStorage.setItem('selectedRecipe', recipeId);
    // Redirecionar para a página de detalhes
    window.location.href = 'detalhes-receita.php';
}

// Sistema de Favoritos
const FAVORITES_KEY = "userFavorites";

// Inicializar favoritos
function initializeFavorites() {
    if (!localStorage.getItem(FAVORITES_KEY)) {
        const defaultFavorites = [];
        localStorage.setItem(FAVORITES_KEY, JSON.stringify(defaultFavorites));
    }
}

// Obter lista de favoritos
function getFavorites() {
    return JSON.parse(localStorage.getItem(FAVORITES_KEY)) || [];
}

// Salvar favoritos
function saveFavorites(favorites) {
    localStorage.setItem(FAVORITES_KEY, JSON.stringify(favorites));
}

// Verificar se uma receita é favorita
function isFavorite(recipeId) {
    const favorites = getFavorites();
    return favorites.some((fav) => fav.id === recipeId);
}

// Adicionar aos favoritos
function addToFavorites(recipeId, recipeName, recipeImage) {
    const favorites = getFavorites();
    if (!isFavorite(recipeId)) {
        favorites.push({
            id: recipeId,
            name: recipeName,
            image: recipeImage,
        });
        saveFavorites(favorites);
        return true;
    }
    return false;
}

// Remover dos favoritos
function removeFromFavorites(recipeId) {
    let favorites = getFavorites();
    favorites = favorites.filter((fav) => fav.id !== recipeId);
    saveFavorites(favorites);
}

// Alternar favorito
function toggleFavorite(recipeId, recipeName, recipeImage) {
    if (isFavorite(recipeId)) {
        removeFromFavorites(recipeId);
        return false;
    } else {
        addToFavorites(recipeId, recipeName, recipeImage);
        return true;
    }
}

// Atualizar visual dos corações
function updateHeartsVisual() {
    document.querySelectorAll(".receitas").forEach((recipeElement) => {
        const recipeId = recipeElement.getAttribute("data-id");
        const heartIcon = recipeElement.querySelector(".bi-heart");

        if (isFavorite(recipeId)) {
            heartIcon.classList.add("bi-heart-fill", "favorite-heart");
            heartIcon.classList.remove("bi-heart");
        } else {
            heartIcon.classList.add("bi-heart");
            heartIcon.classList.remove("bi-heart-fill", "favorite-heart");
        }
    });
}

// Inicializar a página
document.addEventListener("DOMContentLoaded", function () {
    console.log("🚀 Inicializando página...");
    
    initializeFavorites();
    updateHeartsVisual();
    saveRecipeData();
    iniciarPesquisa();
    loadUserRecipesInHome(); 

    // Adicionar evento de clique nas receitas (imagem e nome)
    document.querySelectorAll('.receitas img, .desc p').forEach(element => {
        element.addEventListener('click', function() {
            const recipeElement = this.closest('.receitas');
            const recipeId = recipeElement.getAttribute('data-id');
            redirectToRecipeDetails(recipeId);
        });
    });

    // Configurar eventos dos corações
    document.querySelectorAll(".bi-heart, .bi-heart-fill").forEach((heart) => {
        heart.addEventListener("click", function (e) {
            e.stopPropagation();

            const recipeId = this.getAttribute("data-id");
            const recipeElement = this.closest(".receitas");
            const recipeName = recipeElement.querySelector("p").textContent;
            const recipeImage = recipeElement.querySelector("img").src;

            const isNowFavorite = toggleFavorite(recipeId, recipeName, recipeImage);

            // Atualizar visual do coração
            if (isNowFavorite) {
                this.classList.add("bi-heart-fill", "favorite-heart");
                this.classList.remove("bi-heart");
            } else {
                this.classList.add("bi-heart");
                this.classList.remove("bi-heart-fill", "favorite-heart");
            }

            // Feedback visual
            this.style.transform = "scale(1.3)";
            setTimeout(() => {
                this.style.transform = "scale(1)";
            }, 300);
        });
    });

    // Funcionalidade do menu lateral
    const sidebar = document.getElementById("sidebar");
    const openBtn = document.getElementById("openBtn");
    const closeBtn = document.getElementById("closeBtn");

    openBtn.addEventListener("click", function () {
        sidebar.classList.add("active");
    });

    closeBtn.addEventListener("click", function () {
        sidebar.classList.remove("active");
    });

    // Fechar sidebar ao clicar fora
    document.addEventListener("click", function (event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnOpenBtn = openBtn.contains(event.target);

        if (!isClickInsideSidebar && !isClickOnOpenBtn && sidebar.classList.contains("active")) {
            sidebar.classList.remove("active");
        }
    });

    console.log("✅ Página inicializada com sucesso!");
});

// Menu lateral
openBtn.addEventListener("click", () => {
    sidebar.classList.add("active");
    openBtn.style.display = "none";
});

closeBtn.addEventListener("click", () => {
    openBtn.style.display = "block";
    sidebar.classList.remove("active");
});

// Carregar receitas do usuário na home
function loadUserRecipesInHome() {
    const userRecipes = JSON.parse(localStorage.getItem('userRecipes')) || [];
    const recipesContainer = document.getElementById('recipes-container');
    
    userRecipes.forEach(recipe => {
        const recipeElement = document.createElement('div');
        recipeElement.className = 'receitas';
        recipeElement.setAttribute('data-id', recipe.id);
        recipeElement.innerHTML = `
            <img src="${recipe.image || 'assets/default-recipe.png'}" alt="${recipe.name}" onerror="this.src='assets/default-recipe.png'">
            <div class="desc">
                <p>${recipe.name}</p>
                <i class="bi bi-heart" data-id="${recipe.id}"></i>
            </div>
        `;
        recipesContainer.appendChild(recipeElement);
    });
    
    // Re-aplicar event listeners para as novas receitas
    applyRecipeEventListeners();
}

// Aplicar event listeners para todas as receitas
function applyRecipeEventListeners() {
    // Evento de clique nas receitas (imagem e nome)
    document.querySelectorAll('.receitas img, .desc p').forEach(element => {
        element.addEventListener('click', function() {
            const recipeElement = this.closest('.receitas');
            const recipeId = recipeElement.getAttribute('data-id');
            redirectToRecipeDetails(recipeId);
        });
    });
} 