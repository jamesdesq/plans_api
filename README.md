MySQL setup

CREATE USER 'user'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON *.* TO 'user'@'localhost';

ALTER USER 'user'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';


Doctrine installation

You’ll need MySQL running locally on your machine. I’m running 8.0.19. 

You’ll need to create a .env.local file with your database credentials in it, e.g.

DATABASE_URL=mysql://{user}:{password}@127.0.0.1:3306/{my_db}?serverVersion=8.0

bin/console doctrine:database:create

