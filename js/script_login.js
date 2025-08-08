
// Esboço da nova funcionalidade (enviar um alerta de login via email para o usuário) 
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".login-form-wrapper form");

    // Criar um elemento para exibir mensagens
    const msgErro = document.createElement("p");
    msgErro.id = "mensagem-erro";
    msgErro.style.color = "red";
    msgErro.style.fontWeight = "bold";
    msgErro.style.marginTop = "10px";
    form.appendChild(msgErro);

    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const email = document.getElementById("email").value.trim();
        const senha = document.getElementById("senha").value();
        const dispositivo = navigator.userAgent;
        const horaAcesso = new Date().toLocaleString("pt-BR");

        const dados = { email, senha, dispositivo, horaAcesso };

        try {
            const resposta = await fetch("login.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(dados)
            });

            const resultado = await resposta.json();

            if (resultado.sucesso) {
                window.location.href = "restrito/cadastro.html";
            } else {
                // Mostra mensagem na tela
                msgErro.textContent = resultado.mensagem || "Erro no login.";
                console.log(resultado.mensagem);
            }
        } catch (erro) {
            msgErro.textContent = "Erro na comunicação com o servidor.";
            console.error("Erro na comunicação com o servidor:", erro);
        }
    });
});
