# Plans API

## Overview

This is a prototype app for retrieving information about subscription plans via a REST API. 

## Prerquisites

You can run this app on your local machine, though depending on your setup you may encounter different results. I'm using the following:

- PHP7.1.33, installed with Homebrew
- MySQL 8.0.19, installed with Homebrew
- Symfony 4.4.9
- Composer 1.8.0

## Local installation

- Clone the repo to your local machine 
- Run `cd plans_api`
- Run `composer install`


## Database setup

Create an .env.local file in your project root and add your database credentials, as follows: 

`DATABASE_URL=mysql://{user}:{password}@127.0.0.1:3306/{my_db}?serverVersion=8.0
`
If you're using the same combination of MySQL and PHP as I am, you may need to update your database user to use legacy-style passwords, which you can do as follows: 

`ALTER USER 'user'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password'`

To install the database, run `bin/console doctrine:database:create`

To install the setup the tables in the database, run `bin/console doctrine:migrations:migrate`

To populate the tables, run `bin/console doctrine:fixtures:load`

## Run the app

In the docroot, you should now be able to run `symfony serve` and view the app on http://localhost:8000.

You should be able to visit http://localhost:8000//api/v1/plans to see a list of the available subscription plans as a JSON object. 

## Run the tests

In the project root, run `bin/phpunit` to install PHPUnit's dependencies. 

You should now be able to run `bin/phpunit tests` to run the test suite.

