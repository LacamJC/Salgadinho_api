
# Salgadinho API

## Descrição

A **Salgadinho API** é uma aplicação desenvolvida em PHP, destinada a gerenciar informações sobre salgadinhos, suas avaliações e comentários de usuários. O projeto utiliza o padrão de arquitetura MVC e segue as boas práticas de desenvolvimento, incluindo o uso de PDO para interação com o banco de dados e o Composer para autoload.

Esta API permite realizar as operações CRUD (Create, Read, Update, Delete) em recursos como salgadinhos, usuários, avaliações e comentários.

## Estrutura do Projeto

- **api/**: Contém a lógica da aplicação, incluindo controladores, serviços, gateways e modelos.
  - **abstract/**: Contém classes abstratas que servem como base para outros serviços.
  - **controllers/**: Controladores que lidam com as requisições HTTP.
  - **core/**: Contém a implementação do roteador e outras funcionalidades auxiliares.
  - **database/**: Responsável pela conexão e interação com o banco de dados.
  - **services/**: Contém a lógica de negócios e interações entre controladores e gateways.
  
- **config/**: Arquivos de configuração, incluindo o arquivo `.ini` para configurar a conexão com o banco de dados.

- **public/**: A pasta pública onde o arquivo de entrada da aplicação (`index.php`) e o arquivo `.htaccess` estão localizados. O arquivo `index.php` é responsável por inicializar a aplicação e tratar as requisições.

- **database/**: Contém o banco de dados SQLite e as definições das tabelas.

## Funcionalidades

- **Listar todos os salgadinhos**: Retorna todos os salgadinhos cadastrados.
- **Buscar salgadinho por ID**: Retorna informações detalhadas de um salgadinho específico através de seu ID.
- **Cadastrar e editar salgadinhos**: Permite a criação e edição de registros de salgadinhos.
- **Avaliações**: Usuários podem avaliar salgadinhos com notas de 0 a 10.
- **Comentários**: Usuários podem deixar comentários sobre salgadinhos.

## Tecnologias Utilizadas

- **PHP 7.x ou superior**
- **PDO** para interação com o banco de dados
- **SQLite** como banco de dados
- **Composer** para gerenciar dependências e autoloading
- **MVC** como padrão de arquitetura

## Configuração

1. Clone o repositório:
   ```bash
   git clone https://github.com/LacamJC/salgadinho_api.git
   ```

2. Instale as dependências do Composer:
   ```bash
   cd salgadinho_api
   composer install
   ```

3. Configure o banco de dados:
   - O banco de dados SQLite é configurado através do arquivo `config/database.ini`. 
   - Se necessário, ajuste as configurações para o seu ambiente local.

4. Crie o banco de dados e as tabelas executando o script SQL `database/tables.db` no seu banco de dados SQLite.

5. Abra o arquivo `.htaccess` na pasta `public/` e configure a base URL caso seja necessário.

## Endpoints

- **GET `/`**: Exibe uma mensagem de boas-vindas.
- **GET `/salgadinhos`**: Retorna uma lista de todos os salgadinhos.
- **GET `/salgadinho/{id}`**: Retorna detalhes de um salgadinho específico com base no ID.
  
Exemplo de requisição:
```bash
curl -X GET http://localhost/salgadinho_api/salgadinho/1
```

## Estrutura do Banco de Dados

O banco de dados contém as seguintes tabelas:

- **salgadinhos**: Informações dos salgadinhos (id, nome, sabor, etc.).
- **usuarios**: Dados dos usuários (id, nome, email).
- **avaliacoes**: Avaliações dos salgadinhos pelos usuários (nota de 0 a 10).
- **comentarios**: Comentários dos usuários sobre os salgadinhos.

## Contribuindo

1. Faça um fork deste repositório.
2. Crie uma branch para sua modificação (`git checkout -b feature/nome-da-feature`).
3. Faça as mudanças necessárias e commit com uma mensagem clara (`git commit -am 'Adiciona nova funcionalidade'`).
4. Push para a branch (`git push origin feature/nome-da-feature`).
5. Abra um Pull Request.

