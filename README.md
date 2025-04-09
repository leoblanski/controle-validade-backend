## Inicialização do projeto

### Passo a passo

Crie o Arquivo .env
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker compose up -d
```


Acessar o container
```sh
docker exec -it cv-php bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[http://localhost](http://localhost)


Gerar as migrations e seeders

```sh
php artisan migrate

php artisan db:seed
```

Após esse passos você pode iniciar as requisições para os endpoints.

