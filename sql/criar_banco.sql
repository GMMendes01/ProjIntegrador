CREATE DATABASE IF NOT EXISTS banco2;
use banco2;

CREATE table cadastro(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    sobrenome VARCHAR(50),
    email VARCHAR(100),
    senha VARCHAR(50)
);