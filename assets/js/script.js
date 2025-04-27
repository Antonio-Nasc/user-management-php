$(document).ready(function() {
    // Máscaras para os campos
    $('#phone').mask('(00) 00000-0000');
    $('#tax_id').mask('000.000.000-00');
    
    // Validação do formulário de cadastro
    $('#cadastroForm').submit(function(e) {
        e.preventDefault();
        
        // Validar campos
        let full_name = $('#full_name').val();
        let email = $('#email').val();
        let password = $('#password').val();
        
        if (full_name.trim() === '') {
            showAlert('Por favor, digite seu nome completo.', 'danger');
            return;
        }
        
        if (email.trim() === '' || !isValidEmail(email)) {
            showAlert('Por favor, digite um email válido.', 'danger');
            return;
        }
        
        if (password.trim() === '' || password.length < 8) {
            showAlert('A senha deve ter pelo menos 8 caracteres.', 'danger');
            return;
        }
        
        // Enviar dados via AJAX
        $.ajax({
            url: 'cadastro_process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    setTimeout(function() {
                        window.location.href = 'profile.php';
                    }, 2000);
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Erro ao processar a requisição.', 'danger');
            }
        });
    });
    
    // Validação do formulário de login
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        
        let email = $('#email').val();
        let password = $('#password').val();
        
        if (email.trim() === '' || !isValidEmail(email)) {
            showAlert('Por favor, digite um email válido.', 'danger');
            return;
        }
        
        if (password.trim() === '') {
            showAlert('Por favor, digite sua senha.', 'danger');
            return;
        }
        
        $.ajax({
            url: 'login_process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    setTimeout(function() {
                        window.location.href = 'profile.php';
                    }, 2000);
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Erro ao processar a requisição.', 'danger');
            }
        });
    });
    
    // Validação do formulário de perfil
    $('#perfilForm').submit(function(e) {
        e.preventDefault();
        
        let full_name = $('#full_name').val();
        let email = $('#email').val();
        
        if (full_name.trim() === '') {
            showAlert('Por favor, digite seu nome completo.', 'danger');
            return;
        }
        
        if (email.trim() === '' || !isValidEmail(email)) {
            showAlert('Por favor, digite um email válido.', 'danger');
            return;
        }
        
        $.ajax({
            url: 'perfil_process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Erro ao processar a requisição.', 'danger');
            }
        });
    });
    
    // Função para validar email
    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
    
    // Função para exibir alertas
    function showAlert(message, type) {
        const alertDiv = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                          message +
                          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                          '</div>');
        
        $('.alert-container').html(alertDiv);
        
        // Auto-fechar após 5 segundos
        setTimeout(function() {
            alertDiv.alert('close');
        }, 5000);
    }
});