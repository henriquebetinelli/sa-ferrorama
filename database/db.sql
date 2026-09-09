<<<<<<< HEAD
CREATE DATABASE sa_ferrorama;
=======
CREATE DATABASE sa_ferrorama
>>>>>>> 479e46981d2d358ab8c45e571b0b4682e8132536
USE sa_ferrorama;

CREATE TABLE usuario (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nome_usuario VARCHAR(150) NOT NULL,
  cpf VARCHAR(11) NOT NULL UNIQUE,
  data_nascimento DATE NOT NULL,
  genero VARCHAR(30),
  telefone VARCHAR(20),
  email VARCHAR(150) NOT NULL UNIQUE,
  senha VARCHAR(150) NOT NULL,
  cargo VARCHAR(50) NOT NULL,
  cep VARCHAR(8),
<<<<<<< HEAD
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
=======
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
>>>>>>> 479e46981d2d358ab8c45e571b0b4682e8132536
);

CREATE TABLE trem (
  id_trem INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  modelo VARCHAR(100) NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'ativo',
<<<<<<< HEAD
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
=======
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
>>>>>>> 479e46981d2d358ab8c45e571b0b4682e8132536
);

CREATE TABLE sensor (
  id_sensor INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  localizacao VARCHAR(150),
  tipo_dado VARCHAR(50) NOT NULL,
  descricao TEXT,
<<<<<<< HEAD
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
=======
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
>>>>>>> 479e46981d2d358ab8c45e571b0b4682e8132536
);

CREATE TABLE sessao (
  id_sessao INT AUTO_INCREMENT PRIMARY KEY,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  expira_em TIMESTAMP NOT NULL,
  ativo BOOLEAN NOT NULL DEFAULT TRUE,
  id_usuario INT NOT NULL,

  CONSTRAINT fk_sessao_usuario
    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE leitura_sensor (
  id_leitura_sensor INT AUTO_INCREMENT PRIMARY KEY,
  velocidade DECIMAL(10,2),
  coletado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_sensor INT NOT NULL,
  id_trem INT NOT NULL,

  CONSTRAINT fk_leitura_sensor
    FOREIGN KEY (id_sensor)
    REFERENCES sensor(id_sensor)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,

  CONSTRAINT fk_leitura_trem
    FOREIGN KEY (id_trem)
    REFERENCES trem(id_trem)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);

<<<<<<< HEAD
=======

>>>>>>> 479e46981d2d358ab8c45e571b0b4682e8132536
CREATE TABLE falha (
  id_falha INT AUTO_INCREMENT PRIMARY KEY,
  tipo_falha VARCHAR(100) NOT NULL,
  descricao TEXT,
  severidade VARCHAR(30) NOT NULL,
  detectado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_trem INT NOT NULL,
  id_sensor INT,

  CONSTRAINT fk_falha_trem
    FOREIGN KEY (id_trem)
    REFERENCES trem(id_trem)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,

  CONSTRAINT fk_falha_sensor
    FOREIGN KEY (id_sensor)
    REFERENCES sensor(id_sensor)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);

CREATE TABLE relatorio (
  id_relatorio INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(150) NOT NULL,
  tipo VARCHAR(50) NOT NULL,
  periodo_inicio DATE,
  periodo_fim DATE,
  conteudo_json JSON,
  gerado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  id_usuario INT NOT NULL,
  id_trem INT,

  CONSTRAINT fk_relatorio_usuario
    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,

  CONSTRAINT fk_relatorio_trem
    FOREIGN KEY (id_trem)
    REFERENCES trem(id_trem)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);