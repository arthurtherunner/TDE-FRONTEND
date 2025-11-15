document.getElementById("formCadastro").addEventListener("submit", function(e) {
    let valid = true;

    const nome = document.getElementById("nome");
    const email = document.getElementById("email");
    const senha = document.getElementById("senha");
    const confirmar = document.getElementById("confirmar_senha");

    const erroNome = document.getElementById("erroNome");
    const erroEmail = document.getElementById("erroEmail");
    const erroSenha = document.getElementById("erroSenha");
    const erroConfirmar = document.getElementById("erroConfirmar");

    erroNome.textContent = "";
    erroEmail.textContent = "";
    erroSenha.textContent = "";
    erroConfirmar.textContent = "";

    if (nome.value.trim() === "") {
        erroNome.textContent = "Digite seu nome";
        valid = false;
    }

    if (!email.value.includes("@") || !email.value.includes(".")) {
        erroEmail.textContent = "Digite um email válido";
        valid = false;
    }

    if (senha.value.length < 6) {
        erroSenha.textContent = "A senha deve ter pelo menos 6 caracteres";
        valid = false;
    }

    if (confirmar.value !== senha.value) {
        erroConfirmar.textContent = "As senhas não são iguais";
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
    }
});
