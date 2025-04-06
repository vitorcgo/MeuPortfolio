const form = document.querySelector("#meu-form"); 

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("/src/php/processa_email.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log("Resposta do PHP:", data); // Debug
            if (data.trim() === "sucesso") {
                Swal.fire({
                    icon: 'success',
                    title: 'Mensagem enviada!',
                    text: 'Em breve o Vitor entrará em contato com você!',
                    background: '#1e1e1e',
                    color: '#fff',
                    iconColor: '#00ff88',
                    confirmButtonColor: '#00ff88'
                });
                form.reset();
            } else if (data.trim() === "erro_email_invalido") {
                Swal.fire({
                    icon: 'error',
                    title: 'E-mail inválido',
                    text: 'Verifique o e-mail digitado.',
                    background: '#1e1e1e',
                    color: '#fff',
                    confirmButtonColor: '#ff4444'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro no envio',
                    text: 'Ocorreu um erro. Tente novamente mais tarde.',
                    background: '#1e1e1e',
                    color: '#fff',
                    confirmButtonColor: '#ff4444'
                });
            }
        })
        .catch(error => {
            console.error("Erro na requisição:", error);
            Swal.fire({
                icon: 'error',
                title: 'Falha na conexão',
                text: 'Verifique sua internet e tente novamente.',
                background: '#1e1e1e',
                color: '#fff',
                confirmButtonColor: '#ff4444'
            });
        });
});