<title>Listar shows</title>
    </style>
    <div class="container">
    <h1 class="neon-title">Listar Shows</h1>
        <form action="" method="post" class="search-form">
            <input type="search" name="buscar" id="buscar" value="<?php echo htmlspecialchars($_POST['buscar'] ?? ''); ?>" placeholder="Buscar show...">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Show</th>
                <th>Descricao</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Situação</th>
                <th>Criação</th>
                <th>Alteração</th>
                <th style="width: 120px;">Ação</th>
            </tr>
            <?php
            require_once __DIR__ . '/../data/connection.php';
            require_once __DIR__ . '/../model/Tarefas.php';
        

            $showObj = new Tarefas($conn);
            $lista = $showObj->consultarTodos(htmlspecialchars($_POST['buscar'] ?? ''));

            foreach ($lista as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['id']) . "</td>";
                echo "<td>" . htmlspecialchars($item['show']) . "</td>";
                echo "<td>" . htmlspecialchars($item['descricao']) . "</td>";
                echo "<td>" . htmlspecialchars($item['inicio']) . "</td>";
                echo "<td>" . htmlspecialchars($item['fim']) . "</td>";
                echo "<td>" . htmlspecialchars($item['status']) . "</td>";
                echo "<td>" . htmlspecialchars($item['createAt']) . "</td>";
                echo "<td>" . htmlspecialchars($item['updateAt']) . "</td>";
                echo "<td style='display: flex; gap: 8px;'>";
                echo "<a href='?page=editar&id=" . $item['id'] . "' class='neon-btn neon-action-btn'>Editar</a>";
                echo "<a href='?page=deletar&id=" . $item['id'] . "' class='neon-btn neon-action-btn' onclick=\"return confirm('Tem certeza que deseja deletar este show?');\">Deletar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>