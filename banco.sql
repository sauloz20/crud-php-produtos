CREATE DATABASE IF NOT EXISTS crud_produtos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE crud_produtos;

CREATE TABLE IF NOT EXISTS produtos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    descricao TEXT NOT NULL,
    categoria ENUM('Eletrônicos', 'Informática', 'Acessórios', 'Casa') NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT UNSIGNED NOT NULL DEFAULT 0,
    ano INT NOT NULL,
    status ENUM('Ativo', 'Inativo') NOT NULL DEFAULT 'Ativo',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
