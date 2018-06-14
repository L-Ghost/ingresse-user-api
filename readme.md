# Ingresse User API


### Setup (with Vagrant)

 - composer install
 - configure **hosts** file to access **ingresse-user-api.com**
 - vagrant up
 - php artisan migrate


### Setup (without Vagrant)

 - composer install
 - create a database on **mysql** and config your **.env** with the appropriate access parameters
 - php artisan migrate
 - php -S 0.0.0.0:8000 -t public
 
 
### Usage
 
 ##### inserting/adding users
 
 > POST /users  
  *name*, *email*, *phone* and *address* can be provided in the form data
 
 ##### getting information about users
 
 > GET /users  
  will return all users in JSON format  
     
 > GET /users/{id}  
  will return information about the user with the specified id in JSON format
  
 ##### updating users
 
 > PATCH /users/{id}  
 > PUT /users/{id}  
  will updated the user with the specified id
  *name*, *email*, *phone* and *address* can be provided in the x-www-form-encoded
  
 ##### deleting users
 
 > DELETE /users/{id}  
  will delete the user with the specified id
  
 ##### note  
 
 404 code will be returned for all requests regarding non existent ids  
   
### Testing (PHP Unit)

  on the root directory execute the command to run all tests:
  
  - php vendor/bim/php/unit tests