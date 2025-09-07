<?php
class Tarefas
{
    // Atributos correspondentes à tabela de tarefas
    public $id;
    public $titulo;
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
            $sql = "INSERT INTO tarefas (`titulo`, `descricao`, `inicio`, `fim`, `status`) VALUES (?, ?, ?, ?, ?)";
            $dados = [
                $this->titulo,
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
            error_log("Erro ao cadastrar tarefa: " . $e->getMessage());
            throw new Exception(message: "Erro ao cadastrar tarefa: " . $e->getMessage());
        }
    }

    // Método para consultar todas as tarefas, com busca opcional
    public function consultarTodos($search = '')
    {
        try {            
            if ($search) {
                $sql = "SELECT * FROM tarefas WHERE titulo LIKE ? OR descricao LIKE ?";
                $search = trim(string: $search);
                $search = "%{$search}%";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$search, $search]);
            } else {
                $sql = "SELECT * FROM tarefas";
                $stmt = $this->conn->query($sql);
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar tarefas: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar tarefas: " . $e->getMessage());
        }
    }

    // Método para consultar tarefa por ID
    public function consultarPorId($id)
    {
        try {
            $sql = "SELECT * FROM tarefas WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao consultar tarefa por ID: " . $e->getMessage());
            throw new Exception(message: "Erro ao consultar tarefa por ID: " . $e->getMessage());
        }
    }

    // Método para alterar uma tarefa existente
    public function editar()
    {
        try {
            $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, inicio = ?, fim = ?, status = ? WHERE id = ?";
            $dados = [
                $this->titulo,
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
            error_log("Erro ao alterar tarefa: " . $e->getMessage());
            throw new Exception(message: "Erro ao alterar tarefa: " . $e->getMessage());
        }
    }

    // Método para deletar uma tarefa
    public function deletar($id): bool
    {
        try {
            $sql = "DELETE FROM tarefas WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return ($stmt->rowCount() > 0); 
        } catch (PDOException $e) {
            // Tratar erro de banco de dados
            error_log("Erro ao deletar tarefa: " . $e->getMessage());
            throw new Exception(message: "Erro ao deletar tarefa: " . $e->getMessage());
        }
    }
}