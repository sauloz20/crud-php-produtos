<?php
declare(strict_types=1);
require_once __DIR__ . '/conexao.php';
require_once __DIR__ . '/funcoes.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) { flash('erro', 'ID inválido.'); redirecionar('listar.php'); }

$stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
$stmt->execute(['id' => $id]);

flash($stmt->rowCount() ? 'sucesso' : 'erro', $stmt->rowCount() ? 'Produto excluído com sucesso.' : 'Produto não encontrado.');
redirecionar('listar.php');
