<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telefone = filter_var($_POST['telefone'], FILTER_SANITIZE_STRING);
    $mensagem = filter_var($_POST['text'], FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido.");
    }

    $para = "admin@vitorgomes.tech"; 
    $assunto = "Novo Contato - Formulário de Serviço";

    $corpo = "Você recebeu um novo contato do formulário:\n\n";
    $corpo .= "Nome: " . $nome . "\n";
    $corpo .= "E-mail: " . $email . "\n";
    $corpo .= "Telefone/WhatsApp: " . $telefone . "\n";
    $corpo .= "Mensagem: " . $mensagem . "\n";

    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    $sucesso = mail($para, $assunto, $corpo, $headers);

    echo '
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Mensagem</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: "' . ($sucesso ? 'success' : 'error') . '",
                title: "' . ($sucesso ? 'Mensagem enviada!' : 'Erro ao enviar') . '",
                text: "' . ($sucesso ? 'Em breve entrarei em contato com você.' : 'Tente novamente mais tarde.') . '",
                confirmButtonText: "Ok"
            }).then(() => {
                window.location.href = "https://vitorgomes.tech";
            });
        </script>
    </body>
    </html>';
}
?>