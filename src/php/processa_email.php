<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização atualizada (sem FILTER_SANITIZE_STRING)
    $nome = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefone = htmlspecialchars($_POST['telefone'], ENT_QUOTES, 'UTF-8');
    $mensagem = htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8');

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "erro_email_invalido";
        exit;
    }

    // Configura o e-mail
    $para = "admin@vitorgomes.tech";
    $assunto = "Novo Contato - Formulario de Servico!";
    $corpo = "Nome: $nome\n";
    $corpo .= "E-mail: $email\n";
    $corpo .= "Telefone: $telefone\n";
    $corpo .= "Mensagem: $mensagem\n";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Envia o e-mail
    if (mail($para, $assunto, $corpo, $headers)) {
        echo "sucesso";
    } else {
        echo "erro_envio";
    }
} else {
    echo "erro_metodo_invalido";
}
?>