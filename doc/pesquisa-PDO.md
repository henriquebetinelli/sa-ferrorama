# PDO (PHP Data Objects)

## O que é o PDO?

PDO significa **PHP Data Objects**. Ele é uma extensão do PHP que permite fazer a comunicação entre uma aplicação e um banco de dados. Com ele, o programador consegue realizar consultas e outras operações no banco de uma forma mais organizada.

Uma das características do PDO é que ele não funciona apenas com um tipo de banco. Existem drivers que permitem sua utilização com bancos diferentes, como MySQL, PostgreSQL e SQLite.

## Para que ele é utilizado no PHP?

O PDO é utilizado quando um sistema desenvolvido em PHP precisa guardar ou buscar informações em um banco de dados. Por exemplo, em um sistema de cadastro, ele pode ser usado para cadastrar um cliente, consultar seus dados, alterar alguma informação ou excluir um registro.

Ele também permite executar comandos SQL e trabalhar com recursos como transações e consultas preparadas.

## Como funciona uma conexão utilizando PDO?

Para criar uma conexão, é utilizada a classe `PDO`. É necessário informar algumas informações do banco, como o servidor, o nome do banco, o usuário e a senha.

Um exemplo simples de conexão com MySQL seria:

```php
<?php

try {
    $conexao = new PDO(
        "mysql:host=localhost;dbname=exercicio",
        "root",
        "senha"
    );

    echo "Conectado com sucesso!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
```

Nesse exemplo, `mysql` indica que o banco utilizado é o MySQL, `localhost` é o servidor e `exercicio` é o nome do banco.

O `try` é usado para tentar realizar a conexão. Se acontecer algum problema, o `catch` captura o erro e mostra uma mensagem. O PDO utiliza a exceção `PDOException` para informar erros relacionados à conexão e outras operações.

## Principais características

O PDO possui uma estrutura que facilita o trabalho com bancos de dados dentro do PHP. Uma das suas principais características é poder utilizar diferentes bancos por meio de drivers, sem precisar mudar completamente a forma como o código funciona.

Outra característica importante é o suporte a **Prepared Statements**, além do tratamento de erros e do uso de transações. Esses recursos ajudam tanto na organização quanto na segurança da aplicação.

## Diferenças entre PDO e MySQLi

O PDO e o MySQLi são duas formas de trabalhar com bancos de dados no PHP. Os dois podem ser utilizados com MySQL e possuem recursos parecidos, como Prepared Statements e transações.

A principal diferença é que o **MySQLi foi desenvolvido especificamente para o MySQL**, enquanto o **PDO pode trabalhar com diferentes bancos de dados**. Por isso, o PDO pode ser uma opção mais interessante quando existe a possibilidade de o projeto mudar de banco futuramente.

Por outro lado, se o sistema já foi planejado para utilizar somente MySQL, o MySQLi também pode ser utilizado sem problemas.

## Vantagens e desvantagens de utilizar PDO

Uma vantagem do PDO é justamente a possibilidade de trabalhar com diferentes bancos de dados. Ele também possui suporte a Prepared Statements, que ajudam a proteger as consultas contra SQL Injection. Além disso, sua estrutura permite organizar melhor a comunicação do sistema com o banco.

Como desvantagem, pode ser necessário aprender alguns conceitos antes de começar a utilizá-lo. Também é necessário possuir o driver correspondente ao banco que será utilizado. Em um projeto que trabalha exclusivamente com MySQL, o MySQLi pode ser uma alternativa mais específica.

## O que são Prepared Statements?

Prepared Statements são consultas SQL que são preparadas antes de receber os valores que serão utilizados nelas. Em vez de colocar diretamente os dados recebidos pelo sistema dentro do comando SQL, eles são enviados separadamente.

Um exemplo:

```php
$stmt = $conexao->prepare(
    "INSERT INTO pessoa (nome, email) VALUES (?, ?)"
);

$stmt->execute(["Ana", "ana@email.com"]);
```

Nesse caso, os valores `"Ana"` e `"ana@email.com"` são enviados separadamente da estrutura do comando.

Esse recurso é importante principalmente para a segurança, pois ajuda a evitar ataques de **SQL Injection**. Esse tipo de ataque pode acontecer quando dados enviados pelo usuário são colocados diretamente em uma consulta SQL sem o devido tratamento.

## Em quais situações o PDO pode ser uma boa escolha?

O PDO pode ser uma boa escolha para sistemas desenvolvidos em PHP que utilizam banco de dados, principalmente quando o projeto precisa de uma forma mais organizada para realizar consultas e cadastrar informações.

Ele também pode ser interessante em projetos maiores ou que tenham possibilidade de utilizar outro banco de dados no futuro. Em sistemas de cadastro, lojas, sites e aplicações que trabalham com informações de usuários, o uso de Prepared Statements do PDO também ajuda a deixar as consultas mais seguras.

## Conclusão

O PDO é uma alternativa para trabalhar com bancos de dados em PHP. Ele permite realizar conexões, consultas, alterações e outras operações no banco, além de possuir recursos como Prepared Statements e transações.

Comparado ao MySQLi, sua principal vantagem é não ficar limitado ao MySQL. Por isso, dependendo do projeto, o PDO pode ser uma escolha mais flexível. Também é uma opção interessante quando a segurança das consultas é importante, principalmente pelo uso de Prepared Statements.

## Fontes utilizadas

* **DevMedia.** Introdução ao PHP PDO. Disponível em: https://www.devmedia.com.br/introducao-ao-php-pdo/24973. Acesso em: 08 set. 2026.

* **PHP Documentation.** PDO - PHP Data Objects. Disponível em: https://www.php.net/manual/pt_BR/book.pdo.php. Acesso em: 08 set. 2026.

* **PHP Documentation.** Conexões PDO. Disponível em: https://www.php.net/manual/pt_BR/pdo.connections.php. Acesso em: 08 set. 2026.

* **PHP Documentation.** PDO::prepare. Disponível em: https://www.php.net/manual/pt_BR/pdo.prepare.php. Acesso em: 08 set. 2026.

