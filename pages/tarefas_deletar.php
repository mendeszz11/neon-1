<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Tarefas.php';

    
    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de tarefa inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de tarefas</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $tarefa = new Tarefas($conn);
    $tarefa_atual = $tarefa->consultarPorId( $id);

    if (!$tarefa_atual) {
        echo '<p style="color: red; text-align: center;">Tarefa não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de tarefas</a></p>';
        exit;
    }

    $resultado = $tarefa->deletar($id);

    if ($resultado) {               
        header('Location: /?deleted=true');
    } else {
        echo '<p style="color: red; text-align: center;">Erro ao deletar tarefa. Tente novamente.</p>';
         echo '<p style="text-align: center;"><a href="/">Voltar para a lista de tarefas</a></p>';
    }