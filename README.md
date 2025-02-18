# Demonstração do Projeto

<div align="center">
    <image src="./public/assets/demo/register_page.png" alt="Tela de Registro" width="380">
    <image src="./public/assets/demo/dashboard_page.png" alt="Tela Inicial" width="380">
    <image src="./public/assets/demo/products_page.png" alt="Tela de Produtos" width="380">
    <image src="./public/assets/demo/chats_page.png" alt="Tela de Conversas" width="380">
    <image src="./public/assets/demo/settings_page.png" alt="Tela de Configurações" width="380">
</div>

# Requisitos  

- Servidor PHP Local Apache e MySQL (Sugestão: [XAMPP](https://www.apachefriends.org/pt_br/download.html))
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/) (para instalação das dependências do Laravel)

# Instalação e Execução

## 1. Clone o repositório
Primeiro, clone o repositório do projeto (ou baixe o repositório pelo GitHub) dentro da pasta htdocs:

    git clone https://github.com/jesse-barbosa/TechMix-web.git

## 2. Importe o banco

- 2.1 Primeiro, ligue o servidor Apache e MySQL no XAMPP
- 2.2 Acesse o painel PhpMyAdmin: Digite "localhost/" no endereço de pesquisa do seu navegador
- 2.3 Crie um novo banco de dados com o nome "dbtechmix"
- 2.4 Clique na opção de importar
- 2.5 Importe o arquivo SQL localizado na pasta "banco" do projeto

## 3. Instale as dependências do Laravel

Primeiro, abra a pasta `TechMix-web` no terminal:

    cd TechMix

Em seguida, instale as dependências:

    composer install

## 4. Crie o arquivo .env do Laravel

Dentro da pasta `TechMix-web`, copie o arquivo de exemplo `.env.example` e renomeie para `.env`

## 5. Gere a chave da aplicação Laravel

Ainda dentro da pasta `TechMix-web`, execute o seguinte comando para gerar a chave da aplicação:

    php artisan key:generate

Esse comando criará e armazenará uma chave única no arquivo `.env`, essencial para a segurança e criptografia do Laravel.

## 6. Execute o Projeto  

Você pode iniciar o projeto diretamente com o comando:

    php artisan serve

Agora, abra o seu navegador no endereço:

    http://127.0.0.1:8000/

Agora o projeto Laravel deve rodar no seu navegador.

Se encontrar algum problema ou tiver dúvidas, consulte a [documentação oficial do Laravel](https://laravel.com/) ou entre em contato comigo pelo meu e-mail: [barbosajesse419@gmail.com](mailto:barbosajesse419@gmail.com).