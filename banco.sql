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
    cep      VARCHAR(15),
    usuario  VARCHAR(50)
);

-- login e senha
CREATE TABLE IF NOT EXISTS acesso (
    Id      INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    senha   VARCHAR(255)
);

-- produtos da loja
CREATE TABLE IF NOT EXISTS produtos (
    Id     INT AUTO_INCREMENT PRIMARY KEY,
    nome   VARCHAR(120),
    preco  VARCHAR(20),
    imagem VARCHAR(120)
);

-- carrinho de cada usuario
CREATE TABLE IF NOT EXISTS carrinho (
    Id         INT AUTO_INCREMENT PRIMARY KEY,
    usuario    VARCHAR(50),
    produto_id INT,
    quantidade INT DEFAULT 1
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

-- avaliações dos produtos pelos clientes
CREATE TABLE IF NOT EXISTS avaliacoes (

    Id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    produto VARCHAR(120),
    nota INT,
    comentario TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

INSERT INTO produtos (nome, preco, imagem) VALUES
('GOD LOVES YOU', '94,90', 'img/2.jpeg'),
('KING', '79,90', 'img/3.jpeg'),
('O AMOR ME AMOU PRIMEIRO', '109,90', 'img/5.jpeg'),
('O AMOR ME AMOU', '89,90', 'img/7.jpeg'),
('NADA É IMPOSSÍVEL PARA DEUS', '94,90', 'img/13.jpeg'),
('AVIVA-NOS', '109,90', 'img/15.jpeg'),
('DAS MINHAS FERIDAS FEZ NASCER', '99,90', 'img/17.jpeg'),
('ILUMINADA', '99,90', 'img/19.jpeg'),
('DEUS ESTÁ CONOSCO', '89,90', 'img/21.jpeg'),
('DIGNO', '129,90', 'img/23.jpeg');