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

// Na parte do DOMContentLoaded, adicione:
document.addEventListener('DOMContentLoaded', function() {
    initializeFavorites();
    updateHeartsVisual();
    saveRecipeData(); // Salvar dados das receitas
    
    // Adicionar evento de clique nas receitas (imagem e nome)
    document.querySelectorAll('.receitas img, .desc p').forEach(element => {
        element.addEventListener('click', function() {
            const recipeElement = this.closest('.receitas');
            const recipeId = recipeElement.getAttribute('data-id');
            redirectToRecipeDetails(recipeId);
        });
    });
    
    // ... o resto do seu código existente
});



openBtn.addEventListener("click", () => {
  sidebar.classList.add("active");
  openBtn.style.display = "none";
});

closeBtn.addEventListener("click", () => {
  openBtn.style.display = "block";
  sidebar.classList.remove("active");
});

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
  initializeFavorites();
  updateHeartsVisual();

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

    if (
      !isClickInsideSidebar &&
      !isClickOnOpenBtn &&
      sidebar.classList.contains("active")
    ) {
      sidebar.classList.remove("active");
    }
  });
});
