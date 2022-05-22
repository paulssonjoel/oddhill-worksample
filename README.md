# Backenddemo till Odd Hill
## Initialisera
1. `composer install`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. `docker-compose up -d`
5. `./initdb.sh`

PHP-servern kör på port 80.

## Adresser
* Login till admin: `/login` (lösenord: `pwd`).
* Adminsidor: `/admin/{books,authors,genres}/create` och `/admin/{books,authors,genres}/id`.
* API: `/api/v1/{books,authors,genres}`, `/api/v1/{books,authors,genres}/?searchterm=value`, `/api/v1/{books,authors,genres}/id` och `/api/v1/books/id/{authors,genres,openLibrary}`.

### Värden
* `id` är valfritt ID.
* `searchterm` kan vara följande:
    * `books`: `isbn` och `title`
    * `authors`: `name`
    * `genres`: `name`