// ARQUIVO NOVO

document.addEventListener('DOMContentLoaded', () => {

    async function fetchData(url) {
        const response = await fetch(url);
        if (response.status === 401) {
            alert('Sua sessão expirou. Faça o login novamente.');
            window.location.replace('../../login.html');
            return null;
        }
        if (!response.ok) throw new Error('Falha ao buscar dados');
        return response.json();
    }

    async function popularFuncionarios() {
        const funcionarios = await fetchData('../../backend/get_funcionarios.php');
        if (!funcionarios) return;

        const list = document.querySelector('.team-column:nth-child(1) .card-list');
        list.innerHTML = '';
        funcionarios.forEach(func => {
            list.innerHTML += `
                <div class="team-card employee-card">
                    <h3>${func.Nome}</h3>
                    <span class="role">${func.Funcao}</span>
                    <ul class="details-list">
                        <li><strong>Email:</strong><span>${func.Email}</span></li>
                        <li><strong>Estado Civil:</strong><span>${func.EstadoCivil}</span></li>
                        <li><strong>Nascimento:</strong><span>${new Date(func.DataNascimento + 'T00:00:00').toLocaleDateString('pt-BR')}</span></li>
                    </ul>
                </div>
            `;
        });
    }

    async function popularMedicos() {
        const medicos = await fetchData('../../backend/get_medicos_lista.php');
        if (!medicos) return;

        const list = document.querySelector('.team-column:nth-child(2) .card-list');
        list.innerHTML = '';
        medicos.forEach(med => {
            list.innerHTML += `
                <div class="team-card doctor-card">
                    <h3>${med.Nome}</h3>
                    <span class="specialty">${med.Especialidade}</span>
                    <span class="crm">${med.CRM}</span>
                </div>
            `;
        });
    }

    popularFuncionarios();
    popularMedicos();
});