# TRECO (TRay E-COmmerce)

Projeto como requisito para a vaga de desenvolvedor full stack pleno na Tray/LWSA.

Infelizmente várias coisas aconteceram nesses três dias de realização do desafio, então o que foi feito aqui, foi feito nas poucas vezes que pude me dedicar.

### Primeira utilização

1. Clonar o projeto:

    ```git clone https://github.com/pabloroxo/treco.git```

2. Acessar a pasta do projeto:

    ```cd treco```
 
3. Criar o arquivo de variáveis de ambiente:

    ```cp .env.example .env```

4. Construir e executar os contêineres:

    ```docker-compose up --build -d```

5. Acessar o contêiner do backend:

    ```docker exec -it backend bash```

6. Instalar as dependências do backend:

    ```composer install```

7. Criar o arquivo de variáveis de ambiente:

    ```cp .env.example .env```

8. Gerar a chave única da aplicação:

    ```php artisan key:generate```

9. Executar as migrations do banco de dados:

    ```php artisan migrate```

10. Sair do contêiner do backend:

    ```exit```

11. Acessar o contêiner do frontend:

    ```docker exec -it frontend bash```

12. Instalar as dependências do frontend:

    ```npm install```

13. Criar o arquivo de variáveis de ambiente:

    ```cp .env.example .env```

14. Sair do contêiner do frontend:

    ```exit```

15. Abrir a página no navegador:

    http://localhost:3000


### Utilização no dia a dia no navegador

1. Executar os contêineres:

    ```docker-compose up -d```

2. Abrir a página no navegador:

    http://localhost:3000

### Utilização no dia a dia como API

1. Executar os contêineres:

    ```docker-compose up -d```

2. Realizar as requisições a partir da rota base:

    http://localhost:8000/api

- Rotas:

    | Verbo  | Rota                                    | Corpo/parâmetros                                                                                                       | Retorno              |
    | -      |-                                        |-                                                                                                                       | -                    |
    | GET    | /vendedores                             |                                                                                                                        | Array de vendedores  |
    | GET    | /vendedores/{vendedor_id}               |                                                                                                                        | Objeto do vendedor   |
    | POST   | /vendedores/                            | {<br>&nbsp;&nbsp;&nbsp;&nbsp;nome,<br>&nbsp;&nbsp;&nbsp;&nbsp;email<br>}                                               | Objeto do vendedor   |
    | PUT    | /vendedores/{vendedor_id}               | {<br>&nbsp;&nbsp;&nbsp;&nbsp;nome,<br>&nbsp;&nbsp;&nbsp;&nbsp;email<br>}                                               | Objeto do vendedor   |
    | DELETE | /vendedores/{vendedor_id}               |                                                                                                                        | Booleano da exclusão |
    | GET    | /vendas                                 | ?vendedor_id=<br>&data_venda=                                                                                          | Array de vendas      |
    | GET    | /vendas/{venda_id}                      |                                                                                                                        | Objeto da venda      |
    | POST   | */vendas/                               | {<br>&nbsp;&nbsp;&nbsp;&nbsp;vendedor_id,<br>&nbsp;&nbsp;&nbsp;&nbsp;valor,<br>&nbsp;&nbsp;&nbsp;&nbsp;data_venda<br>} | Objeto da venda      |
    | PUT    | */vendas/{venda_id}                     | {<br>&nbsp;&nbsp;&nbsp;&nbsp;vendedor_id,<br>&nbsp;&nbsp;&nbsp;&nbsp;valor,<br>&nbsp;&nbsp;&nbsp;&nbsp;data_venda<br>} | Objeto da venda      |
    | DELETE | /vendas/{venda_id}                      |                                                                                                                        | Booleano da exclusão |
    | GET    | **/comissoes/{vendedor_id}              |                                                                                                                        | Objeto das comissões |
    | GET    | **/comissoes/{vendedor_id}/{data_venda} |                                                                                                                        | Objeto das comissões |

    \* Rotas sem validação de dados

    \*\* Rotas plajenadas, porém não implementadas

### O que não foi feito ou seria uma melhoria

  - No backend:
    - Concluir a validação do POST e PUT das rotas de vendas.
    - Criar os métodos que retornam as somas das vendas e comissões.
    - Adicionar try-catch em todos os métodos dos controllers.
    - Adicionar transactions em todas as manipulações no banco de dados.
    - Criar exceptions específicas para cada tratamento de exceção.
    - Criar services para injetar nos controllers, e repositories para injetar nos services, todos com bindings com contracts, registrados no ServiceProvider, para separação de camadas.
    - Criar testes unitários com um banco de dados em um ```.env.testing``` à parte, rodando através do comando: ```php artisan test --env=testing```, com factories para criar registros.
    - Criar autenticação com JWT ou o próprio Sanctum mesmo, guardando as rotas.
    - Criar seeders com exemplos de usuários, vendedores e vendas.
    - Adicionar tipos nos parâmetros e retornos dos métodos nas classes.
    - Utilizar o Swagger para documentar as rotas.
    - Implementar o envio de e-mails como solicitado. Os e-mails automáticos do final de cada dia poderiam ser com CRON jobs.
    - Utilização de um broker de mensageria, como o RabbitMQ, para enfileirar os pedidos de envio de e-mail e fazê-los oportunamente.
  - No frontend:
    - Criar tela de login e método de logout.
    - Experimentar o Pinia para os states da aplicação.
    - Criar um CRUD de usuários administradores.
    - Criar um CRUD para as taxas de comissões por período.
    - Utilizar tabelas com processamento server-side para aumentar a performance. Poderia ser o DataTables.
    - Utilizar um componente de lista com pesquisa, como o Select2.
    - Utilizar um componente de texto com máscara para valores monetários, como o v-money.
    - Componentizar o filtro da tela de vendas.
    - Avisos amigáveis na tela quando houver erro de execução no backend e cair no .catch() das requisições.
