# Ingresse User API


### Setup (with Vagrant)

 - composer install
 - configure **hosts** file to access **ingresse-user-api.com**
 - vagrant up
 - php artisan migrate


### Setup (without Vagrant)

 - composer install
 - configure **hosts** file to access **ingresse-user-api.com**
 - create a database on **mysql** and config your **.env** with the appropriate access parameters
 - php artisan migrate
 - php -S 0.0.0.0:8000 -t public