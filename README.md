<p align="center">
<a href="https://app.swaggerhub.com/apis-docs/dima-php/Tasks/1.0.0" target="_blank">
<img src="https://www.publicdomainpictures.net/pictures/240000/velka/hands-holding-task-word.jpg" width="400">
</a>
</p>

## Installation

```shell
 git clone https://github.com/shkera/task-api.git task
```

```shell
 cd task && composer install
```

```shell
 cp .env.example .env
```

```shell
nano .env
```

```dotenv
DB_HOST=db
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_passwor
```

```shell
php artisan key:generate
```
```shell
php artisan migrate:fresh --seed

```


## Swagger

[Swagger link](https://app.swaggerhub.com/apis-docs/shkera/Tasks/1.0.0)

## Run the application

```shell
php artisan migrate:fresh --seed && php artisan serve
```

or

```shell
php artisan sail:install && ./vendor/bin/sail up -d
```
```shell
./vendor/bin/sail artisan migrate:fresh --seed
```

Open the [link](http://localhost)
