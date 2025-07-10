// Seleciona os elementos para abrir os modais
const openEmployeeModalBtn = document.getElementById('open-employee-modal');
const openDoctorModalBtn = document.getElementById('open-doctor-modal');

// Seleciona os modais
const employeeModal = document.getElementById('employee-modal');
const doctorModal = document.getElementById('doctor-modal');

// Seleciona os botões para fechar os modais
const closeEmployeeModalBtn = document.getElementById('close-employee-modal');
const closeDoctorModalBtn = document.getElementById('close-doctor-modal');

// Função para abrir um modal
function openModal(modal) {
    if (modal) modal.classList.add('active');
}

// Função para fechar um modal
function closeModal(modal) {
    if (modal) modal.classList.remove('active');
}

// Eventos para abrir os modais
openEmployeeModalBtn.addEventListener('click', () => openModal(employeeModal));
openDoctorModalBtn.addEventListener('click', () => openModal(doctorModal));

// Eventos para fechar os modais com os botões 'X'
closeEmployeeModalBtn.addEventListener('click', () => closeModal(employeeModal));
closeDoctorModalBtn.addEventListener('click', () => closeModal(doctorModal));

// Evento para fechar o modal clicando fora da área de conteúdo
[employeeModal, doctorModal].forEach(modal => {
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeModal(modal);
        }
    });
});

// Previne o envio real do formulário (apenas para demonstração)
document.getElementById('employee-form').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Funcionário cadastrado com sucesso! (Demonstração)');
    closeModal(employeeModal);
});

document.getElementById('doctor-form').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Médico cadastrado com sucesso! (Demonstração)');
    closeModal(doctorModal);
});