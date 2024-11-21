<?php
include 'db.php';

function cadastrarCliente($nome, $cpf, $email, $telefone) {
    global $conn;
    $sql = "INSERT INTO Clientes (nome, cpf, email, telefone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $cpf, $email, $telefone);
    return $stmt->execute();
}

function criarSolicitacao($id_cliente, $descricao, $urgencia) {
    global $conn;
    $sql = "INSERT INTO Solicitacoes (id_cliente, descricao, urgencia, status) VALUES (?, ?, ?, 'pendente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_cliente, $descricao, $urgencia);
    return $stmt->execute();
}

function listarSolicitacoes($urgencia = '', $status = '', $id_funcionario = '') {
    global $conn;

$sql = "SELECT s.id_solicitacao, s.descricao, s.urgencia, s.status, c.nome AS cliente, f.nome AS funcionario
            FROM Solicitacoes s
            LEFT JOIN Clientes c ON s.id_cliente = c.id_cliente
            LEFT JOIN Funcionarios f ON s.id_funcionario = f.id_funcionario
            WHERE 1";

if ($urgencia) {
        $sql .= " AND s.urgencia = '" . $conn->real_escape_string($urgencia) . "'";
    }
    if ($status) {
        $sql .= " AND s.status = '" . $conn->real_escape_string($status) . "'";
    }
    if ($id_funcionario) {
        $sql .= " AND s.id_funcionario = " . (int)$id_funcionario;
    }

    $sql .= " ORDER BY s.id_solicitacao DESC";

    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

function atualizarStatusSolicitacao($id_solicitacao, $status, $id_funcionario = null) {
    global $conn;
    $sql = "UPDATE Solicitacoes SET status = ?, id_funcionario = ? WHERE id_solicitacao = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $status, $id_funcionario, $id_solicitacao);
    return $stmt->execute();
}
?>
