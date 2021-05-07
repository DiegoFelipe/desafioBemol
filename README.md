# Desafio Técnico Bemol

## Stack

- Aplicação: Laravel
- Banco de dados: PostgreSQL
- Docker ([Laradock](https://laradock.io/))
- Nginx (WEB Server)

## Requisitos

- PHP na versão 7.3+

## Setup

### Instalar o laradock

1 - Baixar o laradock

```sh
git clone https://github.com/Laradock/laradock.git
```

2 - Entrar na pasta do laradock e executar:

```sh
cp .env.example .env
```

3 - Ainda na pasta do laradock editar o aquivo .env:

```
APP_CODE_PATH_HOST=../desafioBemol
```

4 - Entrar na pasta nginx que está dentro de laradock e depois entrar na pasta sites e executar o comando:

```sh
cp laravel.conf.example bemol.conf
```

5 - Editar o arquivo bemol.conf como a seguir:

```
#server {
#    listen 80;
#    server_name laravel.com.co;
#    return 301 https://laravel.com.co$request_uri;
#}

server {

    listen 80;
    listen [::]:80;

    # For https
    # listen 443 ssl;
    # listen [::]:443 ssl ipv6only=on;
    # ssl_certificate /etc/nginx/ssl/default.crt;
    # ssl_certificate_key /etc/nginx/ssl/default.key;

    server_name bemol.digital;
    root /var/www/api/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }

    error_log /var/log/nginx/laravel_error.log;
    access_log /var/log/nginx/laravel_access.log;
}

```

6 - Editar o arquivo /etc/hosts da máquina, adicionar esta linha:

```
127.0.0.1 bemol.digital
```

7 - Clonar este repositório no mesmo nível da pasta do laradock:

```sh
git clone https://github.com/DiegoFelipe/desafioBemol.git
```

8 - Entrar na pasta _desafioBemol_ e executar o comando:

```
cp .env.example .env
```

9 - Editar as configurações de conexão com o banco de dados no arquivo .env do seguinte modo:

```
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
```

10 - Dentro da pasta do laradock, executar o comando:

```sh
sudo docker-compose up -d pgadmin postgres nginx
```

11 - Entrar no container workspace:

```sh
sudo docker-compose exec workspace bash
```

12 - Entrar na pasta api:

```sh
cd api
```

13 - Executar os comandos:

```sh
composer install
php artisan migrate
cp resources/css/app.css public/css
```

14 - Acessar a aplicação pelo browser:

http://bemol.digital
