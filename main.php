<?php
include 'request_handler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'cadastrar_cliente') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $success = cadastrarCliente($nome, $cpf, $email, $telefone);
    echo $success ? "Cliente cadastrado com sucesso!" : "Erro ao cadastrar cliente.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar_solicitacao') {
    $id_cliente = $_POST['id_cliente'];
    $descricao = $_POST['descricao'];
    $urgencia = $_POST['urgencia'];
    $id_funcionario = isset($_POST['id_funcionario']) ? (int)$_POST['id_funcionario'] : null;
    $success = criarSolicitacao($id_cliente, $descricao, $urgencia, $id_funcionario);
    echo $success ? "Solicitação criada com sucesso!" : "Erro ao criar solicitação.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'atualizar_status') {
    $id_solicitacao = $_POST['id_solicitacao'];
    $status = $_POST['status'];
    $id_funcionario = $_POST['id_funcionario'] ?? null;
    $success = atualizarStatusSolicitacao($id_solicitacao, $status, $id_funcionario);
    echo $success ? "Status atualizado com sucesso!" : "Erro ao atualizar status.";
}
?>
