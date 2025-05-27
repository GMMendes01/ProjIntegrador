CREATE DATABASE IF NOT EXISTS banco2;
use banco2;

CREATE table cadastro(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    sobrenome VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(50) NOT NULL
);
CREATE TABLE reciclagem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    codigo_barras VARCHAR(13) NOT NULL,
    nome_produto VARCHAR(255) NOT NULL,
    material VARCHAR(50) NOT NULL,
    quantidade INT NOT NULL,
    pontos INT NOT NULL,
    data_registro DATETIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);