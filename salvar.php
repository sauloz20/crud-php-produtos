<?php
declare(strict_types=1);
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirecionar('cadastro.php');
}

[$produto, $erros] = validarProduto($_POST);
if ($erros) {
    session_start();
    $_SESSION['formulario'] = $produto;
    $_SESSION['erros'] = $erros;
    redirecionar('cadastro.php');
}

$sql = 'INSERT INTO produtos (nome, descricao, categoria, preco, estoque, ano, status) VALUES (:nome, :descricao, :categoria, :preco, :estoque, :ano, :status)';
$stmt = $pdo->prepare($sql);
$stmt->execute($produto);

flash('sucesso', 'Produto cadastrado com sucesso.');
redirecionar('listar.php');
