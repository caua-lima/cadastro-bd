<?php

// Inclui o arquivo de conexão com o banco de dados para permitir a execução de operações no banco.
include 'conexao.php';

// Verifica se o método da requisição HTTP é POST, ou seja, se o formulário foi enviado.
// Isso garante que o código a seguir só será executado quando houver envio de dados do formulário.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebe o valor campo 'nome' do formulário e o armazena na variável $nome
    $nome = $_POST['nome'];

    // Recebe o valor do campo 'email' do formulário e o armazena na variável $email.
    $email = $_POST['email'];

    // Recebe o valor do campo 'senha' do formulário.
    // Aplica a criptografia da senha usando password_hash
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    //Prepara a instrução SQL para inserir os valores ($nome, $email, $senha) na tabela 'usuarios'.
    // Utiliza placeholders (?) para proteger contra injeções SQL.
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");

    // Executa a instrução SQL preparada, passando os valores do $nome, $email, $senha para os placeholders.
    // O método execute() retorna true se a inserção for bem-sucedida e false se ocorrer um erro.
    if ($stmt->execute([$nome, $email, $senha])){

        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso.
        echo "Usuário registrado com sucesso.";
    } else{

        // Se ocorrer um erro, exibe uma mensagem de erro seguida de detalhes sobre o erro.
        // implode() converte o array retornado por errorInfo() em uma string, facilitando a exibição dos detalhes do erro.
        echo "Erro ao registrar o usuário" . implode(",", $stmt->errorInfo());
    }
}
