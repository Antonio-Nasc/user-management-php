<?php
require_once 'controllers/auth.php';

// Verificar se o usuário já está logado
if (isLoggedIn()) {
    header('Location: profile.php');
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
                    <h2 class="form-title">Criar conta</h2>

                    <button class="btn-google" type="button">
                        <img src="assets/img/imageGoogle.png" alt="Google" height="18">
                        <span style="margin-left: 10px;"><strong>Faça login com o google</strong></span>
                    </button>

                    <div class="divider">
                        <span>OU</span>
                    </div>

                    <form id="cadastreForm" class="w-100" action="cadastre_process.php" method="POST">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Nome completo</label>
                            <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Digite seu nome completo:" maxlength="150">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email:" maxlength="150">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Crie uma senha:" maxlength="100">
                            <div class="password-hint"><strong>Inserir mais de 8 caracteres</strong></div>
                        </div>

                        <button type="submit" class="btn-create">Criar conta</button>
                    </form>

                    <div class="login-link">
                        <strong>
                            Já tem uma conta? <a href="login.php" style="text-decoration: underline;">Faça login</a>
                        </strong>
                    </div>
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
        document.getElementById('cadastreForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            const response = await fetch('cadastre_process.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = 'profile.php';
            } else {
                alert(result.message); // Mostra erro se deu ruim
            }
        });
    </script>
</body>

</html>