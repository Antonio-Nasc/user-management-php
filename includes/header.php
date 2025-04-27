<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container-header">
        <div id="row-header" class="d-flex justify-content-between align-items-center">
            <img src="assets/img/logoAlfama.png" alt="ALFAMA WEB" class="logo-header">
            <div class="position-relative">
                <img src="assets/img/icon-menu.png" alt="Menu" class="menuToggle" id="menuToggle">
                <div id="menuOptions" class="position-absolute start-50 translate-middle-x mt-2 bg-white shadow rounded d-none">
                    <a href="logout.php" class="dropdown-item text-center">Sair</a>
                </div>
            </div>

        </div>
    </div>

    <!-- abrir/fechar o menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const menuOptions = document.getElementById('menuOptions');

            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                menuOptions.classList.toggle('d-none');
            });

            menuOptions.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            document.addEventListener('click', function() {
                menuOptions.classList.add('d-none');
            });
        });
    </script>
</body>

</html>