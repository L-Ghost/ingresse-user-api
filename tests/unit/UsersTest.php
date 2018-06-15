<?php

namespace Test\Unit;

use Laravel\Lumen\Testing\DatabaseMigrations;

class UsersTest extends \TestCase
{
    use DatabaseMigrations;

    // POST
    public function testPostData()
    {
        // inserting user
        $this->post('/users', [
            'name' => 'Clark Kent', 'email' => 'ck@dailyplanet.com',
            'phone' => '5558837', 'address' => '344 Clinton Street'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 1
            ]
        ])->assertResponseStatus(201);

        // inserting another user
        $this->post('/users', [
            'name' => 'Peter Parker', 'email' => 'peter.p@dailybugle.com',
            'phone' => '5551435', 'address' => 'Aunt May\'s House'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 2
            ]
        ])->assertResponseStatus(201);

        // inserting user with repeated email
        $this->post('/users', [
            'name' => 'Mary Jane', 'email' => 'peter.p@dailybugle.com',
            'phone' => '5551440', 'address' => 'Near Aunt May\'s House'
        ])->seeJson([
            'data' => [
                'message' => 'You cannot insert another user with the same email'
            ]
        ])->assertResponseStatus(409);

        // trying to insert user with invalid data
        $this->post('/users', [
            'name' => 'Steve Rodgers', 'email' => 'no email',
            'phone' => 'no phone'
        ])->seeJsonEquals([
            'address' =>  ['The address field is required.'],
            'email' => ['The email must be a valid email address.'],
            'phone' => ['The phone must be a number.']
        ])->assertResponseStatus(422);
    }

    // POST, GET and PATCH/PUT
    public function testInsertingGettingAndUpdating()
    {
        // inserting user
        $this->post('/users', [
            'name' => 'Bruce Wayne', 'email' => 'bruce_wayne@wayneenterprises.com',
            'phone' => '44555666', 'address' => 'Wayne Manor'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 1
            ]
        ])->assertResponseStatus(201);

        // inserting another user
        $this->post('/users', [
            'name' => 'Robert Bruce Banner', 'email' => 'robert.bb@tutanota.com',
            'phone' => '44555666', 'address' => 'Avengers HQ'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 2
            ]
        ])->assertResponseStatus(201);

        // getting user information
        $this->get('/users/1'
        )->seeJson([
            'name' => 'Bruce Wayne', 'email' => 'bruce_wayne@wayneenterprises.com',
            'phone' => '44555666', 'address' => 'Wayne Manor'
        ])->assertResponseStatus(200);

        // trying to get non existent user
        $this->get('/users/3'
        )->seeJsonEquals([
            'data' => [
                'message' => 'The user with id 3 does not exist'
            ]
        ])->assertResponseStatus(404);

        // updating users
        $this->patch('users/1', [
            'name' => 'Bruce Wayne The Batman', 'email' => 'bruce_wayne@wayneenterprises.com',
            'phone' => '44555888', 'address' => 'Wayne Manor'
        ])->seeJsonEquals([
            'data' => [
                'id' => '1',
                'message' => 'The user has been updated'
            ]
        ])->assertResponseStatus(200);

        $this->put('users/2', [
            'name' => 'Robert Bruce Banner The Hulk', 'email' => 'robert.bb@tutanota.com',
            'phone' => '44555666', 'address' => 'Avengers HQ'
        ])->seeJsonEquals([
            'data' => [
                'id' => '2',
                'message' => 'The user has been updated'
            ]
        ])->assertResponseStatus(200);

        // getting users again to see updates
        $this->get('/users/1'
        )->seeJson([
            'name' => 'Bruce Wayne The Batman', 'email' => 'bruce_wayne@wayneenterprises.com',
            'phone' => '44555888', 'address' => 'Wayne Manor'
        ])->assertResponseStatus(200);

        $this->get('/users/2'
        )->seeJson([
            'name' => 'Robert Bruce Banner The Hulk', 'email' => 'robert.bb@tutanota.com',
            'phone' => '44555666', 'address' => 'Avengers HQ'
        ])->assertResponseStatus(200);

        // trying to update user email to email of previous user
        $this->put('users/2', [
            'name' => 'Robert Bruce Banner The Hulk', 'email' => 'bruce_wayne@wayneenterprises.com',
            'phone' => '44555666', 'address' => 'Avengers HQ'
        ])->seeJsonEquals([
            'data' => [
                'message' => 'There is another user already using this email'
            ]
        ])->assertResponseStatus(409);
    }

    // DELETE
    public function testInsertingAndDeleting()
    {
        // inserting user
        $this->post('/users', [
            'name' => 'Tony Stark', 'email' => 'tony.stark@starkindustries.com',
            'phone' => '77332211', 'address' => 'Malibu Point 10880, 90265'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 1
            ]
        ])->assertResponseStatus(201);

        // getting user
        $this->get('/users/1'
        )->seeJson([
            'name' => 'Tony Stark', 'email' => 'tony.stark@starkindustries.com',
            'phone' => '77332211', 'address' => 'Malibu Point 10880, 90265'
        ])->assertResponseStatus(200);

        // deleting user
        $this->delete('/users/1'
        )->seeJson([
            'data' => [
                'id' => '1',
                'message' => 'The user has been deleted'
            ]
        ])->assertResponseStatus(200);

        // trying to get user after deletion
        $this->get('/users/1'
        )->seeJsonEquals([
            'data' => [
                'message' => 'The user with id 1 does not exist'
            ]
        ])->assertResponseStatus(404);

        // trying to delete non existent user
        $this->delete('/users/2'
        )->seeJson([
            'data' => [
                'message' => 'The user with id 2 does not exist'
            ]
        ])->assertResponseStatus(404);
    }

}