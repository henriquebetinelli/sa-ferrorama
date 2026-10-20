# Pesquisa sobre APIs

## 1. O que é uma API?

API significa *Application Programming Interface*, ou Interface de Programação de Aplicações. Ela permite que dois sistemas troquem informações e utilizem funções um do outro.

Por exemplo, uma loja virtual pode usar uma API para consultar o estoque de produtos. Assim, não precisa ter todas as informações dentro do próprio sistema.

## 2. Como funciona a comunicação entre sistemas?

A comunicação acontece quando um sistema envia uma requisição para uma API. O servidor recebe o pedido, processa as informações e envia uma resposta.

Exemplo: um sistema solicita a lista de sensores cadastrados. A API consulta os dados e devolve a lista para o sistema mostrar na tela.

## 3. O que são APIs REST?

APIs REST são APIs que seguem regras para organizar a comunicação pela web. Elas usam endereços para identificar recursos e métodos HTTP para indicar o que deve ser feito.

Exemplos de endereços de uma API de sensores:

- `/api/sensores` — lista ou cadastra sensores;
- `/api/sensores/12` — acessa o sensor de número 12.

Esses endereços são exemplos e só funcionam se forem criados no sistema.

## 4. Métodos HTTP

Os métodos HTTP indicam a ação que o sistema deseja realizar.

| Método | Função | Exemplo |
|---|---|---|
| GET | Consultar informações. | Listar sensores. |
| POST | Enviar dados para cadastro. | Cadastrar um sensor. |
| PUT | Substituir os dados de um registro. | Atualizar todos os dados de um sensor. |
| PATCH | Alterar parte dos dados. | Alterar somente a localização. |
| DELETE | Excluir um registro. | Excluir um sensor. |

## 5. O que são requisições e respostas HTTP?

A requisição é o pedido enviado pelo sistema. A resposta é o resultado que o servidor devolve.

Exemplo de requisição:

```http
GET /api/sensores/12
```

Exemplo de resposta:

```http
200 OK
```

O código `200` indica sucesso. Outros exemplos são `201` (registro criado), `400` (pedido inválido), `401` (autenticação necessária), `403` (sem permissão) e `404` (registro não encontrado).

## 6. O que são endpoints?

Endpoints são os endereços usados para acessar as funções de uma API.

Por exemplo, `/api/sensores` pode ser usado para listar sensores com `GET` e cadastrar sensores com `POST`.

## 7. Como funciona o JSON?

JSON é um formato de texto usado para trocar dados entre sistemas. Ele organiza as informações em pares de chave e valor.

Exemplo:

```json
{
  "id_sensor": 12,
  "nome": "Sensor de temperatura",
  "localizacao": "Galpão A"
}
```

Nesse exemplo, a API envia o identificador, o nome e a localização de um sensor. O PHP e outras linguagens conseguem ler esses dados.

## 8. Diferença entre uma API e um sistema web tradicional

Um sistema web tradicional normalmente entrega páginas HTML para o usuário visualizar no navegador. Já uma API geralmente entrega dados para que outro sistema utilize.

Por exemplo, um sistema feito em PHP pode mostrar uma página com os sensores e também ter uma API que envia os mesmos dados para um aplicativo.

## 9. Como uma aplicação PHP pode consumir uma API?

Consumir uma API significa acessar um serviço e utilizar os dados que ele retorna. No PHP, isso pode ser feito com cURL ou outras ferramentas.

Exemplo simples de consulta:

```php
<?php

$url = "https://jsonplaceholder.typicode.com/posts/1";

$resposta = file_get_contents($url);
$dados = json_decode($resposta, true);

echo $dados["title"];

?>
```

Nesse exemplo, o PHP consulta uma API de teste, transforma a resposta JSON em um array e mostra o título recebido. Em projetos reais, também é necessário tratar erros e verificar se a resposta foi recebida corretamente.

## 10. Como uma API disponibiliza informações para outros sistemas?

Uma aplicação pode criar endpoints que consultam o banco de dados e enviam os resultados em JSON. Dessa forma, outros sistemas autorizados conseguem acessar as informações.

Por exemplo, uma API de sensores pode fornecer o nome, a localização e o tipo de cada sensor para um site ou aplicativo.

## 11. Autenticação, autorização e segurança

A autenticação verifica quem está acessando a API. A autorização verifica quais ações essa pessoa ou sistema pode realizar.

Esses cuidados evitam que pessoas sem permissão consultem, alterem ou excluam informações.

Algumas práticas de segurança são:

- Utilizar HTTPS para proteger os dados durante a comunicação;
- Validar os dados recebidos;
- Conferir as permissões dos usuários;
- Não deixar senhas e tokens expostos;
- Proteger o acesso ao banco de dados.

## 12. Exemplos de APIs em empresas

As APIs são utilizadas em diferentes atividades:

- **Lojas virtuais:** consultam produtos e estoque;
- **Bancos e pagamentos:** enviam solicitações de pagamento e recebem o resultado;
- **Transportadoras:** compartilham informações sobre entregas;
- **Recursos humanos:** integram dados de funcionários e folha de pagamento;
- **Indústrias:** recebem dados de sensores e equipamentos.

As APIs ajudam a conectar aplicações, automatizar tarefas e evitar que os mesmos dados precisem ser cadastrados em vários lugares.

## 13. Relação com o desenvolvimento de sistemas

No desenvolvimento com PHP, uma API pode se comunicar com o banco de dados, verificar as informações recebidas e devolver uma resposta para outro sistema.

Em um sistema de sensores, por exemplo, uma API pode permitir consultar os sensores cadastrados. Assim, um site ou aplicativo consegue mostrar as informações sem precisar acessar diretamente o banco de dados.

## 14. Conclusão

As APIs permitem que diferentes sistemas troquem informações de forma organizada. Os métodos HTTP indicam as operações, os endpoints definem os endereços e o JSON facilita a troca de dados.

No desenvolvimento de sistemas, elas ajudam a integrar aplicações, automatizar processos e compartilhar informações. Porém, é necessário validar os dados e controlar os acessos para manter a segurança.

## 15. Fontes consultadas

- APIPASS. **O que é uma API?** Disponível em: https://apipass.com.br/blog/api/
- MDN WEB DOCS. **Métodos de requisição HTTP.** Disponível em: https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Reference/Methods
- PHP. **Exemplos básicos do cURL.** Disponível em: https://www.php.net/manual/pt_BR/curl.examples-basic.php
- JSON.ORG. **Introdução ao JSON.** Disponível em: https://www.json.org/json-pt.html
- OWASP. **OWASP API Security Top 10.** Disponível em: https://api-security.owasp.org/editions/2023/en/0x00-header/

Acesso às fontes em: 20 out. 2026.