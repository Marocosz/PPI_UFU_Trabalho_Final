// Aguarda o carregamento completo do HTML antes de executar o script
document.addEventListener('DOMContentLoaded', function() {

    // Seleciona os elementos do menu hambúrguer e da lista de links
    const hamburger = document.querySelector('.hamburger-menu');
    const navLinks = document.querySelector('.nav-links');

    // Verifica se os elementos foram encontrados antes de adicionar o evento
    if (hamburger && navLinks) {
        // Adiciona um evento de 'click' ao botão hambúrguer
        hamburger.addEventListener('click', () => {
            // Alterna a classe 'active' na lista de links (mostra/esconde o menu)
            navLinks.classList.toggle('active');
            
            // Alterna a classe 'active' no botão (anima para 'X')
            hamburger.classList.toggle('active');

            // Atualiza o atributo aria-expanded para acessibilidade
            const isExpanded = hamburger.getAttribute('aria-expanded') === 'true';
            hamburger.setAttribute('aria-expanded', !isExpanded);
        });
    }

});