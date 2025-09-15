<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/estilo.css">
    <script>
    function limparParametrosURL() {
        if (window.location.search) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }
</script>
</head>
<body>
    <nav class="neon-nav">
        <a href="?page=cadastrar" class="neon-btn">Cadastrar novo show</a>
        <a href="?page=listar" class="neon-btn">Listar shows</a>
    </nav>
    <div id="container" style="height: calc(98vh - 50px); overflow-y: auto; padding: 20px; box-sizing: border-box;">
        <?php
            if (isset($_GET['page']) && $_GET['page'] === 'cadastrar') {
                require_once __DIR__ . '/pages/tarefas_cadastrar.php';
            } 
            elseif (isset($_GET['page']) && $_GET['page'] === 'editar') {
                require_once __DIR__ . '/pages/tarefas_editar.php';
            }
            elseif (isset($_GET['page']) && $_GET['page'] === 'deletar') {
                require_once __DIR__ . '/pages/tarefas_deletar.php';
            }
            else {
                require_once __DIR__ . '/pages/tarefas_listar.php';
                if(isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
                    echo '<script> alert("Tarefa deletada com sucesso."); limparParametrosURL();</script>';
                }
            }
        ?>
    </div>


   
</body>
</html>

