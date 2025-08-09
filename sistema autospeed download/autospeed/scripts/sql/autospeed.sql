CREATE DATABASE autospeed;
USE autospeed;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL, -- armazenaremos a senha criptografada
    tipo ENUM('admin', 'mecanico') DEFAULT 'mecanico');

-- Clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco TEXT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Fornecedores
CREATE TABLE fornecedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco TEXT
);

ALTER TABLE contas_pagar ADD COLUMN fornecedor_id INT;

-- Produtos / Peças
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2),
    quantidade INT DEFAULT 0
);

-- Serviços
CREATE TABLE servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco_base DECIMAL(10,2)
);

-- Mecânicos
CREATE TABLE mecanicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    especialidade VARCHAR(100)
);

-- Orçamentos
CREATE TABLE orcamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    mecanico_id INT,
    descricao_problema TEXT,
    laudo_tecnico TEXT,
    observacoes TEXT,
    valor_total DECIMAL(10,2),
    status ENUM('pendente', 'aprovado', 'recusado') DEFAULT 'pendente',
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (mecanico_id) REFERENCES mecanicos(id)
);

ALTER TABLE contas_receber ADD COLUMN orcamento_id INT;

-- Itens do orçamento
CREATE TABLE orcamento_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT,
    produto_id INT,
    servico_id INT,
    quantidade INT DEFAULT 1,
    preco_unitario DECIMAL(10,2),
    FOREIGN KEY (orcamento_id) REFERENCES orcamentos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id)
);

-- Agendamentos
CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT,
    data_agendada DATE,
    hora TIME,
    status ENUM('agendado', 'realizado', 'cancelado') DEFAULT 'agendado',
    FOREIGN KEY (orcamento_id) REFERENCES orcamentos(id)
);

-- Contas a pagar
CREATE TABLE contas_pagar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao TEXT,
    valor DECIMAL(10,2),
    data_vencimento DATE,
    data_pagamento DATE,
    status ENUM('pendente', 'pago') DEFAULT 'pendente'
);

-- Contas a receber
CREATE TABLE contas_receber (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    valor DECIMAL(10,2),
    data_vencimento DATE,
    data_recebimento DATE,
    status ENUM('pendente', 'recebido') DEFAULT 'pendente',
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

-- Movimentações financeiras
CREATE TABLE movimentacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('entrada', 'saida') NOT NULL,
    valor DECIMAL(10,2),
    descricao TEXT,
    data_movimentacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Comissões dos mecânicos
CREATE TABLE comissoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mecanico_id INT,
    servico_id INT,
    valor DECIMAL(10,2),
    data_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mecanico_id) REFERENCES mecanicos(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id)
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orcamento_id INT,
    data_agendada DATE,
    hora TIME,
    status ENUM('agendado', 'realizado', 'cancelado') DEFAULT 'agendado',
    FOREIGN KEY (orcamento_id) REFERENCES orcamentos(id)
);


