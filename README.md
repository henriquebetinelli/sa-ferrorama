# ⤷ ClickRails

<img width="2880" alt="Imagem de fundo do ClickRails" src="assets/img/reutilizaveis/banner_README.png">

--- 

## Sobre o projeto

O ClickRails foi desenvolvido como um projeto acadêmico com o objetivo de aplicar conhecimentos de desenvolvimento web, banco de dados, organização de sistemas e gerenciamento de informações.

O sistema simula uma plataforma utilizada para o gerenciamento de uma operação ferroviária, permitindo o acompanhamento de sensores, colaboradores e registros relacionados ao funcionamento da operação

---

## Funcionalidades principais:

- **Autenticação de usuários**<br>
  Login e controle de acesso ao sistema.
- **Colaboradores**<br>
  Cadastro e gerenciamento dos usuários.
- **Gerenciamento de administradores**<br>
  Controle de usuários com permissões administrativas (Cadastrar, Editar e Deletar).
- **Sensores** <br>
  Cadastro, gerenciamento e visualização dos sensores.
- **Trens**<br>
  Cadastro, gerenciamento e visualização dos trens.
- **Rotas**<br>
  Cadastro, gerenciamento e visualização das rotas.
- **Relatórios**<br>
  Consulta e geração de informações.

---
  
## Tecnologias utilizadas
- HTML
- CSS
- JavaScript
- PHP
- MySQL
- XAMPP

---

## Banco de dados

O sistema utiliza MySQL para armazenamento dos dados. Para utilizar o banco, importe o arquivo no MySQL através do phpMyAdmin.

**O arquivo do banco de dados está localizado em: `database/db.sql`**

---

## Estrutura do repositório
sa-ferrorama/ <br>
├── assets/ <br>
│ ㅤ└── imagens e recursos do sistema <br>
│ <br>
├── components/ <br>
│ ㅤ└── componentes reutilizáveis <br>
│ <br>
├── controllers/ <br>
│ ㅤ└── arquivos responsáveis pelas operações do sistema <br>
│ <br>
├── database/ <br>
│ ㅤ└── db.sql <br>
│ <br>
├── doc/ <br>
│ ㅤ└── documentação do projeto <br>
│ <br>
├── infra/ <br>
│ ㅤ└── arquivos relacionados à infraestrutura <br>
│ <br>
├── public/ <br>
│ ㅤ└── arquivos e páginas públicas <br>
│ <br>
├── script/ <br>
│ ㅤ└── scripts JavaScript <br>
│<br>
├── index.php <br>
└── README.md

---

## Como executar o projeto
1. Clonar o repositório
git clone https://github.com/henriquebetinelli/sa-ferrorama.git
2. Acessar a pasta 'sa-ferrorama'
3. Executar

Utilize o XAMPP para iniciar o Apache e o MySQL. Depois, coloque o projeto na pasta htdocs e acesse pelo navegador:

http://localhost/(pasta-do-htdocs)/sa-ferrorama

---

## Equipe de desenvolvimento

Projeto desenvolvido por:

- Henrique Betinelli
- Ana Clara Darolt
- Louie Ripper
