<?php
require_once 'controllers/auth.php';

// Verificar se é uma requisição AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($full_name) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
        exit;
    }
    
    if (strlen($password) <= 8) {
        echo json_encode(['success' => false, 'message' => 'A senha deve ter pelo menos 9 caracteres.']);
        exit;
    }
    
    $userData = [
        'full_name' => $full_name,
        'email' => $email,
        'password' => $password
    ];
    
    $result = registerUser($userData);
    echo json_encode($result);
} else {
    // Redirecionar se não for uma requisição POST
    header('Location: cadastre.php');
    exit;
}
?>