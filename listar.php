<?php

declare(strict_types=1);

require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/funcoes.php';


/* =========================
   BUSCAR PRODUTOS
========================= */

$stmt = $pdo->query(
    'SELECT id, nome, descricao, categoria, preco, estoque, ano, status
     FROM produtos
     ORDER BY id DESC'
);

$produtos = $stmt->fetchAll();

$flash = obterFlash();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Listar produtos</title>

    <link rel="stylesheet" href="css/estilo.css">

</head>

<body>


    <!-- =========================
         CABEÇALHO
    ========================== -->

    <header class="topo">

        <div class="container">

            <h1>CRUD de Produtos</h1>

            <nav>
                <a href="index.php">Início</a>
                <a href="cadastro.php">Cadastrar</a>
                <a href="listar.php">Listar produtos</a>
            </nav>

        </div>

    </header>


    <!-- =========================
         CONTEÚDO PRINCIPAL
    ========================== -->

    <main class="container">


        <!-- =========================
             CABEÇALHO DA LISTAGEM
        ========================== -->

        <div class="cabecalho">

            <div>

                <h2>Produtos cadastrados</h2>

                <p>
                    <?= count($produtos) ?> registro(s) encontrado(s).
                </p>

            </div>

            <a class="botao" href="cadastro.php">
                Novo produto
            </a>

        </div>


        <!-- =========================
             MENSAGEM
        ========================== -->

        <?php if ($flash): ?>

            <div class="alerta <?= e($flash['tipo']) ?>">
                <?= e($flash['mensagem']) ?>
            </div>

        <?php endif; ?>


        <!-- =========================
             TABELA
        ========================== -->

        <div class="tabela-wrapper">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ano</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>

                </thead>


                <tbody>


                    <!-- Nenhum produto -->

                    <?php if (!$produtos): ?>

                        <tr>
                            <td colspan="8">
                                Nenhum produto cadastrado.
                            </td>
                        </tr>

                    <?php endif; ?>


                    <!-- Produtos -->

                    <?php foreach ($produtos as $produto): ?>

                        <tr>

                            <!-- ID -->

                            <td>
                                <?= (int) $produto['id'] ?>
                            </td>


                            <!-- Nome e descrição -->

                            <td>

                                <strong>
                                    <?= e($produto['nome']) ?>
                                </strong>

                                <br>

                                <small>
                                    <?= e($produto['descricao']) ?>
                                </small>

                            </td>


                            <!-- Categoria -->

                            <td>
                                <?= e($produto['categoria']) ?>
                            </td>


                            <!-- Preço -->

                            <td>
                                R$
                                <?= number_format(
                                    (float) $produto['preco'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>
                            </td>


                            <!-- Estoque -->

                            <td>
                                <?= (int) $produto['estoque'] ?>
                            </td>


                            <!-- Ano -->

                            <td>
                                <?= (int) $produto['ano'] ?>
                            </td>


                            <!-- Status -->

                            <td>

                                <span
                                    class="status <?= strtolower(e($produto['status'])) ?>"
                                >
                                    <?= e($produto['status']) ?>
                                </span>

                            </td>


                            <!-- Ações -->

                            <td class="acoes-tabela">

                                <a
                                    href="editar.php?id=<?= (int) $produto['id'] ?>"
                                >
                                    Editar
                                </a>

                                <a
                                    class="perigo"
                                    href="excluir.php?id=<?= (int) $produto['id'] ?>"
                                    onclick="return confirm('Deseja realmente excluir este produto?');"
                                >
                                    Excluir
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>


                </tbody>

            </table>

        </div>

    </main>

</body>

</html>