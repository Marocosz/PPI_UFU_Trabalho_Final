// Espera o documento HTML ser completamente carregado para executar o script
document.addEventListener('DOMContentLoaded', function() {

    // --- SELEÇÃO DOS ELEMENTOS ---
    
    // Painéis que funcionam como botões
    const openEmployeeModalBtn = document.getElementById('open-employee-modal');
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
    openEmployeeModalBtn.addEventListener('click', () => {
        openModal(employeeModal);
    });

    // 2. Abrir Modal de Cadastro de Médico
    openDoctorModalBtn.addEventListener('click', () => {
        openModal(doctorModal);
    });

    // 3. Redirecionar para a página de Lista Interna
    internalListBtn.addEventListener('click', () => {
        // ATENÇÃO: Altere 'lista_interna.html' para o nome real da sua página.
        window.location.href = 'lista_interna.html';
    });

    // 4. Redirecionar para a página de Lista Externa
    externalListBtn.addEventListener('click', () => {
        // ATENÇÃO: Altere 'lista_externa.html' para o nome real da sua página.
        window.location.href = 'lista_externa.html';
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

});