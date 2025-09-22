<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Tarefas.php';

    
    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID de show inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de shows</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $showObj = new Tarefas($conn);
    $show_atual = $showObj->consultarPorId( $id);

    if (!$show_atual) {
        echo '<p style="color: red; text-align: center;">Show não encontrado.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de shows</a></p>';
        exit;
    }

    $resultado = $showObj->deletar($id);

    if ($resultado) {
        echo '<p style="color: green; text-align: center;">Show deletado com sucesso.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de shows</a></p>';
    } else {
        echo '<p style="color: red; text-align: center;">Erro ao deletar show. Tente novamente.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de shows</a></p>';
    }