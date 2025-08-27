<?php
require_once '../backend/check_auth.php';
require_once '../backend/conexao.php';
checkAuth();

$pdo = mysqlConnect();

// Busca funcionários
$stmt_func = $pdo->query("SELECT Nome, Email, EstadoCivil, DataNascimento, Funcao, UltimoLogin FROM Funcionario ORDER BY Nome");
$funcionarios = $stmt_func->fetchAll();

// Busca médicos
$stmt_med = $pdo->query("SELECT Nome, Especialidade, CRM FROM Medico ORDER BY Nome");
$medicos = $stmt_med->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Interno - Equipe</title>
    <link rel="icon" type="image/png" href="../images/icon_verde_final.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_interno.css">
</head>
<body>
    <header class="main-header">
        <nav>
            <div class="nav-container">
                <a href="cadastro.php" class="logo">Painel Administrativo Innovare</a>
                <button class="hamburger-menu" aria-label="Abrir Menu" aria-expanded="false"><span></span><span></span><span></span></button>
                <ul class="nav-links">
                    <li><a href="../index.html">Voltar ao Site</a></li>
                    <li><a href="../backend/logout.php" class="cta-button nav-button" id="logout-btn">Sair</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="split-container">
        <section class="team-column">
            <h2>Funcionários</h2>
            <div class="card-list">
                <?php foreach ($funcionarios as $funcionario): ?>
                <div class="team-card employee-card">
                    <h3><?= htmlspecialchars($funcionario['Nome']) ?></h3>
                    <span class="role"><?= htmlspecialchars($funcionario['Funcao']) ?></span>
                    <ul class="details-list">
                        <li><span>Email:</span><span><?= htmlspecialchars($funcionario['Email']) ?></span></li>
                        <li><span>Estado Civil:</span><span><?= htmlspecialchars($funcionario['EstadoCivil']) ?></span></li>
                        <li><span>Nascimento:</span><span><?= date('d/m/Y', strtotime($funcionario['DataNascimento'])) ?></span></li>
                        <li><span>Último Login:</span><span><?= $funcionario['UltimoLogin'] ? date('d/m/Y H:i:s', strtotime($funcionario['UltimoLogin'])) : 'Nunca' ?></span></li>
                    </ul>
                </div>
                <?php endforeach; ?>
                <?php if (empty($funcionarios)): ?>
                    <p>Nenhum funcionário cadastrado.</p>
                <?php endif; ?>
            </div>
        </section>
        <section class="team-column">
            <h2>Médicos</h2>
            <div class="card-list">
                <?php foreach ($medicos as $medico): ?>
                    <?php
                    // --- LÓGICA PARA FORMATAR O CRM ---
                    $crm_original = $medico['CRM']; // Pega o valor do banco, ex: "123456/MG"
                    $crm_formatado = $crm_original; // Define um valor padrão

                    // Verifica se o formato esperado (com "/") existe
                    if (strpos($crm_original, '/') !== false) {
                        $partes = explode('/', $crm_original); // Divide a string em duas partes: [0] => número, [1] => UF
                        if (count($partes) == 2) {
                            $numero = trim($partes[0]);
                            $uf = trim($partes[1]);
                            // Monta a string no novo formato
                            $crm_formatado = 'CRM/' . $uf . ' ' . $numero; // Ex: "CRM/MG 123456"
                        }
                    }
                    // --- FIM DA LÓGICA ---
                    ?>
                <div class="team-card doctor-card">
                    <h3><?= htmlspecialchars($medico['Nome']) ?></h3>
                    <span class="specialty"><?= htmlspecialchars($medico['Especialidade']) ?></span>
                    <span class="crm"><?= htmlspecialchars($crm_formatado) ?></span>
                </div>
                <?php endforeach; ?>
                <?php if (empty($medicos)): ?>
                    <p>Nenhum médico cadastrado.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <script src="js/script_cadastro.js"></script>
    <script src="js/script_interno.js"></script>
</body>
</html>