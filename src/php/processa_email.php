<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $mensagem = filter_var($_POST['text'], FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido.");
    }

    $para = "zbro2018@gmail.com"; 
    $assunto = "Novo Contato - Formulário de Serviço";

    $corpo = "Você recebeu um novo contato do formulário:\n\n";
    $corpo .= "Nome: " . $nome . "\n";
    $corpo .= "E-mail: " . $email . "\n";
    $corpo .= "Telefone/WhatsApp: " . $telefone . "\n";
    $corpo .= "Mensagem: " . $mensagem . "\n";

    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($para, $assunto, $corpo, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Tente novamente!.";
    }
}

?>
