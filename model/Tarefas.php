<?php
class Tarefas
{
    // Atributos correspondentes à tabela de tarefas
    public $id;
    public $show;
    public $descricao;
    public $inicio;
    public $fim;
    public $status;
    
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Método para cadastrar uma nova tarefa
    public function cadastrar(): bool
    {
        try {
            $sql = "INSERT INTO `Show` (`show`, `descricao`, `inicio`, `fim`, `status`) VALUES (?, ?, ?, ?, ?)";
            $dados = [
                $this->show,
                $this->descricao,
                $this->inicio,
                $this->fim,
                $this->status
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao cadastrar show: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar show: " . $e->getMessage());
        }
    }

    // Método para consultar todas as tarefas, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                    $sql = "SELECT * FROM `Show` WHERE `show` LIKE ? OR descricao LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM `Show`";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar shows: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar shows: " . $e->getMessage());
        }
    }

    // Método para consultar tarefa por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM `Show` WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar show por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar show por ID: " . $e->getMessage());
        }
    }

    // Método para alterar uma tarefa existente
    public function editar()
    {
        try {
            $sql = "UPDATE `Show` SET `show` = ?, descricao = ?, inicio = ?, fim = ?, status = ? WHERE id = ?";
            $dados = [
                $this->show,
                $this->descricao,
                $this->inicio,
                $this->fim,
                $this->status,
                $this->id
            ];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dados);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao alterar show: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar show: " . $e->getMessage());
        }
    }

    // Método para deletar uma tarefa
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM `Show` WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar show: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar show: " . $e->getMessage());
        }
    }
}