-- Banco da loja Tres16
CREATE DATABASE IF NOT EXISTS tres16 DEFAULT CHARACTER SET utf8mb4;
USE tres16;

-- dados pessoais do cliente
CREATE TABLE IF NOT EXISTS usuarios (
    Id       INT AUTO_INCREMENT PRIMARY KEY,
    nome     VARCHAR(100),
    cpf      VARCHAR(20),
    endereco VARCHAR(120),
    bairro   VARCHAR(60),
    cidade   VARCHAR(60),
    estado   VARCHAR(2),
    cep      VARCHAR(15)
);

-- login e senha
CREATE TABLE IF NOT EXISTS acesso (
    Id      INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    senha   VARCHAR(255),
    cpf     VARCHAR(20)
);

-- carrinho de cada usuario
CREATE TABLE IF NOT EXISTS carrinho (
    Id      INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    produto VARCHAR(120),
    preco   VARCHAR(20),
    imagem  VARCHAR(120)
);

-- vendas (uma linha por produto)
CREATE TABLE IF NOT EXISTS vendas (
    Id        INT AUTO_INCREMENT PRIMARY KEY,
    numero    VARCHAR(20),
    usuario   VARCHAR(50),
    cpf       VARCHAR(20),
    produto   VARCHAR(120),
    valor     VARCHAR(20),
    pagamento VARCHAR(20),
    data      VARCHAR(20)
);
