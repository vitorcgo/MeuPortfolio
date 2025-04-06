<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiza os dados
    $nome = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $mensagem = filter_var($_POST['text'], FILTER_SANITIZE_STRING);

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "erro_email_invalido";
        exit;
    }

    // Configura o e-mail
    $para = "admin@vitorgomes.tech";
    $assunto = "Novo Contato - Formulário de Serviço";
    $corpo = "Nome: $nome\n";
    $corpo .= "E-mail: $email\n";
    $corpo .= "Telefone: $telefone\n";
    $corpo .= "Mensagem: $mensagem\n";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Tenta enviar o e-mail
    if (mail($para, $assunto, $corpo, $headers)) {
        echo "sucesso";
    } else {
        echo "erro_envio";
    }
} else {
    echo "erro_metodo_invalido";
}
?>