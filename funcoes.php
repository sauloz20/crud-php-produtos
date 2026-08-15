<?php
declare(strict_types=1);

function e(?string $valor): string
{
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}

function categoriasPermitidas(): array
{
    return ['Eletrônicos', 'Informática', 'Acessórios', 'Casa'];
}

function statusPermitidos(): array
{
    return ['Ativo', 'Inativo'];
}

function validarProduto(array $dados): array
{
    $erros = [];
    $produto = [
        'nome' => trim((string)($dados['nome'] ?? '')),
        'descricao' => trim((string)($dados['descricao'] ?? '')),
        'categoria' => trim((string)($dados['categoria'] ?? '')),
        'preco' => trim((string)($dados['preco'] ?? '')),
        'estoque' => trim((string)($dados['estoque'] ?? '')),
        'ano' => trim((string)($dados['ano'] ?? '')),
        'status' => trim((string)($dados['status'] ?? '')),
    ];

    if ($produto['nome'] === '' || mb_strlen($produto['nome']) < 2 || mb_strlen($produto['nome']) > 120) {
        $erros[] = 'O nome é obrigatório e deve ter entre 2 e 120 caracteres.';
    }

    if ($produto['descricao'] === '') {
        $erros[] = 'A descrição é obrigatória.';
    }

    if (!in_array($produto['categoria'], categoriasPermitidas(), true)) {
        $erros[] = 'Selecione uma categoria válida.';
    }

    $precoNormalizado = str_replace(',', '.', $produto['preco']);
    if ($precoNormalizado === '' || !is_numeric($precoNormalizado) || (float)$precoNormalizado < 0) {
        $erros[] = 'O preço deve ser numérico e não pode ser negativo.';
    } else {
        $produto['preco'] = number_format((float)$precoNormalizado, 2, '.', '');
    }

    if ($produto['estoque'] === '' || filter_var($produto['estoque'], FILTER_VALIDATE_INT) === false || (int)$produto['estoque'] < 0) {
        $erros[] = 'O estoque deve ser um número inteiro maior ou igual a zero.';
    } else {
        $produto['estoque'] = (string)(int)$produto['estoque'];
    }

    $anoAtual = (int)date('Y');
    if ($produto['ano'] === '' || filter_var($produto['ano'], FILTER_VALIDATE_INT) === false || (int)$produto['ano'] < 1900 || (int)$produto['ano'] > $anoAtual) {
        $erros[] = "O ano deve ser um número entre 1900 e {$anoAtual}.";
    } else {
        $produto['ano'] = (string)(int)$produto['ano'];
    }

    if (!in_array($produto['status'], statusPermitidos(), true)) {
        $erros[] = 'Selecione um status válido.';
    }

    return [$produto, $erros];
}

function redirecionar(string $url): never
{
    header("Location: {$url}");
    exit;
}

function flash(string $tipo, string $mensagem): void
{
    session_start();
    $_SESSION['flash'] = ['tipo' => $tipo, 'mensagem' => $mensagem];
}

function obterFlash(): ?array
{
    session_start();
    $mensagem = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $mensagem;
}
