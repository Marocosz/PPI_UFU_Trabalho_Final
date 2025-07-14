// Espera o documento HTML ser completamente carregado para executar o script
document.addEventListener('DOMContentLoaded', function() {

    // ===================================================================
    // --- CÓDIGO GLOBAL (Executado em todas as páginas do painel) ---
    // ===================================================================
    // Este código é seguro para rodar em qualquer página, pois ele
    // verifica se os elementos existem antes de usá-los.

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

    // Adiciona a funcionalidade de logout ao botão "Sair"
    const logoutButton = document.getElementById('logout-btn');

    if (logoutButton) {
        logoutButton.addEventListener('click', (event) => {
            // Previne o comportamento padrão do link para executar o logout primeiro
            event.preventDefault();

            // Limpa os dados de autenticação do armazenamento local
            localStorage.removeItem('user-token');
            localStorage.removeItem('isLoggedIn');

            // Redireciona para a página de login após limpar os dados
            window.location.href = logoutButton.href;
        });
    }


    // ===========================================================================
    // --- CÓDIGO ESPECÍFICO (Executado APENAS na página de cadastro) ---
    // ===========================================================================
    // Agora, verificamos se estamos na página de cadastro. Se estivermos,
    // executamos o código restante que é específico para ela.

    const cadastroPanel = document.getElementById('open-employee-modal');
    
    // Se este painel existir, sabemos que estamos na página de cadastro.
    if (cadastroPanel) {

        // --- SELEÇÃO DOS ELEMENTOS (Específicos da página de cadastro) ---
        
        // Painéis que funcionam como botões (o primeiro já foi selecionado)
        const openDoctorModalBtn = document.getElementById('open-doctor-modal');
        const internalListBtn = document.getElementById('internal-list-panel');
        const externalListBtn = document.getElementById('external-list-panel');

        // Modais e seus overlays
        const employeeModal = document.getElementById('employee-modal');
        const doctorModal = document.getElementById('doctor-modal');

        // Botões de fechar dos modais
        const closeEmployeeModalBtn = document.getElementById('close-employee-modal');
        const closeDoctorModalBtn = document.getElementById('close-doctor-modal');
        
        // --- FUNÇÕES REUTILIZÁVEIS PARA ABRIR E FECHAR MODAIS ---

        /**
         * Adiciona a classe 'active' para exibir um modal.
         * @param {HTMLElement} modal O elemento do modal a ser aberto.
         */
        function openModal(modal) {
            if (modal) {
                modal.classList.add('active');
            }
        }

        /**
         * Remove a classe 'active' para esconder um modal.
         * @param {HTMLElement} modal O elemento do modal a ser fechado.
         */
        function closeModal(modal) {
            if (modal) {
                modal.classList.remove('active');
            }
        }

        // --- EVENTOS DE CLIQUE PARA OS PAINÉIS ---

        // 1. Abrir Modal de Cadastro de Funcionário
        cadastroPanel.addEventListener('click', () => {
            openModal(employeeModal);
        });

        // 2. Abrir Modal de Cadastro de Médico
        openDoctorModalBtn.addEventListener('click', () => {
            openModal(doctorModal);
        });

        // 3. Redirecionar para a página de Lista Interna
        internalListBtn.addEventListener('click', () => {
            window.location.href = 'interno.html';
        });

        // 4. Redirecionar para a página de Lista Externa
        externalListBtn.addEventListener('click', () => {
            window.location.href = 'externo.html';
        });

        // --- EVENTOS PARA FECHAR OS MODAIS ---

        // Fechar modal de funcionário pelo botão 'x'
        closeEmployeeModalBtn.addEventListener('click', () => {
            closeModal(employeeModal);
        });

        // Fechar modal de médico pelo botão 'x'
        closeDoctorModalBtn.addEventListener('click', () => {
            closeModal(doctorModal);
        });
        
        // Fechar o modal clicando fora da caixa de conteúdo (no overlay)
        employeeModal.addEventListener('click', (event) => {
            // Se o alvo do clique for o próprio overlay (fundo), fecha o modal
            if (event.target === employeeModal) {
                closeModal(employeeModal);
            }
        });

        doctorModal.addEventListener('click', (event) => {
            if (event.target === doctorModal) {
                closeModal(doctorModal);
            }
        });
    }

});