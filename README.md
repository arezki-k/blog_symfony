# Try it
https://boiling-ridge-17442.herokuapp.com
# Installation

1. Clone or download repository

   https://github.com/arezki-k/EcommerceSymfony

2. Move to project directory and run composer 
 
    ```
    cd ./EcommerceSymfony
    composer install
    ```
3. Configure the .env with your database url, user and password.
4. Create the database with doctrine and make migrations to create tables:
   1.  `php bin/console doctrine:database:create `
   2.  `php bin/console make migration `
   3.   `php bin/console doctrine:migrations:migrate `
5. Create an Admin user to have access to the admin interface
   1. First hash a password with `php bin/console security:encode-password`, and copy the result.
   2. Execute the following query:
    ```SQL
    insert into user(email, role, password, name) values('youemail@email.com','\["ROLE_ADMIN"\]','your hashed password','your name');
 
    ```
6. Run the server: with symfony cli:
   `symfony server:start`
7. You can access the admin dashboard in localhost:8000/admin
   
# Introduction & environement
php framwork, enforces best practises, easy maintenance, modular.

### MVC architecture

M=>model
V=>view
C=>controller

### REST (Representational state transfer)

An architectural system centered around resources and hypermedia, via HTTP protocols.

```
get
post
put
patch
delete
```

### CRUD (create, read, update, delete)

a cycle meant for maintaining permanent records in a database setting.
CRUD principles are mapped to REST commands to comply with the goals of RESTful architecture.

### configuration file format in symfony:

1. Annotaions
2. YML
3. XML
4. PHP

### environment:

first update packages:

```
sudo apt-get update

```

install mysql, php and apach2

```
sudo apt-get install mysql-server mysql-client
sudo apt-get install apach2
sudo apt-get install  php-cli php-xml libapache2-mod-php

```

install composer:

```
sudo apt install curl
cd ~
curl -sS <https://getcomposer.org/installer> -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

```

download symfony cli

```
wget <https://get.symfony.com/cli/installer> -O - | bash

```

### Create a symfony application:

with composer:

```
composer create-project symfony/skeleton myProject

```

with Symfony cli

```
 symfony new --full SymfonyCourseProject

```

install local certificate for https

```
symfony server:ca:install

```

Launch the demo app

```
symfony server:start

```

List all running servers:

```
symfony server:list

```

list installed php version

```
symfony  local:php:list

```

start with a proxy

```
symfony  proxy:start

```

attach a domain to proxy `by default ends with .wip`

```
symfony proxy:domain:attach symfonyproject

```

show logs:

```
symfony server:log

```

start server, stop server and server status

```
symfony server:start
symfony server:stop
symfony server:status

```

show all php console command

```
php bin/console
symfony console

```

install cors

```
composer require cors

```

install bundles  `--dev for development`

```
composer require yourBundle  

```

remove bundles

```
composer remove yourBundle

```

show all recipes

```
composer recipes

```

create controller

```
symfony console make:controller YourController

```

### configuration parameter

it's recommended to define our conf param in /config/services.yaml.

```yaml
parameters:
    app.myparam

```

list all parameters:

```
symfony console debug:container --parameters

```

list value on a parameter:

```
symfony console debug:container --parameter=app.myparameter

```

Access to env var in configuration file:

```yaml
parameter:
    app.param: '%env(MYENVVAR)%'

```

Resolve in conf file:
resole allows to resolve conf params in url or other;
for example:

```yaml
doctrine:
    url: '%env(resolve(DATABASE_URL))%'

```