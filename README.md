# Cherry Store 🛍️

Feito com PHP, Vue 3 e muito amor

## Desafio 👊

### Desenvolva um programa para um mercado que permita:
- Cadastro dos produtos;
- Cadastro dos tipos de cada produto;
- Cadastro dos valores percentuais de imposto dos tipos de produtos;
- A tela de venda, onde serão informados os produtos e quantidades adquiridas;
- O sistema deve apresentar o valor de cada item multiplicado pela quantidade adquirida e a
quantidade pago de imposto em cada item, um totalizador do valor da compra e um
totalizador do valor dos impostos;
- A venda deverá ser salva.

### O sistema deverá ser desenvolvido utilizando:
- PHP 7.4 ou superior;
- PostgreSQL ou MSSQL Server.

### O sistema poderá ser desenvolvido utilizando:
- Bibliotecas frontend como Bootstrap e Material Design;
- Frameworks de frontend como React, Angular e Vue.

## Requisitos 📦
- Docker.

## Como Rodar ▶️
- Clone o repositório `git clone https://github.com/lucasedferreira/cherry-store.git`;
- Vá até a pasta dele;
- Rode `docker compose up`;
- Aguarde alguns instantes.

### O que isto fez?
No arquivo `docker-compose.yml` é criado 4 containers. São eles:
**Banco de Dados**: PostgreSQL na versão 15.4, onde é definido as variáveis de ambiente para acessar o mesmo;
**Backend**: É criado uma imagem a partir do PHP 8.2.6 com apache, instalando os pacotes necessários e subindo a API para a porta 9000;
**Adminer**: Ferramenta para gerenciar o banco de dados;
**Frontend**: É criado uma imagem com node para instalar as dependências, buildar e rodar a aplicação.
Também é rodado um script que cria o banco de dados e já inserem alguns dados para teste.

## Como Acessar a Aplicação e a API 🖥️
Depois que todos os containers estão rodando, é possível acessá-los através das seguintes portas:
Adminer -> http://localhost:5050
host: db
user: postgres
password: changeme
Backend -> http://localhost:9000
Frontend -> http://localhost:9090

## O Tempo Não Permitiu 🕓
Tentei aplicar todos os meus conhecimentos neste desafio, mas infelizmente tive que abrir mão de algumas coisas para focar no que resultaria em mais valor. Investi a maior parte do tempo no backend e o frontend ficou apenas com o que julguei essencial.
Alguns pontos que gostaria de ter adicionado ou feito diferente:
- Testes unitários e de integração;
- Melhorar a forma de Response das rotas na API;
- Adicionar migrações e seeds;
- Usar transactions para rotas com mais de uma alteração no banco de dados;
- Fazer tratamento de erros;
- Rota 404 na API;
- Adicionar máscara para exibir valores em dinheiro no frontend.