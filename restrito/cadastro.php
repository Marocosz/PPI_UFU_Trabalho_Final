<?php
require_once '../backend/check_auth.php';
checkAuth();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito - Innovare Medical Center</title>

    <link rel="icon" type="image/png" href="../images/icon_verde_final.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/style_cadastro.css"> 
    </head>

<body>

    <header class="main-header">
        <nav>
            <div class="nav-container">
                <a href="cadastro.php" class="logo">Painel Administrativo Innovare</a>
                
                <button class="hamburger-menu" aria-label="Abrir Menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <ul class="nav-links">
                    <li><a href="../index.html">Voltar ao Site</a></li>
                    <li><a href="../backend/logout.php" class="cta-button nav-button" id="logout-btn">Sair</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="panel-container">
            <div class="panel-card" id="open-employee-modal">
                <div class="icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h2>Cadastro de Funcionário</h2>
            </div>

            <div class="panel-card" id="open-doctor-modal">
                <div class="icon">
                    <i class="bi bi-heart-pulse-fill"></i>
                </div>
                <h2>Cadastro de Médico</h2>
            </div>

            <div class="panel-card" id="internal-list-panel">
                <div class="icon">
                    <i class="bi bi-list-ul"></i>
                </div>
                <h2>Lista Interna</h2>
            </div>

            <div class="panel-card" id="external-list-panel">
                <div class="icon">
                    <i class="bi bi-list-ul"></i>
                </div>
                <h2>Lista Externa</h2>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="employee-modal">
        <div class="modal-content">
            <span class="close-button" id="close-employee-modal">&times;</span>
            <h3>Novo Funcionário</h3>
            <form class="modal-form" id="employee-form" action="../backend/cadastrar_funcionario.php" method="POST">
                <div class="form-group">
                    <label for="emp-nome">Nome Completo</label>
                    <input type="text" id="emp-nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="emp-email">E-mail</label>
                    <input type="email" id="emp-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="emp-senha">Senha</label>
                    <input type="password" id="emp-senha" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="emp-estado-civil">Estado Civil</label>
                    <select id="emp-estado-civil" name="estadoCivil" required>
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Solteiro(a)">Solteiro(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                        <option value="Divorciado(a)">Divorciado(a)</option>
                        <option value="Viúvo(a)">Viúvo(a)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="emp-nascimento">Data de Nascimento</label>
                    <input type="date" id="emp-nascimento" name="dataNascimento" required>
                </div>
                <div class="form-group">
                    <label for="emp-funcao">Função</label>
                    <input type="text" id="emp-funcao" name="funcao" placeholder="Ex: Recepcionista, TI, Administrativo" required>
                </div>
                <button type="submit" class="cta-button">Cadastrar Funcionário</button>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="doctor-modal">
        <div class="modal-content">
            <span class="close-button" id="close-doctor-modal">&times;</span>
            <h3>Novo Médico</h3>
            <form class="modal-form" id="doctor-form" action="../backend/cadastrar_medico.php" method="POST">
                <div class="form-group">
                    <label for="med-nome">Nome Completo</label>
                    <input type="text" id="med-nome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="med-especialidade">Especialidade</label>
                    <select id="med-especialidade" name="especialidade" required>
                        <option value="" disabled selected>Selecione...</option>
                        <option value="Cardiologia">Cardiologia</option>
                        <option value="Dermatologia">Dermatologia</option>
                        <option value="Ortopedia">Ortopedia</option>
                        <option value="Pediatria">Pediatria</option>
                        <option value="Ginecologia">Ginecologia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="med-crm">CRM</label>
                    <input type="text" id="med-crm" name="crm" placeholder="Ex: 123456/MG" required pattern="\d+/[A-Z]{2}">
                </div>
                <button type="submit" class="cta-button">Cadastrar Médico</button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const msg = urlParams.get('msg');
        let messageText = '';

        if (status === 'success_func') {
            messageText = 'Funcionário cadastrado com sucesso!';
        } else if (status === 'success_med') {
            messageText = 'Médico cadastrado com sucesso!';
        } else if (status === 'error') {
            if (msg === 'EmailDuplicado') messageText = 'Erro: Este e-mail já está em uso.';
            else if (msg === 'CRMDuplicado') messageText = 'Erro: Este CRM já está em uso.';
            else messageText = 'Erro: Preencha todos os campos obrigatórios.';
        }

        if (messageText) {
            alert(messageText);
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
    </script>
    
    <script src="js/script_cadastro.js"></script>
</body>
</html>