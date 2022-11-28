
## About Project

*Cards* is a little card game that deals 52 cards to given number of players.


> **Requires:**
- **[PHP:8](https://www.docker.com/)**
- - **[Composer](https://getcomposer.org/download/)**
- - **[Node ](https://nodejs.org/en/download/)**

> **File to copy and replace:**
###Copy .env.example and rename as the new .env file

> **Things to run!!:**
>

#### Build servers

``` bash
composer install
npm install
```
#### Start Laravel backend server

```bash
php artisan serve
```

#### Start front-end development server

```bash
npm run dev
```

When servers start, open your browser to [localhost:8000](http://localhost:8000)

#### Run Test

```
# Test Command
docker-compose exec myapp php artisan test

```

