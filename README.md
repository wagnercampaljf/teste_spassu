# 📘 Documentação do Projeto de Teste Spassu

## 📑 Índice

1. [Criação do Projeto Laravel](#1-criação-do-projeto-laravel)
2. [Configuração do Banco de Dados](#2-configuração-do-banco-de-dados)
3. [Instalação do Breeze](#3-instalação-do-breeze)
4. [Criação das Migrations](#4-criação-das-migrations)
5. [Execução das Migrations](#5-execução-das-migrations)
6. [Criação dos Models](#6-criação-dos-models)
7. [Criação de Factories e Seeders](#7-criação-de-factories-e-seeders)
8. [Criação dos Controllers](#8-criação-dos-controllers)
9. [Criação das Views](#9-criação-das-views)
   - [CRUDs](#91-criação-das-views-dos-cruds)
   - [Relatórios](#92-criação-das-views-dos-cruds-para-relatórios)
   - [Estilização e Máscaras](#93-refatoração-das-telas-aplicando-estilos-e-mascaras)
10. [Instalação do Laravel DOMPDF e Criação de Relatórios](#10-instalação-do-laravel-dompdf-e-criação-de-relatórios)
11. [Criação de Tela de Filtros para o Relatório](#11-criação-de-tela-de-filtros-para-o-relatório)
12. [Implementação de Testes (TDD)](#12-implementação-de-testes-tdd)
13. [Tratamento de Exceções](#13-tratamento-de-exceções)
14. [Testes das Telas](#14-testes-das-telas)
15. [Configuração do Servidor](#15-configuração-do-servidor)
16. [Publicação do Código](#16-publicação-do-código)
17. [Teste do Sistema em Produção](#17-teste-do-sistema-em-produção)

---

## 📦 **Deploy para Produção**
1. [Clonando o Projeto](#1-clonando-o-projeto)
2. [Instalar Dependências](#2-instalar-dependências)
3. [Criar o Arquivo .env](#3-criar-o-arquivo-env)
4. [Gerar Chave da Aplicação](#4-gerar-chave-da-aplicação)
5. [Configurar Banco de Dados](#5-configurar-banco-de-dados)
6. [Configurar Permissões](#6-configurar-permissões)
7. [Configurar Apache](#7-configurar-apache)
8. [Configurar Cache e Otimizar Performance](#8-configurar-cache-e-otimizar-performance)
9. [Reiniciar Servidor Web](#9-reiniciar-servidor-web)
10. [Testar a Aplicação](#10-testar-a-aplicação)

---

## 🔐 **Acesso ao Sistema**
- **URL Acesso**: [https://wagner.vatic.com.br/](https://wagner.vatic.com.br/)
- **Email**: `user@testespassu.com`
- **Senha**: `12345678`

---

## 🛠 **Tecnologias e Ferramentas Utilizadas**
- [PHP 8.2](#php-82)
- [Laravel 12](#laravel-12)
- [Blade](#blade)
- [Bootstrap 5](#bootstrap-5)
- [MySQL](#mysql)
- [Breeze](#breeze)
- [PHPUnit](#phpunit)
- [GitHub](#github)

---


# Documentação do Projeto de Teste Spassu - Desenvolvimento do Projeto

## 1. Criação do Projeto Laravel
Para iniciar o desenvolvimento, foi criado um novo projeto Laravel com o seguinte comando:
```sh
composer create-project laravel/laravel testeSpassu
```

## 2. Configuração do Banco de Dados
O banco de dados foi criado com o nome **testeSpassu**, e as configurações foram definidas no arquivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=testeSpassu
DB_USERNAME=root
DB_PASSWORD=secret
```

## 3. Instalação do Breeze
Para autenticação e gerenciamento de usuários, o Breeze foi instalado:
```sh
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev
```

## 4. Criação das Migrations
As migrations foram criadas para as tabelas **Livro, Assunto, Autor, Livro_Autor e Livro_Assunto**:
```sh
php artisan make:migration create_livro_table
php artisan make:migration create_assunto_table
php artisan make:migration create_autore_table
php artisan make:migration create_livro_autor_table
php artisan make:migration create_livro_assunto_table
php artisan make:migration create_view_relatorio_livros
```

## 5. Execução das Migrations
Após a definição das migrations, elas foram executadas:
```sh
php artisan migrate
```

## 6. Criação dos Models
Foram criados os models correspondentes:
```sh
php artisan make:model Livro
php artisan make:model Assunto
php artisan make:model Autor
php artisan make:model LivroAutor
php artisan make:model LivroAssunto
```

## 7. Criação de Factories e Seeders
Factories e seeders foram criados para popular o banco de dados com exemplos:
```sh
php artisan make:factory LivroFactory --model=Livro
php artisan make:factory AutorFactory --model=Autor
php artisan make:factory AssuntoFactory --model=Assunto
php artisan make:factory LivroAssuntoFactory --model=LivroAssunto
php artisan make:factory LivroAutorFactory --model=LivroAutor
php artisan db:seed
```

## 8. Criação dos Controllers
Controllers foram criados para gerenciar as operações do sistema:
```sh
php artisan make:controller LivroController
php artisan make:controller AutorController
php artisan make:controller AssuntoController
php artisan make:controller RelatorioController
php artisan make:controller DashboardController
```

## 9.1 Criação das Views dos CRUDs
- View: `resources/views/autores/index.blade.php`
- View: `resources/views/autores/create.blade.php`
- View: `resources/views/autores/edit.blade.php`
- View: `resources/views/autores/partials/form.blade.php`
- View: `resources/views/assuntos/index.blade.php`
- View: `resources/views/assuntos/create.blade.php`
- View: `resources/views/assuntos/edit.blade.php`
- View: `resources/views/assuntos/partials/form.blade.php`
- View: `resources/views/livros/index.blade.php`
- View: `resources/views/livros/create.blade.php`
- View: `resources/views/livros/edit.blade.php`
- View: `resources/views/livros/partials/form.blade.php`

## 9.2 Criação das Views dos CRUDs para Relatórios
Foi criada uma view para exibir os relatórios, agrupando livros por autor:
- View: `resources/views/relatorios/livros/index.blade.php`
- View: `resources/views/relatorios/livros/pdf.blade.php`

## 9.3 Refatoração das telas aplicando estilos e mascaras
- Views: `Autores`
- Views: `Assuntos`
- Views: `Dashboard`
- Views: `Livros`
- Views: `Login`
- Views: `Relatório`

## 10. Instalação do Laravel DOMPDF e Criação de Relatórios
Para gerar relatórios em PDF, foi instalado o **Laravel DOMPDF**:
```sh
composer require barryvdh/laravel-dompdf
```
Uma view foi utilizada para exibição e geração dos relatórios.

## 11. Criação de Tela de Filtros para o Relatório
Foram criadas telas para aplicar filtros nos relatórios com as opções:
- Título
- Editora
- Autores
- Assuntos
- Ano inicial
- Ano final


## 12. Implementação de Testes (TDD)
Testes foram implementados para garantir a qualidade do código:
```sh
php artisan make:test AutorTest 
php artisan make:test AssuntoTest 
php artisan make:test LivroTest 
php artisan test
```

## 13. Tratamento de Exceções
Foi implementado `try/catch` sempre que possível para evitar erros inesperados no sistema.

## 14. Testes das Telas
Foram realizados testes manuais para verificar o funcionamento correto das interfaces e dos filtros.

## 15. Configuração do Servidor
O servidor foi configurado para hospedar o código e rodar o projeto corretamente.

## 16. Publicação do Código
O código foi versionado e enviado para produção:
```sh
git init
git add .
git commit -m "Primeira versão do projeto"
git push origin main
```

## 17. Teste do Sistema em Produção
Após subir o sistema, foram realizados testes em ambiente de produção para garantir seu correto funcionamento.



# Documentação do Projeto de Teste Spassu - Deploy para Produção
Este guia descreve os passos para configurar e rodar este projeto Laravel em um ambiente de produção.

## **1. Clonando o Projeto**

Acesse o servidor de produção e execute:
```sh
cd /var/www
sudo git clone https://github.com/wagnercampaljf/teste_spassu.git
cd teste_spassu
```

## **2. Instalar Dependências**

Certifique-se de ter o PHP e o Composer instalados. Em seguida, execute:
```sh
composer install --no-dev --optimize-autoloader
```

## **3. Criar o Arquivo `.env`**

Copie o exemplo de ambiente e edite conforme necessário:
```sh
cp .env.example .env
nano .env
```

Atualize as credenciais do banco de dados e demais configurações:
```
APP_NAME="Teste Spassu"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://wagner.vatic.com.br/

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=testeSpassu
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

## **4. Gerar Chave da Aplicação**

```sh
php artisan key:generate
```

## **5. Configurar Banco de Dados**

Crie o banco de dados manualmente ou via MySQL:
```sh
mysql -u root -p
CREATE DATABASE testeSpassu;
GRANT ALL PRIVILEGES ON testeSpassu.* TO 'seu_usuario'@'localhost' IDENTIFIED BY 'sua_senha';
FLUSH PRIVILEGES;
EXIT;
```

Execute as migrations e seeders:
```sh
php artisan migrate --seed
```

## **6. Configurar Permissões**

Dê permissão ao diretório de armazenamento:
```sh
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache
```

## **7. Configurar Apache**

Crie um arquivo de configuração para o Apache:
```sh
sudo nano /etc/apache2/sites-available/seu-projeto.conf
```

Adicione o seguinte conteúdo:
```
<VirtualHost *:80>
    ServerName seu-dominio.com
    DocumentRoot /var/www/seu-projeto/public

    <Directory /var/www/seu-projeto>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/seu-projeto-error.log
    CustomLog ${APACHE_LOG_DIR}/seu-projeto-access.log combined
</VirtualHost>
```

Ative a configuração e reinicie o Apache:
```sh
sudo a2ensite seu-projeto.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

## **8. Configurar Cache e Otimizar Performance**

```sh
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## **9. Reiniciar Servidor Web**

```sh
sudo systemctl restart apache2
```

## **10. Testar a Aplicação**

Acesse o navegador e teste: [https://wagner.vatic.com.br/](https://wagner.vatic.com.br/)

Caso algo não funcione, verifique os logs:
```sh
tail -f /var/www/teste_spassu/storage/logs/laravel.log
tail -f /var/log/apache2/teste-spassu-error.log
```

**Deploy concluído! 🚀**


# Documentação do Projeto de Teste Spassu - Deploy para Produção
Foi criado um sistema básico de login, e para teste do sistema em produção seguem as credenciais:

```sh
URL Acesso: [https://wagner.vatic.com.br/](https://wagner.vatic.com.br/)
Email: "user@testespassu.com"
Senha: "12345678"
```

## 🛠 Tecnologias e Ferramentas Utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias e ferramentas:

- **PHP 8.2** - Linguagem principal do backend;
- **Laravel 12** - Framework PHP para desenvolvimento web;
- **Blade** - Template engine do Laravel para views;
- **Bootstrap 5** - Framework CSS para estilização e responsividade;
- **MySQL** - Banco de dados relacional utilizado no sistema;
- **Breeze** - Pacote de autenticação leve e flexível para Laravel;
- **PHPUnit** - Framework de testes para garantir a qualidade do código;
- **GitHub** - Plataforma para controle de versão e colaboração no código.

Essas tecnologias foram escolhidas para garantir um desenvolvimento ágil, organizado e eficiente do projeto.
