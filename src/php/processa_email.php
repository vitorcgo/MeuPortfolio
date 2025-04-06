<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $mensagem = filter_var($_POST['text'], FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "erro";
        exit;
    }

    $para = "admin@vitorgomes.tech"; 
    $assunto = "Novo Contato - Formulário de Serviço";
    $corpo = "Você recebeu um novo contato:\n\n";
    $corpo .= "Nome: $nome\nE-mail: $email\nTelefone: $telefone\nMensagem: $mensagem\n";
    $headers = "From: $email\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

    if (mail($para, $assunto, $corpo, $headers)) {
        echo "sucesso";
    } else {
        echo "erro";
    }
}
?>
