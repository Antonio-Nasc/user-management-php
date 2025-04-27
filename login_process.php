<?php
require_once 'controllers/auth.php';

// Verificar se é uma requisição AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
        exit;
    }
    
    // Tentar fazer login
    $result = loginUser($email, $password);
    echo json_encode($result);
} else {
    header('Location: login.php');
    exit;
}
?>