// sistema de favoritos
const FAVORITES_KEY = 'userFavorites';

// função para obter lista de favoritos
function getFavorites() {
    return JSON.parse(localStorage.getItem(FAVORITES_KEY)) || [];
}

// função para remover receita dos favoritos
function removeFromFavorites(recipeId) {
    let favorites = getFavorites();
    favorites = favorites.filter(fav => fav.id !== recipeId);
    localStorage.setItem(FAVORITES_KEY, JSON.stringify(favorites));
    return favorites;
}

// função para adicionar receita aos favoritos
function addToFavorites(recipeId, recipeName, recipeImage) {
    const favorites = getFavorites();
    if (!isFavorite(recipeId)) {
        favorites.push({
            id: recipeId,
            name: recipeName,
            image: recipeImage,
        });
        localStorage.setItem(FAVORITES_KEY, JSON.stringify(favorites));
        return true;
    }
    return false;
}

// função para verificar se receita é favorita
function isFavorite(recipeId) {
    const favorites = getFavorites();
    return favorites.some(fav => fav.id === recipeId);
}

// função para alternar entre favoritar/desfavoritar
function toggleFavorite(recipeId, recipeName, recipeImage) {
    if (isFavorite(recipeId)) {
        removeFromFavorites(recipeId);
        return false;
    } else {
        addToFavorites(recipeId, recipeName, recipeImage);
        return true;
    }
}

// função para inicializar favoritos se não existirem
function initializeFavorites() {
    if (!localStorage.getItem(FAVORITES_KEY)) {
        const defaultFavorites = [];
        localStorage.setItem(FAVORITES_KEY, JSON.stringify(defaultFavorites));
    }
}

// função para redirecionar para detalhes da receita
function redirectToRecipeDetails(recipeId) {
    // salva a receita selecionada no localStorage
    localStorage.setItem('selectedRecipe', recipeId);
    // direciona para a pag de detalhes
    window.location.href = 'detalhes-receita.php';
}

// carregar e exibir receitas favoritas
function loadFavorites() {
    const favoritesContainer = document.getElementById('favorites-container');
    const favorites = getFavorites();
    
    if (favorites.length === 0) {
        favoritesContainer.innerHTML = `
            <div class="no-favorites">
                <i class="bi bi-heart"></i>
                <p>Voce ainda não tem receitas favoritas</p>
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

    // event listeners para redirecionamento imagem e nome da receita
    document.querySelectorAll('.receitas img, .desc p').forEach(element => {
        element.addEventListener('click', function(e) {  
            if (e.target.closest('.desc i')) return;
       
            
            const recipeElement = this.closest('.receitas');
            const recipeId = recipeElement.getAttribute('data-id');
            redirectToRecipeDetails(recipeId);
        });
    });
    
    // event listeners para remover dos favoritos com o coração
    document.querySelectorAll('.desc i').forEach(heart => {
        heart.addEventListener('click', function(e) {
            e.stopPropagation(); // pra nao ser o mesmo com as fotos
            
            const recipeId = this.getAttribute('data-id');
            const recipeElement = this.closest('.receitas');
            
            // remover dos favoritos
            const updatedFavorites = removeFromFavorites(recipeId);
            
            // só estilizar
            this.style.transform = 'scale(1.3)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 300);
            
            // recarregar a lista
            if (updatedFavorites.length === 0) {
                loadFavorites();
            } else {
                recipeElement.remove();
            }
        });
    });
}

// pesquisar receitas favoritas
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

    // event listeners para redirecionamento na pesquisa imagem e nome da receita
    document.querySelectorAll('.receitas img, .desc p').forEach(element => {
        element.addEventListener('click', function(e) {
            if (e.target.closest('.desc i')) return;
            
            const recipeElement = this.closest('.receitas');
            const recipeId = recipeElement.getAttribute('data-id');
            redirectToRecipeDetails(recipeId);
        });
    });
    
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

// atualizar visual dos corações (útil para outras páginas)
function updateHeartsVisual() {
    document.querySelectorAll(".receitas").forEach((recipeElement) => {
        const recipeId = recipeElement.getAttribute("data-id");
        const heartIcon = recipeElement.querySelector(".bi-heart");

        if (heartIcon) {
            if (isFavorite(recipeId)) {
                heartIcon.classList.add("bi-heart-fill", "favorite-heart");
                heartIcon.classList.remove("bi-heart");
            } else {
                heartIcon.classList.add("bi-heart");
                heartIcon.classList.remove("bi-heart-fill", "favorite-heart");
            }
        }
    });
}

// inicializar a pag
document.addEventListener('DOMContentLoaded', function() {
    // garantir que favoritos estão inicializados
    initializeFavorites();
    
    // carregar favoritos na página
    loadFavorites();
    
    const sidebar = document.getElementById('sidebar');
    const openBtn = document.getElementById('openBtn');
    const closeBtn = document.getElementById('closeBtn');
    const searchInput = document.getElementById('searchInput');
    
    // funcionalidade da sidebar
    openBtn.addEventListener('click', function() {
        sidebar.classList.add('active');
    });
    
    closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('active');
    });
    
    // pesquisar receitas
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        if (query) {
            searchFavorites(query);
        } else {
            loadFavorites();
        }
    });
    
    // fechar sidebar qnd clicar fora
    document.addEventListener('click', function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnOpenBtn = openBtn.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickOnOpenBtn && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }
    });
});