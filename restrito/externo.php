<?php
require_once '../backend/check_auth.php';
require_once '../backend/conexao.php';
checkAuth();

$pdo = mysqlConnect();
$sql_agend = <<<SQL
    SELECT a.Datahora, m.Nome AS NomeMedico, p.Nome AS NomePaciente
    FROM Agendamento a
    JOIN Medico m ON a.CodigoMedico = m.Codigo
    JOIN Paciente p ON a.CodigoPaciente = p.Codigo
    ORDER BY a.Datahora DESC
SQL;
$stmt_agend = $pdo->query($sql_agend);
$agendamentos = $stmt_agend->fetchAll();
$stmt_cont = $pdo->query("SELECT Nome, Email, Telefone, Mensagem, Datahora FROM Contato ORDER BY Datahora DESC");
$contatos = $stmt_cont->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle - Registros</title>
    <link rel="icon" type="image/png" href="../images/icon_verde_final.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_externo.css">
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
    <main class="admin-container">
        <section class="data-section">
            <h2>Pedidos de Agendamento</h2>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead><tr><th>Data e Hora</th><th>Médico</th><th>Paciente</th></tr></thead>
                    <tbody>
                        <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($agendamento['Datahora'])) ?></td>
                            <td><?= htmlspecialchars($agendamento['NomeMedico']) ?></td>
                            <td><?= htmlspecialchars($agendamento['NomePaciente']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($agendamentos)): ?>
                            <tr><td colspan="3">Nenhum agendamento encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="data-section">
            <h2>Mensagens de Contato</h2>
            <div class="message-list">
                <?php foreach ($contatos as $contato): ?>
                <div class="message-card">
                    <div class="message-header">
                        <span class="author"><span>Nome:</span> <?= htmlspecialchars($contato['Nome']) ?></span>
                        <span class="contact-info"><span>Email:</span> <?= htmlspecialchars($contato['Email']) ?></span>
                        <span class="contact-info"><span>Telefone:</span> <?= htmlspecialchars($contato['Telefone']) ?></span>
                    </div>
                    <div class="message-body"><p><?= htmlspecialchars($contato['Mensagem']) ?></p></div>
                    <div class="message-footer"><span>Recebido em: <?= date('d/m/Y H:i', strtotime($contato['Datahora'])) ?></span></div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($contatos)): ?>
                    <p>Nenhuma mensagem de contato encontrada.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <script src="js/script_cadastro.js"></script>
    <script src="js/script_externo.js"></script>
</body>
</html>