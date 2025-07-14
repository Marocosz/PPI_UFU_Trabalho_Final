// Pega o token de autenticação do armazenamento local.
const userToken = localStorage.getItem('user-token');

// Verifica se o token NÃO existe ou está vazio.
if (!userToken) {
    // Se não houver token, o usuário não está logado.
    alert("Acesso negado. Por favor, faça o login novamente."); // Opcional, mas bom para UX

    // Redireciona para a página de login.
    // Usamos window.location.replace() em vez de .href.
    // O replace() remove a página atual do histórico de navegação,
    // impedindo que o usuário clique em "voltar" e entre em um loop de redirecionamento.
    window.location.replace('../login.html'); // Ajuste o caminho para sua página de login
}