<?php

declare(strict_types=1);

require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/funcoes.php';

session_start();


/* =========================
   VALIDAR ID
========================= */

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id || $id < 1) {

    flash('erro', 'Registro inválido.');
    redirecionar('listar.php');
}


/* =========================
   BUSCAR PRODUTO
========================= */

$stmt = $pdo->prepare(
    'SELECT * FROM produtos WHERE id = :id'
);

$stmt->execute([
    'id' => $id
]);

$produto = $stmt->fetch();


if (!$produto) {

    flash('erro', 'Produto não encontrado.');
    redirecionar('listar.php');
}


/* =========================
   RECUPERAR DADOS DA SESSÃO
========================= */

$erros = $_SESSION['erros'] ?? [];

unset($_SESSION['erros']);


$valores = $_SESSION['formulario'] ?? $produto;

unset($_SESSION['formulario']);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar produto</title>

    <link
        rel="stylesheet"
        href="css/estilo.css"
    >

</head>

<body>


    <!-- =========================
         CABEÇALHO
    ========================== -->

    <header class="topo">

        <div class="container">

            <h1>CRUD de Produtos</h1>

            <nav>

                <a href="index.php">
                    Início
                </a>

                <a href="cadastro.php">
                    Cadastrar
                </a>

                <a href="listar.php">
                    Listar produtos
                </a>

            </nav>

        </div>

    </header>


    <!-- =========================
         CONTEÚDO PRINCIPAL
    ========================== -->

    <main class="container">

        <section class="card">

            <h2>
                Editar produto #<?= (int) $id ?>
            </h2>


            <!-- =========================
                 MENSAGENS DE ERRO
            ========================== -->

            <?php if ($erros): ?>

                <div class="alerta erro">

                    <strong>
                        Revise os dados:
                    </strong>

                    <ul>

                        <?php foreach ($erros as $erro): ?>

                            <li>
                                <?= e($erro) ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>


            <!-- =========================
                 FORMULÁRIO
            ========================== -->

            <form
                action="atualizar.php"
                method="post"
                class="formulario"
            >

                <!-- ID -->

                <input
                    type="hidden"
                    name="id"
                    value="<?= (int) $id ?>"
                >


                <!-- Nome -->

                <label>

                    Nome

                    <input
                        type="text"
                        name="nome"
                        maxlength="120"
                        required
                        value="<?= e((string) ($valores['nome'] ?? '')) ?>"
                    >

                </label>


                <!-- Descrição -->

                <label>

                    Descrição

                    <textarea
                        name="descricao"
                        required
                    ><?= e((string) ($valores['descricao'] ?? '')) ?></textarea>

                </label>


                <!-- Categoria -->

                <label>

                    Categoria

                    <select
                        name="categoria"
                        required
                    >

                        <option value="">
                            Selecione
                        </option>

                        <?php foreach (categoriasPermitidas() as $categoria): ?>

                            <option
                                value="<?= e($categoria) ?>"
                                <?= (($valores['categoria'] ?? '') === $categoria)
                                    ? 'selected'
                                    : '' ?>
                            >
                                <?= e($categoria) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </label>


                <!-- Preço -->

                <label>

                    Preço (R$)

                    <input
                        type="number"
                        name="preco"
                        min="0"
                        step="0.01"
                        required
                        value="<?= e((string) ($valores['preco'] ?? '')) ?>"
                    >

                </label>


                <!-- Estoque -->

                <label>

                    Estoque

                    <input
                        type="number"
                        name="estoque"
                        min="0"
                        step="1"
                        required
                        value="<?= e((string) ($valores['estoque'] ?? '')) ?>"
                    >

                </label>


                <!-- Ano -->

                <label>

                    Ano

                    <input
                        type="number"
                        name="ano"
                        min="1900"
                        max="<?= date('Y') ?>"
                        required
                        value="<?= e((string) ($valores['ano'] ?? '')) ?>"
                    >

                </label>


                <!-- Status -->

                <label>

                    Status

                    <select
                        name="status"
                        required
                    >

                        <?php foreach (statusPermitidos() as $status): ?>

                            <option
                                value="<?= e($status) ?>"
                                <?= (($valores['status'] ?? '') === $status)
                                    ? 'selected'
                                    : '' ?>
                            >
                                <?= e($status) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </label>


                <!-- =========================
                     AÇÕES
                ========================== -->

                <div class="acoes">

                    <button
                        class="botao"
                        type="submit"
                    >
                        Atualizar produto
                    </button>

                    <a
                        class="botao secundario"
                        href="listar.php"
                    >
                        Cancelar
                    </a>

                </div>

            </form>

        </section>

    </main>

</body>

</html>