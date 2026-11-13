# ClickRails
 
<img width="2880" alt="Imagem de fundo do ClickRails" src="assets/img/reutilizaveis/banner_README.png">
 
## Sumário
 
1. [Sobre o projeto](#1-sobre-o-projeto)
2. [Problema que o sistema resolve](#2-problema-que-o-sistema-resolve)
3. [Objetivos e funcionalidades](#3-objetivos-e-funcionalidades)
4. [Tecnologias utilizadas](#4-tecnologias-utilizadas)
5. [Requisitos para executar](#5-requisitos-para-executar)
6. [Instalação e configuração](#6-instalação-e-configuração)
7. [Banco de dados](#7-banco-de-dados)
8. [Iniciando a aplicação](#8-iniciando-a-aplicação)
9. [Perfis de acesso e permissões](#9-perfis-de-acesso-e-permissões)
10. [Estrutura do projeto](#10-estrutura-do-projeto)
11. [Integrantes e contribuições](#11-integrantes-e-contribuições)
12. [Limitações conhecidas](#12-limitações-conhecidas)
13. [Documentação complementar](#13-documentação-complementar)
 
## 1. Sobre o projeto
 
O **ClickRails** é um sistema web desenvolvido para a **Ferrorama**, uma operação ferroviária fictícia criada no contexto da Situação de Aprendizagem (SA). A Ferrorama administra trens, rotas e sensores instalados tanto nos trens quanto ao longo da via, e precisa acompanhar esses recursos de forma organizada.
 
O sistema centraliza o cadastro e o monitoramento dessa operação: colaboradores, trens, rotas, sensores, operações (viagens) e relatórios, com controle de acesso de acordo com o cargo de cada usuário.
 
## 2. Problema que o sistema resolve
 
Sem um sistema próprio, as informações de uma operação ferroviária ficam espalhadas em planilhas, anotações e comunicações informais. Isso gera problemas como:
 
- **Falta de visibilidade:** é difícil saber rapidamente quais trens existem, quem é o responsável por cada um e em que rota estão operando.
- **Sensores sem controle:** não há um registro claro de onde cada sensor está instalado, o que ele mede e qual é o seu limite seguro.
- **Acesso sem restrição:** qualquer pessoa poderia alterar dados importantes, sem distinção entre administradores e operadores.
- **Dificuldade para gerar histórico:** sem dados organizados, é difícil produzir relatórios sobre as operações.
O ClickRails resolve isso reunindo tudo em um único lugar, com login obrigatório, permissões por cargo e telas simples de consultar.
 
## 3. Objetivos e funcionalidades
 
### Objetivos
 
- Centralizar o cadastro dos recursos da operação ferroviária.
- Permitir o acompanhamento das operações (trem + rota) em uma central de monitoramento.
- Garantir que somente usuários autorizados alterem dados do sistema.
- Preservar informações para consultas e relatórios.
### Principais funcionalidades
 
| Funcionalidade | Descrição |
|---|---|
| **Autenticação** | Login com e-mail e senha (senha armazenada com hash) e logout com confirmação. |
| **Dashboard** | Resumo com totais de colaboradores/trens e sensores, clima atual das cidades de SC (API Open-Meteo), alertas, relatórios e operações. |
| **Colaboradores** | Cadastro, consulta, edição e exclusão de usuários, com definição de cargo. |
| **Trens** | Cadastro, consulta, edição e exclusão de trens, com operador responsável. |
| **Rotas** | Cadastro, consulta, edição e exclusão de rotas. |
| **Sensores** | Cadastro de sensores em trens ou rotas, com tipo (velocidade, temperatura, localização, vibração, proximidade, freio) e limite. |
| **Monitoramento** | Início de operações (trem + rota) e acompanhamento da operação selecionada. |
| **Relatórios** | Geração, consulta e exclusão de relatórios. |
| **Pesquisa** | Busca por texto em todas as listagens. |
| **Proteção de dados** | Bloqueio de exclusões que quebrariam vínculos (ex.: trem com sensores, colaborador responsável por trem). |
 
Todas as funcionalidades são explicadas passo a passo no [Manual de Utilização](doc/manual/manual.md).
 
## 4. Tecnologias utilizadas
 
| Camada | Tecnologia |
|---|---|
| Front-end | HTML5, CSS3, JavaScript |
| Framework de interface | Bootstrap 5.3 e Bootstrap Icons (via CDN) |
| Back-end | PHP (com extensão `mysqli`) |
| Banco de dados | MySQL / MariaDB |
| Ambiente local | XAMPP (Apache + MySQL + phpMyAdmin) |
| API externa | [Open-Meteo](https://open-meteo.com/) (clima no dashboard) |
| Versionamento | Git e GitHub |
 
## 5. Requisitos para executar
 
- **XAMPP** instalado (com Apache, MySQL e PHP 8 ou superior).
- Um **navegador moderno** (Chrome, Edge ou Firefox).
- **Git** (opcional, para clonar o repositório; também é possível baixar o ZIP).
- **Conexão com a internet**, necessária para carregar o Bootstrap (CDN) e para o cartão de clima do dashboard.
 
## 6. Instalação e configuração
 
### 6.1 Baixar o projeto
 
Abra o terminal dentro da pasta `htdocs` do XAMPP (normalmente `C:\xampp\htdocs` no Windows) e execute:
 
```bash
git clone https://github.com/henriquebetinelli/sa-ferrorama.git
```
 
Ou baixe o ZIP pelo GitHub (**Code → Download ZIP**) e extraia em `htdocs`, mantendo o nome da pasta como `sa-ferrorama`.
 
### 6.2 Configurar a conexão com o banco
 
As credenciais do banco ficam em `infra/conexao.php`. Por padrão estão configuradas para o XAMPP sem alterações:
 
```php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sa_ferrorama";
```
 
Se o seu MySQL tiver outro usuário ou senha, altere apenas esse arquivo.
 
## 7. Banco de dados
 
### 7.1 Importar o banco
 
1. Abra o **XAMPP Control Panel** e clique em **Start** em **Apache** e **MySQL**.
2. Acesse o phpMyAdmin: [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
3. Clique na aba **Importar**.
4. Em **Escolher arquivo**, selecione `database/db.sql`.
5. Clique em **Importar** (no fim da página).
O script cria o banco `sa_ferrorama` e todas as tabelas automaticamente. Não é necessário criar o banco antes.
 
> Se o banco `sa_ferrorama` já existir, exclua-o antes de importar novamente (o script usa `CREATE DATABASE`).
 
### 7.2 Tabelas
 
| Tabela | Conteúdo |
|---|---|
| `usuario` | Colaboradores, com cargo e senha criptografada. |
| `trem` | Trens e seu operador responsável. |
| `rota` | Rotas da operação. |
| `sensor` | Sensores, vinculados a um trem **ou** a uma rota. |
| `operacao` | Operações (trem percorrendo uma rota). |
| `leitura_sensor` | Leituras registradas pelos sensores. |
| `falha` | Falhas detectadas nas operações. |
| `relatorio` | Relatórios gerados. |
| `sessao` | Sessões de usuário. |
 
### 7.3 Contas de demonstração
 
Como somente um Administrador cadastra usuários, é preciso criar uma conta inicial. Execute o SQL abaixo na aba **SQL** do phpMyAdmin (com o banco `sa_ferrorama` selecionado):
 
```sql
INSERT INTO usuario
  (nome_usuario, cpf, data_nascimento, genero, telefone, email, senha, cargo, cep)
VALUES
  ('Admin Demonstração', '00000000001', '2000-01-01', 'Outro', '00000000000',
   'admin@clickrails.demo', '$2y$10$.yLr2PKnm0igvHqfhjGh/udbH55WnuXvqZHhnnN4J2oV9p03CQLVS',
   'Administrador', '00000000'),
  ('Operador Demonstração', '00000000002', '2000-01-01', 'Outro', '00000000000',
   'operador@clickrails.demo', '$2y$10$BhZejdsNlOeUTj6V92xc/uiwsPDQvsl9oAsy/XfQarlkXvCdHTpsq',
   'Operador', '00000000');
```
 
| Perfil | E-mail | Senha |
|---|---|---|
| Administrador | `admin@clickrails.demo` | `Demo@Admin123` |
| Operador | `operador@clickrails.demo` | `Demo@Operador123` |
 
> Estas contas são **fictícias** e servem apenas para demonstração. As senhas estão salvas com hash (bcrypt), nunca em texto puro. Em uso real, crie contas próprias e exclua as de demonstração.
 
## 8. Iniciando a aplicação
 
1. Confirme que **Apache** e **MySQL** estão ativos no XAMPP.
2. No navegador, acesse:
```
   http://localhost/sa-ferrorama
```
   (se o projeto estiver em uma subpasta de `htdocs`, use `http://localhost/sua-pasta/sa-ferrorama`)
3. Clique em **Entrar** ou **Acessar o sistema**.
4. Faça login com uma das [contas de demonstração](#73-contas-de-demonstração).
 
Para o uso das telas, consulte o [Manual de Utilização](doc/manual/manual.md).
 
## 9. Perfis de acesso e permissões
 
O cargo é definido no cadastro do colaborador e controla o que cada pessoa pode fazer.
 
| Funcionalidade | Administrador | Operador / Técnico / Supervisor |
|---|:---:|:---:|
| Login e logout | Sim | Sim |
| Ver dashboard | Sim | Sim |
| Ver total de colaboradores no dashboard | Sim | Não (vê total de trens) |
| Acessar menu Colaboradores | Sim | Não |
| Cadastrar, editar e excluir colaboradores | Sim | Não |
| Consultar trens, rotas e sensores | Sim | Sim |
| Cadastrar, editar e excluir trens, rotas e sensores | Sim | Não |
| Iniciar e acompanhar operações | Sim | Sim |
| Gerar e consultar relatórios | Sim | Sim |
| Excluir relatórios | Sim | Não |
 
Regras adicionais:
 
- Páginas internas não abrem sem login (o usuário é redirecionado para a tela de login).
- O administrador não pode excluir a própria conta.
- Só colaboradores com cargo **Operador** podem ser responsáveis por um trem.
---
 
## 10. Estrutura do projeto
 
```
sa-ferrorama/
├── assets/               # Recursos visuais
│   ├── img/              # Logo e imagens do sistema
│   └── style/            # CSS global e CSS de cada página
├── components/           # Partes reutilizáveis das telas
│   ├── modals/           # Janelas de cadastro, edição, exclusão e confirmação
│   └── sidbar.php        # Barra lateral (menu e perfil)
├── controllers/          # Regras e operações com o banco (CRUD, login, logout, clima)
│   └── relatorio/        # Salvar e excluir relatórios
├── database/
│   └── db.sql            # Script de criação do banco
├── doc/                  # Documentação do projeto
│   ├── desing/           # Identidade visual (logo, paleta de cores)
│   ├── manual/           # Manual de utilização e capturas de tela
│   └── *.md              # Requisitos, regras de negócio e pesquisas
├── infra/
│   └── conexao.php       # Conexão com o MySQL
├── public/               # Páginas do sistema (login, início, trens, rotas etc.)
├── script/               # JavaScript de cada página
├── index.php             # Página de apresentação (entrada do sistema)
└── README.md
```
 
## 11. Integrantes e contribuições
 
| Integrante | GitHub | Principais contribuições |
|---|---|---|
| **Henrique Betinelli** | [@henriquebetinelli](https://github.com/henriquebetinelli) | Login e controle de sessão, módulo de colaboradores, dashboard e integração com a API de clima, estilos globais e componentes (modais), manual de utilização. |
| **Ana Clara Darolt** | [@ana-darolt](https://github.com/ana-darolt) | CRUD de trens, rotas e sensores (controllers), operações e central de monitoramento, pesquisas sobre CRUD, PDO, APIs e Scrum. |
| **Louie Ripper** | [@LowiieR](https://github.com/LowiieR) | Modelagem do banco de dados, telas de rotas e sensores, módulo de relatórios, identidade visual, requisitos e regras de negócio, README. |
 
## 12. Limitações conhecidas
 
- **Dados de monitoramento simulados:** não há integração com sensores físicos. Os cartões de Velocidade, Localização, Alertas e Últimos registros do Monitoramento ainda não exibem leituras reais.
- **Cartões do dashboard:** Alertas, Relatórios e Operações do dashboard ainda exibem apenas a mensagem padrão, sem listar os registros.
- **Recuperação de senha:** não existe "esqueci minha senha"; a redefinição é feita por um Administrador.
 
## 13. Documentação complementar
 
| Documento | Conteúdo |
|---|---|
| [Manual de Utilização](doc/manual/manual.md) | Passo a passo de uso do sistema. |
| [Requisitos do sistema](doc/requisitos-de-sistema.md) | Requisitos funcionais e não funcionais. |
| [Regras de negócio](doc/regra-de-negocio.md) | Regras que o sistema segue. |
| [Identidade visual](doc/desing/pesquisa-identidadeVisual.md) | Pesquisa de cores, logo e estilo. |
| [Relatório de uso de IA](doc/relatorio-uso-ia.md) | Registro do uso de IA no projeto. |
 
