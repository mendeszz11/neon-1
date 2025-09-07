<?php
require_once __DIR__ .'/../data/db_config.php';

$deleteDB = 'DROP DATABASE IF EXISTS '.DB_NAME.';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.';';
$usarDB = 'USE '.DB_NAME.';';

$crearTabela = "
    CREATE TABLE IF NOT EXISTS Tarefas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        descricao TEXT,
        inicio DATE,
        fim DATE,
        `status` ENUM('pendente', 'em andamento', 'concluida') DEFAULT 'pendente',
        createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
";

$insertDados = "
    INSERT INTO Tarefas (titulo, descricao, inicio, fim, `status`) VALUES
    ('Comprar mantimentos', 'Comprar frutas, vegetais e pão', '2024-06-01', '2024-06-01', 'pendente'),
    ('Reunião com equipe', 'Discutir o progresso do projeto', '2024-06-02', '2024-06-02', 'em andamento'),
    ('Enviar relatório', 'Enviar o relatório mensal para o gerente', '2024-06-03', '2024-06-03', 'concluida'),
    ('Limpar a casa', 'Fazer uma limpeza geral na casa', '2024-06-04', '2024-06-04', 'pendente'),
    ('Exercício físico', 'Ir à academia para um treino de 1 hora', '2024-06-05', '2024-06-05', 'em andamento'),
    ('Ler um livro', 'Ler pelo menos 50 páginas do livro atual', '2024-06-06', '2024-06-06', 'concluida'),
    ('Planejar viagem', 'Pesquisar destinos e fazer reservas', '2024-06-07', '2024-06-07', 'pendente'),
    ('Atualizar software', 'Instalar as últimas atualizações do sistema', '2024-06-08', '2024-06-08', 'em andamento'),
    ('Visitar amigos', 'Marcar um encontro com amigos para jantar', '2024-06-09', '2024-06-09', 'concluida'),
    ('Organizar documentos', 'Arquivar documentos importantes e descartar o que não é necessário', '2024-06-10', '2024-06-10', 'pendente');
";

try {
    // Conexão inicial sem banco de dados
    $pdo = new PDO(
        dsn: 'mysql:host='.DB_HOST, 
        username: DB_USER, 
        password: DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Deletar banco de dados se existir
    $pdo->exec(statement: $deleteDB);

    // Criar banco de dados
    $pdo->exec(statement: $criarDB);
    // Selecionar banco de dados
    $pdo->exec(statement: $usarDB);

    // Criar tabela
    $pdo->exec($crearTabela);

    // Inserir dados   
    $pdo->exec(statement: $insertDados);

    echo "Banco de dados, tabela e dados criados com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
