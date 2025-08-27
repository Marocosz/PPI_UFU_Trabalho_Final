document.addEventListener('DOMContentLoaded', () => {
    const especialidadeSelect = document.getElementById('especialidade');
    const medicoSelect = document.getElementById('medico');

    function carregarEspecialidades() {
        fetch('backend/get_especialidades.php')
            .then(response => response.json())
            .then(especialidades => {
                especialidadeSelect.innerHTML = '<option value="" disabled selected>Escolha a Especialidade</option>';
                especialidades.forEach(espec => {
                    const option = document.createElement('option');
                    option.value = espec;
                    option.textContent = espec;
                    especialidadeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Falha ao carregar especialidades:', error);
                especialidadeSelect.innerHTML = '<option value="">Falha ao carregar</option>';
            });
    }

    function carregarMedicos() {
        const especialidade = especialidadeSelect.value;
        medicoSelect.innerHTML = '<option value="" disabled selected>Carregando...</option>';
        medicoSelect.disabled = true;

        if (!especialidade) {
            medicoSelect.innerHTML = '<option value="" disabled selected>Escolha uma especialidade</option>';
            return;
        }

        fetch(`backend/get_medicos.php?especialidade=${encodeURIComponent(especialidade)}`)
            .then(response => response.json())
            .then(medicos => {
                medicoSelect.innerHTML = '<option value="" disabled selected>Escolha o Médico(a)</option>';
                medicos.forEach(medico => {
                    const option = document.createElement('option');
                    option.value = medico.id;
                    option.textContent = medico.nome;
                    medicoSelect.appendChild(option);
                });
                medicoSelect.disabled = false;
            })
            .catch(error => {
                console.error('Falha ao carregar médicos:', error);
                medicoSelect.innerHTML = '<option value="">Falha ao carregar</option>';
            });
    }

    if (especialidadeSelect) {
        especialidadeSelect.addEventListener('change', carregarMedicos);
        carregarEspecialidades();
    }
});