<?php
require_once 'controllers/auth.php';

// Verificar se o usuário já está logado
if (isLoggedIn()) {
    header('Location: profile.php');
    exit;
}

// Processar login via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    header('Content-Type: application/json');

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = loginUser($email, $password);
    echo json_encode($result);
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Alfama Web</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- lado esquerdo -->
            <div class="col-md-6 form-container">
                <div style="max-height: 70px;" class="d-flex justify-content-between align-items-center">
                    <img src="assets/img/logo1.png" alt="ALFAMA WEB" class="logo">
                    <a href="#" class="know-more"><strong>Saiba mais</strong></a>
                </div>
                <div class="d-flex flex-column align-items-start justify-content-center flex-grow-1 w-90" style="width: 80%; padding-left: 20px;">
                    <h2 class="form-title">Fazer login</h2>

                    <div id="new-account" class="login-link">
                        <strong>
                            Nova conta? <a href="cadastre.php" id="free-register">Cadastre-se gratuitamente</a>
                        </strong>
                    </div>

                    <form class="w-100" id="loginForm" action="login_process.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" maxlength="150" name="email" id="email" placeholder="Digite seu email:">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Crie uma senha:">
                        </div>
                        <div class="mb-3">
                            <a href="" id="free-register" style="text-decoration: none;"><strong>Esqueceu sua senha?</strong></a>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-between gap-3">
                            <button type="submit" class="btn-create">Entrar</button>
                            <button class="btn-google" type="button">
                                <img src="assets/img/imageGoogle.png" alt="Google" height="18">
                                <span style="margin-left: 10px;"><strong>Entrar com a conta google</strong></span>
                            </button>
                        </div>
                    </form>

                </div>
                <div class="auth-links mt-4">
                    <a href="#"><strong id="privacy-policy">Política de Privacidade</strong></a>
                </div>
            </div>

            <!-- lado direito -->
            <?php
            include 'includes/testimonial.php';
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Evita o envio tradicional do formulário

            const formData = new FormData(this);

            const response = await fetch('login_process.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = 'profile.php'; // Redireciona se login foi sucesso
            } else {
                alert(result.message); // Mostra erro se deu ruim
            }
        });
    </script>
</body>

</html>