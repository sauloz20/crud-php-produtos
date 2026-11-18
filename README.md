# CRUD de Produtos em PHP

![PHP](https://img.shields.io/badge/linguagem-PHP-blue)

Aplicação acadêmica para cadastrar, consultar, editar e excluir produtos usando PHP e MySQL.

## Requisitos

- PHP com extensão PDO MySQL.
- MySQL ou MariaDB.
- Apache/XAMPP ou servidor embutido do PHP.

## Instalação e execução

1. Clone o repositório.
2. A instrução `CREATE TABLE` em `banco.sql` está truncada na branch principal, então a importação falhará. O [PR de organização](https://github.com/sauloz20/crud-php-produtos/pull/1) propõe completar a instrução; revise e teste essa alteração antes de importar o banco.
3. Confira as credenciais locais em `conexao.php`: os padrões são servidor `localhost`, usuário `root` e senha vazia. Não publique credenciais reais.
4. Na pasta do projeto, execute `php -S localhost:8000` e abra `http://localhost:8000/`. Alternativamente, copie a pasta para o `htdocs` e inicie Apache e MySQL pelo XAMPP.

## Estrutura

```text
index.php, cadastro.php, listar.php, editar.php  Telas
salvar.php, atualizar.php, excluir.php           Operações do CRUD
conexao.php, funcoes.php                         Banco e funções auxiliares
banco.sql                                        Estrutura do banco
CSS/estilo.css                                   Estilos
```

## Limitações

Este projeto é uma demonstração acadêmica. Não há autenticação de administradores; revise a segurança e a configuração de credenciais antes de qualquer exposição pública. O caminho do CSS também difere em maiúsculas e minúsculas (`css/` nas páginas e `CSS/` no repositório); o PR citado propõe a correção. A importação SQL e as operações com banco precisam ser testadas no seu ambiente.
