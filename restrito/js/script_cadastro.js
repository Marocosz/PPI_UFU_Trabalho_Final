document.addEventListener('DOMContentLoaded', function() {

    // Lógica para menu hambúrguer e botão de logout
    const hamburger = document.querySelector('.hamburger-menu');
    const navLinks = document.querySelector('.nav-links');
    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    }

    const logoutButton = document.getElementById('logout-btn');
    if (logoutButton) {
        logoutButton.addEventListener('click', (event) => {
            event.preventDefault(); 
            window.location.href = logoutButton.href; // O href já aponta para o script de logout
        });
    }

    // Lógica para a página de cadastro (modais e navegação)
    const cadastroPanel = document.getElementById('open-employee-modal');
    if (cadastroPanel) {
        const openDoctorModalBtn = document.getElementById('open-doctor-modal');
        const employeeModal = document.getElementById('employee-modal');
        const doctorModal = document.getElementById('doctor-modal');
        const closeEmployeeModalBtn = document.getElementById('close-employee-modal');
        const closeDoctorModalBtn = document.getElementById('close-doctor-modal');

        const openModal = (modal) => modal.classList.add('active');
        const closeModal = (modal) => modal.classList.remove('active');

        cadastroPanel.addEventListener('click', () => openModal(employeeModal));
        openDoctorModalBtn.addEventListener('click', () => openModal(doctorModal));
        
        document.getElementById('internal-list-panel').addEventListener('click', () => window.location.href = 'interno.php');
        document.getElementById('external-list-panel').addEventListener('click', () => window.location.href = 'externo.php');

        closeEmployeeModalBtn.addEventListener('click', () => closeModal(employeeModal));
        closeDoctorModalBtn.addEventListener('click', () => closeModal(doctorModal));
        employeeModal.addEventListener('click', (e) => { if (e.target === employeeModal) closeModal(employeeModal); });
        doctorModal.addEventListener('click', (e) => { if (e.target === doctorModal) closeModal(doctorModal); });
        
        // IMPORTANTE: Nenhuma lógica de submissão de formulário via "fetch" está aqui.
    }
});