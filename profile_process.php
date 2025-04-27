<?php
require_once 'controllers/auth.php';
require_once 'controllers/user.php';

if (!isLoggedIn()) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $tax_id = $_POST['tax_id'] ?? '';
    $company_name = $_POST['company_name'] ?? '';
    $address = $_POST['address'] ?? '';

    // Na parte de perfil, caso o usuário queira atualizar os dados, todos os campos são obrigatórios
    if (empty($full_name) || empty($email) || empty($phone) || empty($tax_id) || empty($company_name) || empty($address)) {
        echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
        exit;
    }

    $userData = [
        'full_name' => $full_name,
        'email' => $email,
        'phone' => $phone,
        'tax_id' => $tax_id,
        'company_name' => $company_name,
        'address' => $address
    ];

    $result = updateUserData($_SESSION['user_id'], $userData);
    echo json_encode($result);
} else {
    header('Location: profile.php');
    exit;
}
