# Ingresse User API

PHP Lumen API to handle users' information in JSON format.

### Setup (with Vagrant)

 - composer install
 - php vendor/bin/homestead make
 - configure the **Homestead.yaml** file generated in the project root with the appropriate params for the Vagrant box. You should also map your project path to the path inside the vagrant box, and the url you define to use to the **public** folder of the project inside the Vagrant box. You must define the two database names (production and testing) in this file 
 - configure your **hosts** file to access the url defined in the **Homestead.yaml** file
 - configure your **.env** file from the **.env.example** file, filling the necessary params for the database access  
 - vagrant up
 - vagrant ssh
 - cd *path/to/project*
 - migrate the two databases
  > php artisan migrate  
    php artisan migrate --database=mysql_testing


### Setup (without Vagrant)

 - composer install
 - create a database and a test database on **mysql** and configure your **.env** with the appropriate access parameters
 - configure your **.env** file from the **.env.example** file, filling the necessary params for the database access
 - migrate the two databases
 > php artisan migrate  
   php artisan migrate --database=mysql_testing
 - deploy server with PHP on localhost, pointing to the public folder. Example:     
 > php -S 0.0.0.0:8000 -t public
 
 
### Usage
 
 #### inserting/adding users
 
 > POST /users  
  *name*, *email*, *phone* and *address* should be provided in the x-www-form-encoded
 
 #### getting information about users
 
 > GET /users  
  will return all users in JSON format  
     
 > GET /users/{id}  
  will return information about the user with the specified id in JSON format
  
 #### updating users
 
 > PATCH /users/{id}  
 > PUT /users/{id}  
  will updated the user with the specified id
  *name*, *email*, *phone* and *address* should be provided in the x-www-form-encoded
  
 #### deleting users
 
 > DELETE /users/{id}  
  will delete the user with the specified id
  
 #### note  
 
 404 code will be returned for all requests regarding non existent ids  
   
### Testing (PHP Unit)

 In the root directory execute the following command to run all tests:
  
  - php vendor/bin/phpunit tests  
  
 If you are using Vagrant, the tests should be run from the Vagrant box. So before running *phpunit* you must execute:  
 
  - vagrant ssh  
  - cd *path/to/project*