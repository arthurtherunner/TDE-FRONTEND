<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/home.css">
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
                            <h2>Olá, Camila!</h2>
                        </div>

                        <ul class="menu">
                            <li><a href="#"><i class="bi bi-house-door"></i> Início</a></li>
                            <li><a href="#"><i class="bi bi-book"></i> Minhas receitas</a></li>
                            <li><a href="#"><i class="bi bi-bookmark"></i> Favoritos</a></li>
                            <li><a href="#"><i class="bi bi-person-square"></i> Perfil</a></li>
                        </ul>
                    </div>
                    

                    <ul class="logout">
                        <li><a href="#"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
                    </ul>
            </nav>
            <button id="openBtn" class="open-btn">
                <i class="bi bi-list"></i>
            </button>
            <div class="right-total">
                <div class="search-container">
                        <input type="text" placeholder="Pesquisar receita..." id="searchInput">
                        <i class="bi bi-search"></i>
                </div>
                <div class="right">
                    
                    <div class="receitas">
                        <img src="assets/BOLO DE CHOCOLATE.png" alt="">
                        <div class="desc"><p>Bolo de chocolate</p>
                        <i class="bi bi-heart-fill"></i>
                        </div>
                    </div>

                    <div class="receitas">
                        <img src="assets/LASANHA.png" alt="">
                        <div class="desc"><p>Lasanha</p>
                        <i class="bi bi-heart-fill"></i>
                        </div>
                    </div>
                    
                    <div class="receitas">
                        <img src="assets/ACARAJIVIS.png" alt="">
                        <div class="desc"><p>Massa de acarajé</p>
                        <i class="bi bi-heart-fill"></i>
                        </div>
                    </div>

                    <div class="receitas">
                        <img src="assets/FRICASSE.png" alt="">
                        <div class="desc"><p>Fricassé</p>
                        <i class="bi bi-heart-fill"></i>
                        </div>
                    </div>
                
                </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openBtn');
        const closeBtn = document.getElementById('closeBtn');
        

        openBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
            openBtn.style.display = 'none';
        });

        closeBtn.addEventListener('click', () => {
            openBtn.style.display = 'block';
            sidebar.classList.remove('active');
        });
    </script>
</body>
</html>