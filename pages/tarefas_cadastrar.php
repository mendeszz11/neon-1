<?php

    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Tarefas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $show = $_POST['show'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $inicio = $_POST['inicio'] ?? '';
        $fim = $_POST['fim'] ?? '';
        $status = $_POST['status'] ?? '';

        $showObj = new Tarefas($conn);
        $showObj->show = $show;
        $showObj->descricao = $descricao;
        $showObj->inicio = $inicio;
        $showObj->fim = $fim;
        $showObj->status = $status;
        $resultado = $showObj->cadastrar();
    }
?>
    <div class="form-container">
        <h1>Cadastrar Novo Show</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="show">Show:</label>
                <input type="text" id="show" name="show" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" required>
            </div>
            <div class="form-group">
                <label for="fim">Data de Fim:</label>
                <input type="date" id="fim" name="fim" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pendente">Pendente</option>
                    <option value="em andamento">Em Andamento</option>
                    <option value="concluida">Concluída</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar Show</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Show cadastrado com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao cadastrar show. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
