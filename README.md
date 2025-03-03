# Documentação do Projeto Laravel

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

