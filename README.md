
# Sistema Empresarial

Este projeto é um sistema empresarial completo, desenvolvido com **PHP**, **MySQL**, **HTML** e **CSS**, com o objetivo de fornecer uma solução eficiente e organizada para o gerenciamento de informações empresariais.
Ideal para pequenas e médias empresas, o sistema oferece cadastro e controle de funcionários, cargos, setores, categorias, produtos, produção e usuários.

## 💻 Tutorial de Instalação

Siga o passo a passo abaixo para rodar o sistema na sua máquina local:

### 1. Baixe o projeto

```bash
Clique em "Code" > "Download ZIP" neste repositório e extraia o arquivo.
```

### 2. Instale o XAMPP

* Baixe e instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html) no seu computador.
* Abra o XAMPP e inicie os serviços **Apache** e **MySQL**.

### 3. Configure os arquivos do projeto

* Copie a pasta do projeto (ex: `sistema` ou `sistema-main`) para dentro da pasta `htdocs` do XAMPP (normalmente em `C:\xampp\htdocs`).

### 4. Importe o banco de dados

* Abra o [phpMyAdmin](http://localhost/phpmyadmin/).
* Clique em **"Novo"** e crie um banco de dados chamado **`meubanco`**.
* Com o banco selecionado, vá em **"Importar"** e selecione o arquivo `.sql` fornecido na pasta do projeto (ex: `meubanco.sql` ou em `/sql/meubanco.sql`).
* Clique em **"Executar"** para importar todas as tabelas e dados necessários.

### 5. Acesse o sistema

```url
http://localhost/sistema/login.php
```

Ou ajuste o caminho de acordo com o nome da sua pasta.

---

## 🛠️ Recursos do Sistema

* Cadastro, edição e exclusão de **funcionários**, **cargos**, **setores**, **produtos** e **categorias**
* Controle de **produção**
* Autenticação de usuário (**login**)
* Interface responsiva e de fácil navegação

---

## 📝 Observações

* Para acessar o sistema, utilize um usuário cadastrado no banco de dados (veja a tabela `usuarios` no phpMyAdmin).
* O código está aberto para estudos e melhorias. Todos são bem-vindos!

---

## 🙌 Créditos

* Projeto desenvolvido para fins acadêmicos por Ramiro Thoma Rockenbach.
* Agradecimento especial ao Senac Distrito Criativo e ao prof. Sandro Costa.

