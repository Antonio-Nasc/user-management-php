CREATE DATABASE IF NOT EXISTS `user_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user_management`;

CREATE TABLE IF NOT EXISTS `users`(
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR (150) NOT NULL,
    email VARCHAR (150) NOT NULL UNIQUE,
    password VARCHAR (100) NOT NULL,
    tax_id VARCHAR (14),
    phone VARCHAR (20),
    address VARCHAR (255),
    company_name VARCHAR (150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `users` (full_name, email, password, tax_id, phone, address, company_name) VALUES
('José Nascimento', 'joseeantonioo2000@gmail.com', '123456', '123456789', '79998020511', 'Bairro Industrial, Rua Alagoas', 'Empresa teste'),
('Carol Oliveira', 'ca_oliveira@gmail.com', '123@456', '123556789', '79887542566', 'Bairro São José, Rua Sergipe', 'Empresa Kaka');