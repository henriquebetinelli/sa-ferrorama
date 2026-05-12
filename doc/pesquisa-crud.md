# **CRUD**

CRUD é um acrônimo para **Create (Criar), Read (Ler), Update (Atualizar) e Delete (Deletar)**, as quatro operações fundamentais realizadas sobre dados em qualquer aplicação de software. Essas operações representam a base de como sistemas armazenam, acessam, manipulam e excluem informações de forma persistente em bancos de dados.

No desenvolvimento com PHP e banco de dados MySQL, essas operações são executadas por meio de comandos SQL dentro do código PHP, permitindo que o sistema interaja diretamente com os dados.

Independentemente da linguagem de programação, estrutura da aplicação ou tipo de banco de dados, essas quatro ações estão presentes de forma recorrente em praticamente todos os sistemas digitais modernos, desde um aplicativo de tarefas até sistemas bancários complexos.

---

# **Conceito de CRUD**

O conceito de CRUD não é apenas uma sigla técnica, mas sim um padrão universal de desenvolvimento de sistemas. Ele surgiu como uma forma de organizar logicamente as interações entre usuário e banco de dados.

Na prática, toda ação que o usuário realiza em uma interface, como cadastrar, visualizar, editar ou excluir algo, corresponde diretamente a uma das operações CRUD, que no PHP são implementadas através de scripts conectados ao banco de dados.

### **Exemplos**

- Criar uma nova conta → **Create**
- Visualizar dados → **Read**
- Atualizar endereço → **Update**
- Deletar perfil → **Delete**

CRUD é considerado a base de sistemas de gerenciamento de conteúdo (CMS), ERPs, CRMs, lojas virtuais, redes sociais, APIs RESTful, aplicativos mobile e qualquer aplicação que trabalhe com dados estruturados. A adoção desse modelo garante organização, previsibilidade e facilita o desenvolvimento do sistema.

---

# **Operações do CRUD**

| Operação | Ação | Método HTTP | Comando SQL | Exemplo em sistema |
|---|---|---|---|---|
| Create | Criar um novo dado | POST | INSERT INTO | Cadastro de um novo produto |
| Read | Ler dados existentes | GET | SELECT | Listagem de clientes |
| Update | Atualizar dados existentes | PUT/PATCH | UPDATE | Alterar endereço do cliente |
| Delete | Remover dados existentes | DELETE | DELETE FROM | Excluir pedido cancelado |

---

# **CRUD em Sistemas Web**

Na arquitetura de sistemas web, cada uma dessas ações se relaciona com métodos HTTP, facilitando a organização das rotas e a comunicação entre o front-end e o back-end.

Já no PHP, essas operações são responsáveis por enviar comandos ao banco de dados e retornar os resultados para o usuário.

---

# **CRUD no Projeto Ferrorama**

No projeto Ferrorama, o CRUD será essencial para o funcionamento do sistema, principalmente nas partes de login, cadastro e gerenciamento de usuários.

### **Create**
Será usado na tela de cadastro de usuários, onde novos usuários serão registrados no sistema.

### **Read**
Será utilizado para exibir informações, como os dados do usuário após o login ou listas dentro do sistema.

### **Update**
Permitirá que o usuário edite seus dados, como nome, senha ou outras informações cadastradas.

### **Delete**
Possibilitará a exclusão de contas ou remoção de dados quando necessário.

---

# **Conclusão**

Tudo o que o sistema fizer com dados dos usuários, e futuramente outros dados do Ferrorama, seguirá o padrão CRUD. Isso mostra que o CRUD não é apenas um conceito teórico, mas sim uma estrutura fundamental aplicada diretamente no desenvolvimento do projeto, organizando tanto o código quanto o funcionamento do sistema.