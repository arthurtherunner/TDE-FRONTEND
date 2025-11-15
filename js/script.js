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