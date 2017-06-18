CREATE TABLE usuario (
	  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    login VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    data_inclusao TIMESTAMP NOT NULL DEFAULT NOW(),

    CONSTRAINT login_unique UNIQUE(login),
    CONSTRAINT email_unique UNIQUE(email)
);

CREATE TABLE jogo (
	  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    plataforma VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco FLOAT NOT NULL,
    data_inclusao TIMESTAMP NOT NULL DEFAULT NOW(),
    id_usuario_inclusao INT NOT NULL,
    imagem VARCHAR(100),

    CONSTRAINT fk_usuario_jogo FOREIGN KEY (id_usuario_inclusao) REFERENCES usuario(id)
);

CREATE TABLE venda (
	  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    data_inclusao TIMESTAMP NOT NULL DEFAULT NOW(),
    id_usuario INT NOT NULL,

    CONSTRAINT fk_usuario_venda FOREIGN KEY (id_usuario) REFERENCES usuario(id)
);

CREATE TABLE jogo_venda (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_jogo INT NOT NULL,
    id_venda INT NOT NULL,

    CONSTRAINT fk_jogo_jogo_venda FOREIGN KEY (id_jogo) REFERENCES jogo(id),
    CONSTRAINT fk_venda_jogo_venda FOREIGN KEY (id_venda) REFERENCES venda(id)
);