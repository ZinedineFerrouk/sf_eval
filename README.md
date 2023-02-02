# Symfony evaluation from 01/02/2023

## How to install project ?
Configure your environement :

Create .env in root project
Create .env.local in root project
Copy content of .env.exemple in your file
Change your vars env

In terminal at root of you project run : 
- `composer install`

- Execute Migrations: 
`php bin/console doctrine:migr:migr`

- Load fixtures: 
`php bin/console doctrine:fixtures:load --no-interaction`

- To run dev serveur :
`symfony serve --no-tls`

---

A Postman collection is available so you can test the `/create/show` endpoint
