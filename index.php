<?php
include 'request_handler.php';

$urgencia = isset($_GET['urgencia']) ? $_GET['urgencia'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$id_funcionario = isset($_GET['id_funcionario']) ? $_GET['id_funcionario'] : '';

$solicitacoes = listarSolicitacoes($urgencia, $status, $id_funcionario);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Solicitações</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gerenciamento de Solicitações</h1>

    <h2>Cadastrar Cliente</h2>
    <form action="main.php" method="POST">
        <input type="hidden" name="acao" value="cadastrar_cliente">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required><br><br>
        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Criar Solicitação</h2>
    <form action="main.php" method="POST">
        <input type="hidden" name="acao" value="criar_solicitacao">
        <label for="id_cliente">ID Cliente:</label><br>
        <input type="number" id="id_cliente" name="id_cliente" required><br><br>
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required></textarea><br><br>
        <label for="urgencia">Urgência:</label><br>
        <select id="urgencia" name="urgencia" required>
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select><br><br>
        <label for="id_funcionario">Funcionário Responsável:</label><br>
            <select id="id_funcionario" name="id_funcionario" required>
            <option value="">Selecione Funcionário</option>
            <option value="1">Funcionário 1</option>
            <option value="2">Funcionário 2</option>
        </select><br><br>
        <button type="submit">Criar Solicitação</button>
    
    </form>

    <h2>Filtrar Solicitações</h2>
    <form action="index.php" method="GET">
        <label for="urgencia">Urgência:</label>
        <select name="urgencia" id="urgencia">
            <option value="">Selecione</option>
            <option value="baixa" <?php echo $urgencia === 'baixa' ? 'selected' : ''; ?>>Baixa</option>
            <option value="média" <?php echo $urgencia === 'média' ? 'selected' : ''; ?>>Média</option>
            <option value="alta" <?php echo $urgencia === 'alta' ? 'selected' : ''; ?>>Alta</option>
        </select><br><br>

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">Selecione</option>
            <option value="pendente" <?php echo $status === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
            <option value="em andamento" <?php echo $status === 'em andamento' ? 'selected' : ''; ?>>Em Andamento</option>
            <option value="finalizada" <?php echo $status === 'finalizada' ? 'selected' : ''; ?>>Finalizada</option>
        </select><br><br>

        <label for="id_funcionario">Funcionário:</label>
        <select name="id_funcionario" id="id_funcionario">
            <option value="">Selecione</option>
            <option value="1" <?php echo $id_funcionario === '1' ? 'selected' : ''; ?>>Funcionário 1</option>
            <option value="2" <?php echo $id_funcionario === '2' ? 'selected' : ''; ?>>Funcionário 2</option>
        </select><br><br>

        <button type="submit">Filtrar</button>
    </form>


     <h2>Lista de Solicitações</h2>
    <?php if ($solicitacoes): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Solicitação</th>
                    <th>Cliente</th>
                    <th>Descrição</th>
                    <th>Urgência</th>
                    <th>Status</th>
                    <th>Funcionário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($solicitacoes as $solicitacao): ?>
                    <tr>
                        <td><?php echo $solicitacao['id_solicitacao']; ?></td>
                        <td><?php echo $solicitacao['cliente']; ?></td>
                        <td><?php echo $solicitacao['descricao']; ?></td>
                        <td><?php echo ucfirst($solicitacao['urgencia']); ?></td>
                        <td><?php echo ucfirst($solicitacao['status']); ?></td>
                        <td><?php echo $solicitacao['funcionario'] ? $solicitacao['funcionario'] : 'Não Atribuído'; ?></td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="acao" value="atualizar_status">
                                <input type="hidden" name="id_solicitacao" value="<?php echo $solicitacao['id_solicitacao']; ?>">
                                <select name="status" required>
                                    <option value="pendente" <?php echo $solicitacao['status'] === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
                                    <option value="em andamento" <?php echo $solicitacao['status'] === 'em andamento' ? 'selected' : ''; ?>>Em Andamento</option>
                                    <option value="finalizada" <?php echo $solicitacao['status'] === 'finalizada' ? 'selected' : ''; ?>>Finalizada</option>
                                </select>
                                <select name="id_funcionario">
                                    <option value="">Selecione Funcionário</option>
                                    <option value="1">Funcionário 1</option>
                                    <option value="2">Funcionário 2</option>
                                </select>
                                <button type="submit">Atualizar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Não há solicitações registradas.</p>
    <?php endif; ?>

    <script src="script.js"></script>
</body>
</html>
