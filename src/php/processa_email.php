<?php

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitiza os dados do formulário
    $nome = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $mensagem = filter_var($_POST['text'], FILTER_SANITIZE_STRING);

    // Valida o e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido.");
    }

    // Defina o destinatário do e-mail (substitua pelo seu e-mail)
    $para = "zbro2018@gmail.com";  // Substitua com seu e-mail
    $assunto = "Novo Contato - Formulário de Serviço";

    // Monta o corpo do e-mail
    $corpo = "Você recebeu um novo contato do formulário:\n\n";
    $corpo .= "Nome: " . $nome . "\n";
    $corpo .= "E-mail: " . $email . "\n";
    $corpo .= "Telefone/WhatsApp: " . $telefone . "\n";
    $corpo .= "Mensagem: " . $mensagem . "\n";

    // Cabeçalhos do e-mail
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envia o e-mail
    if (mail($para, $assunto, $corpo, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem. Tente novamente!.";
    }
}

?>
