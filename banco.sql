-- Banco da loja Tres16
CREATE DATABASE IF NOT EXISTS tres16 DEFAULT CHARACTER SET utf8mb4;
USE tres16;

-- login e senha (identidade de acesso do cliente)
CREATE TABLE IF NOT EXISTS acesso (
    Id      INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha   VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- dados pessoais do cliente
CREATE TABLE IF NOT EXISTS usuarios (
    Id       INT AUTO_INCREMENT PRIMARY KEY,
    nome     VARCHAR(100) NOT NULL,
    cpf      VARCHAR(20) NOT NULL UNIQUE,
    endereco VARCHAR(120),
    bairro   VARCHAR(60),
    cidade   VARCHAR(60),
    estado   VARCHAR(2),
    cep      VARCHAR(15),
    usuario  VARCHAR(50) UNIQUE,
    FOREIGN KEY (usuario) REFERENCES acesso(usuario)
) ENGINE=InnoDB;

-- produtos da loja
CREATE TABLE IF NOT EXISTS produtos (
    Id     INT AUTO_INCREMENT PRIMARY KEY,
    nome   VARCHAR(120) NOT NULL UNIQUE,
    preco  DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(120) NOT NULL
) ENGINE=InnoDB;

-- carrinho de cada usuario
CREATE TABLE IF NOT EXISTS carrinho (
    Id         INT AUTO_INCREMENT PRIMARY KEY,
    usuario    VARCHAR(50) NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    FOREIGN KEY (usuario) REFERENCES acesso(usuario),
    FOREIGN KEY (produto_id) REFERENCES produtos(Id),
    CHECK (quantidade > 0)
) ENGINE=InnoDB;

-- vendas (uma linha por produto vendido; produto e valor ficam
-- gravados como estavam no momento da compra, mesmo que o produto
-- mude de preco ou seja removido do catalogo depois)
CREATE TABLE IF NOT EXISTS vendas (
    Id        INT AUTO_INCREMENT PRIMARY KEY,
    numero    VARCHAR(20) NOT NULL,
    usuario   VARCHAR(50) NOT NULL,
    cpf       VARCHAR(20) NOT NULL,
    produto   VARCHAR(120) NOT NULL,
    valor     DECIMAL(10,2) NOT NULL,
    pagamento VARCHAR(20) NOT NULL,
    data      DATETIME NOT NULL,
    FOREIGN KEY (usuario) REFERENCES acesso(usuario)
) ENGINE=InnoDB;

-- avaliacoes dos produtos pelos clientes
CREATE TABLE IF NOT EXISTS avaliacoes (
    Id             INT AUTO_INCREMENT PRIMARY KEY,
    usuario        VARCHAR(50) NOT NULL,
    produto        VARCHAR(120) NOT NULL,
    nota           INT NOT NULL,
    comentario     TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario) REFERENCES acesso(usuario),
    CHECK (nota BETWEEN 1 AND 5)
) ENGINE=InnoDB;


-- ===================== POVOAMENTO =====================

INSERT INTO produtos (nome, preco, imagem) VALUES
('GOD LOVES YOU', 94.90, 'img/2.jpeg'),
('KING', 79.90, 'img/3.jpeg'),
('O AMOR ME AMOU PRIMEIRO', 109.90, 'img/5.jpeg'),
('O AMOR ME AMOU', 89.90, 'img/7.jpeg'),
('NADA É IMPOSSÍVEL PARA DEUS', 94.90, 'img/13.jpeg'),
('AVIVA-NOS', 109.90, 'img/15.jpeg'),
('DAS MINHAS FERIDAS FEZ NASCER', 99.90, 'img/17.jpeg'),
('ILUMINADA', 99.90, 'img/19.jpeg'),
('DEUS ESTÁ CONOSCO', 89.90, 'img/21.jpeg'),
('DIGNO', 129.90, 'img/23.jpeg');

-- senha de todas as contas de teste abaixo: 123
INSERT INTO acesso (usuario, senha) VALUES
('paranhos', '$2y$12$Caocb8/zHKVGqIkgkWSysuERG7PpkcqDb0vUou/nX0vhG8TYyAup2'),
('paulino',  '$2y$12$Es0HeDxinKXgL8PWd24ubOQGJ1tfA3w1FlQQ0nLo6kJAdVdqTDy86'),
('joao',   '$2y$12$2OH7zb6EtESAPeiZm8wHaOliaAAUzp9OyR7lGIP7CFslL/wk5VYoS');

INSERT INTO usuarios (nome, cpf, endereco, bairro, cidade, estado, cep, usuario) VALUES
('Paranhos', '11122233344', 'Rua das Flores, 120', 'Centro', 'Eunápolis', 'BA', '45820000', 'paranhos'),
('Paulino', '22233344455', 'Av. Brasil, 45', 'Vivendas', 'Eunápolis', 'BA', '45821000', 'paulino'),
('João', '33344455566', 'Rua 13 de Maio, 90', 'Doutor Gusmão', 'Eunápolis', 'BA', '45822000', 'joao');

INSERT INTO carrinho (usuario, produto_id, quantidade) VALUES
('paranhos', 5, 1);

INSERT INTO vendas (numero, usuario, cpf, produto, valor, pagamento, data) VALUES
('1001', 'paranhos', '11122233344', 'KING', 79.90, 'PIX', '2026-08-10 14:30:00'),
('1001', 'paranhos', '11122233344', 'DIGNO', 129.90, 'PIX', '2026-08-10 14:30:00'),
('1002', 'paulino', '22233344455', 'GOD LOVES YOU', 189.80, 'Cartão', '2026-08-15 09:12:00'),
('1003', 'joao', '33344455566', 'ILUMINADA', 99.90, 'Cartão', '2026-09-01 18:45:00'),
('1003', 'joao', '33344455566', 'AVIVA-NOS', 109.90, 'Cartão', '2026-09-01 18:45:00'),
('1004', 'paranhos', '11122233344', 'O AMOR ME AMOU', 89.90, 'Boleto', '2026-09-20 11:05:00');

INSERT INTO avaliacoes (usuario, produto, nota, comentario) VALUES
('paranhos', 'KING', 5, 'Muito confortável, tecido excelente.'),
('paulino', 'GOD LOVES YOU', 4, 'Gostei bastante, só achei o caimento um pouco largo.'),
('joao', 'ILUMINADA', 5, 'Amei o brilho da estampa!'),
('paranhos', 'DIGNO', 3, 'Tecido mediano, esperava mais pelo preço.');


-- ===================== CONSULTAS DO SISTEMA =====================

-- 1) Pedidos de um cliente, com os produtos e os valores de cada compra
SELECT
    u.nome AS cliente,
    v.numero AS pedido,
    v.produto,
    v.valor,
    v.pagamento,
    v.data
FROM vendas v
JOIN usuarios u ON u.cpf = v.cpf
WHERE u.nome = 'Paranhos'
ORDER BY v.numero;

-- 2) Produtos mais vendidos em um periodo, com o preco atual no catalogo
SELECT
    v.produto,
    p.preco AS preco_atual,
    COUNT(*) AS vezes_vendido,
    SUM(v.valor) AS total_arrecadado
FROM vendas v
JOIN produtos p ON p.nome = v.produto
WHERE v.data BETWEEN '2026-08-01 00:00:00' AND '2026-09-30 23:59:59'
GROUP BY v.produto, p.preco
ORDER BY vezes_vendido DESC, total_arrecadado DESC;

-- 3) Itens que estao no carrinho de um cliente agora, com preco e subtotal
SELECT
    u.nome AS cliente,
    p.nome AS produto,
    p.preco,
    c.quantidade,
    (p.preco * c.quantidade) AS subtotal
FROM carrinho c
JOIN usuarios u ON u.usuario = c.usuario
JOIN produtos p ON p.Id = c.produto_id
WHERE u.nome = 'Paranhos';

-- 4) Nota media de cada produto avaliado, junto com o preco no catalogo
SELECT
    a.produto,
    p.preco,
    ROUND(AVG(a.nota), 1) AS media_nota,
    COUNT(*) AS total_avaliacoes
FROM avaliacoes a
JOIN produtos p ON p.nome = a.produto
GROUP BY a.produto, p.preco
ORDER BY media_nota DESC;
