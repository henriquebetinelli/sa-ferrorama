
# O que é stmt em PHP?

O `stmt` é uma variável utilizada no PHP para armazenar uma instrução SQL preparada. Ela é criada por meio da função `mysqli_prepare()` e serve para preparar uma consulta antes de executá-la no banco de dados.

Esse processo permite separar o comando SQL dos valores que serão utilizados nele, deixando a consulta mais organizada e segura. Também ajuda a evitar ataques de SQL Injection, que acontecem quando alguém tenta inserir comandos maliciosos em campos de entrada do sistema.

## Explicação do código

```php
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $idTrem);
mysqli_stmt_execute($stmt);
```

### 1. mysqli_prepare()

```php
$stmt = mysqli_prepare($conexao, $sql);
```

Essa função prepara o comando SQL para ser executado no banco de dados. Ela recebe dois parâmetros: `$conexao`, que representa a conexão com o banco de dados, e `$sql`, que contém o comando SQL que será utilizado.

O resultado é armazenado na variável `$stmt`, que representa a instrução preparada.

### 2. mysqli_stmt_bind_param()

```php
mysqli_stmt_bind_param($stmt, "i", $idTrem);
```

Essa função associa os valores que serão utilizados na consulta aos espaços reservados do comando SQL. Nesse exemplo, a variável `$idTrem` é associada ao parâmetro da consulta.

A letra `"i"` indica que o valor é do tipo inteiro (*integer*). Outros tipos também podem ser utilizados:

- `i`: inteiro (*integer*).
- `d`: número decimal (*double*).
- `s`: texto (*string*).
- `b`: dados binários (*blob*).

### 3. mysqli_stmt_execute()

```php
mysqli_stmt_execute($stmt);
```

Essa função executa o comando SQL que foi preparado anteriormente. Ela utiliza os valores associados na etapa anterior para realizar a operação no banco de dados, como buscar, inserir, atualizar ou excluir informações.

## Resumindo

O `stmt` é utilizado para trabalhar com consultas SQL preparadas no PHP. Primeiro, o comando é preparado, depois os valores são associados e, por último, a consulta é executada.

Essa forma de trabalhar com o banco de dados deixa o código mais organizado e ajuda a proteger o sistema contra SQL Injection.

## Fontes de pesquisa

- [PHP Manual – mysqli_prepare](https://www.php.net/manual/pt_BR/mysqli.prepare.php)
- [PHP Manual – mysqli_stmt_bind_param](https://www.php.net/manual/pt_BR/mysqli-stmt.bind-param.php)
- [PHP Manual – Prepared Statements](https://www.php.net/manual/pt_BR/mysqli.quickstart.prepared-statements.php)
