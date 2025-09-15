<?php
require_once __DIR__ .'/../data/db_config.php';

$deleteDB = 'DROP DATABASE IF EXISTS '.DB_NAME.';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '.DB_NAME.';';
$usarDB = 'USE '.DB_NAME.';';

// Corrigido para garantir que a tabela seja criada corretamente
$crearTabela = "
    CREATE TABLE IF NOT EXISTS `Show` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        `show` VARCHAR(255) NOT NULL,
        descricao TEXT,
        inicio DATE,
        fim DATE,
        `status` ENUM('pendente', 'em andamento', 'concluida') DEFAULT 'pendente',
        createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
";

// Corrigido erro de sintaxe no insert
$insertDados = "
    INSERT INTO `Show` (`show`, descricao, inicio, fim, `status`) VALUES
    ('travis', 'fein, skidididi', '2024-10-01', '2024-10-01', 'concluida'),
    ('drake', 'hotline bling', '2024-10-02', '2024-10-02', 'em andamento'),
    ('rihanna', 'umbrella', '2024-10-03', '2024-10-03', 'pendente');
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
