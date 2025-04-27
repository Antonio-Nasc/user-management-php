<?php
require_once 'config/database.php';

function getUserData($userId) {
    $conn = getConnection();
    
    $userId = $conn->real_escape_string($userId);
    
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function updateUserData($userId, $userData) {
    $conn = getConnection();
    
    $userId = $conn->real_escape_string($userId);
    $full_name = $conn->real_escape_string($userData['full_name']);
    $email = $conn->real_escape_string($userData['email']);
    $phone = $conn->real_escape_string($userData['phone']);
    $tax_id = $conn->real_escape_string($userData['tax_id']);
    $company_name = $conn->real_escape_string($userData['company_name']);
    $address = $conn->real_escape_string($userData['address']);
    
    // Verificar se o email já existe para outro usuário
    $checkEmail = $conn->query("SELECT id FROM users WHERE email = '$email' AND id != '$userId'");
    if ($checkEmail->num_rows > 0) {
        return ['success' => false, 'message' => 'Este email já está sendo usado por outro usuário.'];
    }
    
    $sql = "UPDATE users SET 
            full_name = '$full_name', 
            email = '$email', 
            phone = '$phone', 
            tax_id = '$tax_id', 
            company_name = '$company_name', 
            address = '$address' 
            WHERE id = '$userId'";
    
    if ($conn->query($sql)) {
        $_SESSION['user_name'] = $full_name;
        $_SESSION['user_email'] = $email;
        
        return ['success' => true, 'message' => 'Dados atualizados com sucesso!'];
    } else {
        return ['success' => false, 'message' => 'Erro ao atualizar dados: ' . $conn->error];
    }
}
?>