<?php
declare(strict_types=1);
require_once __DIR__ . '/funcoes.php';
$flash = obterFlash();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Produtos</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
<header class="topo"><div class="container"><h1>CRUD de Produtos</h1><nav><a href="index.php">Início</a><a href="cadastro.php">Cadastrar</a><a href="listar.php">Listar produtos</a></nav></div></header>
<main class="container">
    <?php if ($flash): ?><div class="alerta <?= e($flash['tipo']) ?>"><?= e($flash['mensagem']) ?></div><?php endif; ?>
    <section class="hero"><h2>Gerenciamento de produtos</h2><p>Cadastre, consulte, edite e exclua produtos em um sistema PHP conectado ao MySQL.</p><div class="acoes"><a class="botao" href="cadastro.php">Cadastrar produto</a><a class="botao secundario" href="listar.php">Ver produtos</a></div></section>
</main>
</body>
</html>
