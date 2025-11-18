# novo_hospital
Sistema de dados e acompanhamento hospitalar

# Como rodar os testes unitários do projeto

Um passo a passo simples pra rodar apenas os testes Unit do Laravel.

## 1) Instalar dependências

No diretório do projeto, execute:

```bash
composer install

Requisitos:

Composer — instale a partir de: https://getcomposer.org/download/

Apache (HTTP Server) — baixe/instale a partir de: https://httpd.apache.org/download.cgi

Observação: dependendo do seu ambiente (Valet, Homestead, Laragon, XAMPP, Docker), o Apache pode já estar incluído ou você pode usar outro servidor web (nginx, built‑in PHP server etc.). O importante é ter o ambiente PHP configurado.

```
## 2) Rodar somente os testes Unit
Dentro da pasta do projeto, rode:

```bash

php artisan test --testsuite=Unit
```
Ou, usando o PHPUnit diretamente:

```bash
vendor/bin/phpunit --testsuite=Unit
```
