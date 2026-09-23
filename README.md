# ClickRails

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
ClickRails/ <br>
├── assets/ㅤㅤㅤㅤㅤㅤㅤㅤㅤ# Imagens e recursos visuais<br>
├── doc/ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ# Documentação do projeto<br>
│   ├── desing/<br>
│   ├── pesquisa-XAMPP.md <br>
│   ├── pesquisa-crud.md <br>
│   ├── pesquisa-scrum.md <br>
│   ├── regra-de-negocio.md <br>
│   └── requisitos-de-sistema.md <br>
├── public/ㅤㅤㅤㅤㅤㅤㅤㅤㅤ# Interfaces do sistema <br>
│   ├── tela-cadastro-sensor.html <br>
│   ├── tela-home.html <br>
│   ├── tela-login.html <br>
│   └── tela-sensores.html <br>
├── index.htmlㅤㅤㅤㅤㅤㅤㅤㅤ# Página inicial <br>
└── README.mdㅤㅤㅤㅤㅤㅤㅤ# Documentação do projeto <br>

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
