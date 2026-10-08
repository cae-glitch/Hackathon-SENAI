CREATE DATABASE IF NOT EXISTS edutech_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE edutech_db;

CREATE TABLE IF NOT EXISTS cursos (
    id                    INT AUTO_INCREMENT PRIMARY KEY,   -- identificador único, gerado automaticamente
    nome_curso            VARCHAR(150) NOT NULL,            -- ex.: "Desenvolvimento Web com PHP"
    area_tecnologica      VARCHAR(100) NOT NULL,            -- ex.: "Tecnologia da Informação"
    quantidade_alunos     INT NOT NULL,                     -- número inteiro de alunos
    empresa_patrocinadora VARCHAR(150) NOT NULL             -- ex.: "Empresa XYZ"
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;