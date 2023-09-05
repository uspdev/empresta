## Conceito

Empréstimos de materiais.

## Funcionalidades

- Gerenciar os materiais das faculdades.
- Gerar PDF com os códigos de barras dos materiais cadastrados.
- Registrar empréstimos de materiais, bem como sua devolução.
- Gerar relatório com os empréstimos realizados.
- Listar materiais que estão emprestados.
- Gerenciar usuários visitantes para realizar empréstimos.

## Procedimentos de deploy
 
- Adicionar a biblioteca PHP referente ao sgbd da base replicada

```bash
composer install
cp .env.example .env
```
- Editar o arquivo .env
    - Dados da conexão na base do sistema
    - Dados da conexão na base replicada
    - Nº USP dos funcionários da secretaria

As diretivas específicas do sistema `empresta` estão documentadas em `config/empresta.php`

- Configurações finais do framework e do sistema:

```bash
php artisan key:generate
php artisan migrate
php artisan vendor:publish --provider="Uspdev\UspTheme\ServiceProvider" --tag=assets --force
```
No ambiente de desenvolvimento, pode-se usar dados fakers:

```bash
php artisan migrate:fresh --seed
```

Caso falte alguma dependência, siga as instruções do `composer`.

## Projetos utilizados

- [uspdev/laravel-usp-theme](https://github.com/uspdev/laravel-usp-theme)
- [uspdev/replicado](https://github.com/uspdev/replicado)
- [uspdev/senhaunica-socialite](https://github.com/uspdev/senhaunica-socialite)
- [uspdev/laravel-usp-faker](https://github.com/uspdev/laravel-usp-faker)
- [uspdev/laravel-usp-validators](https://github.com/uspdev/laravel-usp-validators)


## Contribuindo com o projeto

### Passos iniciais

Siga o guia no site do [uspdev](https://uspdev.github.io/contribua)

### Padrões de Projeto

Utilizamos a [PSR-2](https://www.php-fig.org/psr/psr-2/) para padrões de projeto. Ajuste seu editor favorito para a especificação.
