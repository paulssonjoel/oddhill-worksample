# Backenddemo till Odd Hill
## Start
1. `docker-compose up -d`
2. `./initdb.sh`

## Adresser
* Login till admin: `/login`.
* Adminsidor: `/admin/{books,authors,genres}/create` och `/admin/{books,authors,genres}/id`.
* API: `/api/{books,authors,genres}/?searchterm=value`, `/api/{books,authors,genres}/id` och `/api/books/id/{authors,genres,openLibrary}`.

* `id` är valfritt ID.
* `searchterm` kan vara följande:
    * `books`: `isbn` och `title`
    * `authors`: `name`
    * `genres`: `name`