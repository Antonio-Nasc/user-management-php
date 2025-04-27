<?php
require_once 'controllers/auth.php';
require_once 'controllers/user.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

// Obter dados do usuário
$userData = getUserData($_SESSION['user_id']);

include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.getElementById('phone');
        const taxIdInput = document.getElementById('tax_id');

        function maskPhone(value) {
            value = value.replace(/\D/g, ''); // Remove tudo que não for número
            value = value.replace(/^(\d{2})(\d)/g, '($1) $2'); // Coloca parênteses em volta dos dois primeiros dígitos
            value = value.replace(/(\d{5})(\d)/, '$1-$2'); // Coloca hífen depois dos cinco dígitos
            return value;
        }

        function maskTaxId(value) {
            value = value.replace(/\D/g, '');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            return value;
        }

        phoneInput.addEventListener('input', function(e) {
            e.target.value = maskPhone(e.target.value);
        });

        taxIdInput.addEventListener('input', function(e) {
            e.target.value = maskTaxId(e.target.value);
        });

        // Impedir que digitem letras ou outros símbolos
        phoneInput.addEventListener('keypress', function(e) {
            if (!/\d/.test(e.key)) {
                e.preventDefault();
            }
        });

        taxIdInput.addEventListener('keypress', function(e) {
            if (!/\d/.test(e.key)) {
                e.preventDefault();
            }
        });
    });
</script>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4 position-relative" style="width: 150px; margin: 0 auto;">
            <img src="assets/img/woman.png"
                alt="Avatar"
                class="rounded-circle"
                width="150" height="150"
                style="object-fit: cover;">

            <img src="assets/img/icon-camera.png"
                alt="Alterar Foto"
                class="position-absolute">
        </div>

        <div class="text-center mt-3">
            <h3 class="fw-bold"><?php echo htmlspecialchars($userData['full_name']); ?></h3>
            <p class="fw-bold"><?php echo htmlspecialchars($userData['company_name'] ?? 'Corretora'); ?></p>
        </div>

        <form id="profileForm" class="mx-auto mt-4" style="max-width: 800px;" action="profile_process.php" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="full_name" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Digite seu nome:" maxlength="150" value="<?php echo htmlspecialchars($userData['full_name']); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email:" maxlength="150" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite seu telefone:" maxlength="15" value="<?php echo htmlspecialchars($userData['phone'] ?? ''); ?>">
                </div>

                <div class="col-md-6">
                    <label for="tax_id" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="tax_id" name="tax_id" placeholder="Digite seu CPF:" maxlength="14" value="<?php echo htmlspecialchars($userData['tax_id'] ?? ''); ?>">
                </div>

                <div class="col-md-6">
                    <label for="company_name" class="form-label">Empresa</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Digite sua empresa:" maxlength="150" value="<?php echo htmlspecialchars($userData['company_name'] ?? ''); ?>">
                </div>

                <div class="col-md-6">
                    <label for="address" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Digite seu endereço:" maxlength="255" value="<?php echo htmlspecialchars($userData['address'] ?? ''); ?>">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn-update">Atualizar cadastro</button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('profileForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            const response = await fetch('profile_process.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = 'profile.php';
            } else {
                alert(result.message);
            }
        });
    </script>
</body>

</html>