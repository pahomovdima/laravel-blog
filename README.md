# Blog
Сырой проект - админка и публичная часть блога.

## Установка

1. git clone репозиторий

2. Установить зависимости
````
composer install
````

3. cp .env.example .env` - copy .env file

4. set your DB credentials in `.env`

5. Сгенерировать ключ приложения
````
php artisan key:generate
````

6. Migrate
````
php artisan migrate --seed
````

7. Install Node modules
````
npm install
````
***
## Запуск

- ```npm run watch``` или ```npm run dev```
- ```php artisan serve```
***
