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

// inicio da parte de pesquisa
function iniciarPesquisa() {
    const campoPesquisa = document.getElementById('searchInput');
    const receitas = document.querySelectorAll('.receitas');
    
    // carregar com oq foi salvo no localstorage
    const ultimaPesquisa = localStorage.getItem('ultimaPesquisa') || '';
    campoPesquisa.value = ultimaPesquisa;

    // atualizar em tempo real
    campoPesquisa.addEventListener('input', function(e) {
        const pesquisa = e.target.value.toLowerCase().trim();
        
        // deixar salvo no localstorage
        localStorage.setItem('ultimaPesquisa', pesquisa);
        
        // filtrar receita
        filtrarReceitas(pesquisa, receitas);
    });
    
}

// filtrar receita
function filtrarReceitas(filtroPesquisa, receitas) {
    let encontrouResultados = false;
    
    receitas.forEach(receita => {
        const nomeReceita = receita.querySelector('p').textContent.toLowerCase();
        
        if (nomeReceita.includes(filtroPesquisa)) {
            receita.style.display = 'block';
            encontrouResultados = true;
        } else {
            receita.style.display = 'none';
        }
    });
    
    // mostrar mensagem se não encontrar nada
    mostrarMensagem(encontrouResultados, filtroPesquisa);
}

// mostrar mensagem de nenhum resultado
function mostrarMensagem(encontrouResultados, termoPesquisa) {
    // remove mensagem anterior
    const mensagemAnterior = document.querySelector('.sem-resultados');
    if (mensagemAnterior) {
        mensagemAnterior.remove();
    }
    
    // adicionar nova mensagem se não encontrou resultados
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

// estilo da mensagem
function estilizar() {
    const estilo = document.createElement('style');
    estilo.textContent = `
        .sem-resultados {
            text-align: center;
            padding: 2rem;
            color: #666;
            font-size: 1.1rem;
        }
        
        .sem-resultados strong {
            color: #333;
        }
    `;
    document.head.appendChild(estilo);
}

// iniciar quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    estilizar();
    iniciarPesquisa();
});