<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/Tarefas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $show = $_POST['show'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $inicio = $_POST['inicio'] ?? '';
        $fim = $_POST['fim'] ?? '';
        $status = $_POST['status'] ?? '';

        $showObj = new Tarefas($conn);
        $showObj->id = $id;
        $showObj->show = $show;
        $showObj->descricao = trim($descricao);
        $showObj->inicio = $inicio;
        $showObj->fim = $fim;
        $showObj->status = $status;
        $resultado = $showObj->editar();
    }

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
    
?>
    
    <div class="form-container">
        <h1>Editar Show</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($tarefa_atual['id']); ?>">
            <div class="form-group">
                <label for="show">Show:</label>
                <input type="text" id="show" name="show" value="<?php echo htmlspecialchars($tarefa_atual['show']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($tarefa_atual['descricao']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" value="<?php echo htmlspecialchars($tarefa_atual['inicio']) ?>" required>
            </div>
            <div class="form-group">
                <label for="fim">Data de Fim:</label>
                <input type="date" id="fim" name="fim" value="<?php echo htmlspecialchars($tarefa_atual['fim']) ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="pendente" <?php echo ($tarefa_atual['status']==='pendente') ? 'selected' : ''; ?>>Pendente</option>
                    <option value="em andamento"  <?php echo ($tarefa_atual['status']==='em andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                    <option value="concluida"  <?php echo ($tarefa_atual['status']==='concluida') ? 'selected' : ''; ?>>Concluída</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Editar Show</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Show alterado com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao alterar show. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
