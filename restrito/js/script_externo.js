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

    async function popularAgendamentos() {
        const agendamentos = await fetchData('../../backend/get_agendamentos.php');
        if (!agendamentos) return;

        const tbody = document.querySelector('.data-table tbody');
        tbody.innerHTML = '';
        agendamentos.forEach(ag => {
            tbody.innerHTML += `
                <tr>
                    <td>${new Date(ag.Datahora).toLocaleString('pt-BR')}</td>
                    <td>${ag.NomeMedico}</td>
                    <td>${ag.NomePaciente}</td>
                </tr>
            `;
        });
    }

    async function popularContatos() {
        const contatos = await fetchData('../../backend/get_contatos.php');
        if (!contatos) return;

        const list = document.querySelector('.message-list');
        list.innerHTML = '';
        contatos.forEach(ct => {
            list.innerHTML += `
                <div class="message-card">
                    <div class="message-header">
                        <span class="author"><strong>Nome:</strong> ${ct.Nome}</span>
                        <span class="contact-info"><strong>Email:</strong> ${ct.Email}</span>
                        <span class="contact-info"><strong>Telefone:</strong> ${ct.Telefone}</span>
                    </div>
                    <div class="message-body"><p>${ct.Mensagem}</p></div>
                    <div class="message-footer">
                        <span>Recebido em: ${new Date(ct.Datahora).toLocaleString('pt-BR')}</span>
                    </div>
                </div>
            `;
        });
    }

    popularAgendamentos();
    popularContatos();
});