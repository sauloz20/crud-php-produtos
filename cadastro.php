<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/funcoes.php';

$valores = $_SESSION['formulario'] ?? [];
unset($_SESSION['formulario']);
$erros = $_SESSION['erros'] ?? [];
unset($_SESSION['erros']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produto</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
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

<main class="container">
    <section class="card">
        <h2>Cadastrar produto</h2>

        <?php if (!empty($erros)): ?>
            <div class="alerta erro">
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?= e($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="salvar.php" method="post" class="formulario">
            <label>Nome
                <input type="text" name="nome" maxlength="120" required value="<?= e($valores['nome'] ?? '') ?>">
            </label>

            <label>Descrição
                <textarea name="descricao" required><?= e($valores['descricao'] ?? '') ?></textarea>
            </label>

            <label>Categoria
                <select name="categoria" required>
                    <option value="">Selecione</option>
                    <?php foreach (categoriasPermitidas() as $categoria): ?>
                        <option value="<?= e($categoria) ?>"><?= e($categoria) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>Preço (R$)
                <input type="number" name="preco" min="0" step="0.01" required>
            </label>

            <label>Estoque
                <input type="number" name="estoque" min="0" step="1" required>
            </label>

            <label>Ano
                <input type="number" name="ano" min="1900" max="<?= date('Y') ?>" required>
            </label>

            <label>Status
                <select name="status" required>
                    <?php foreach (statusPermitidos() as $status): ?>
                        <option value="<?= e($status) ?>"><?= e($status) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <div class="acoes">
                <button class="botao" type="submit">Salvar produto</button>
                <a class="botao secundario" href="listar.php">Cancelar</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>
