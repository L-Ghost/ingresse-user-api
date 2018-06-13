<?php

namespace Test\Unit;

class UsersTest extends \TestCase
{

    public function testPostData()
    {
        $this->post('/users', [
            'name' => 'Clark Kent', 'email' => 'ck@dailyplanet.com',
            'phone' => '5558837', 'address' => '344 Clinton Street'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 1
            ]
        ])->assertResponseStatus(201);

        $this->post('/users', [
            'name' => 'Peter Parker', 'email' => 'peter.p@dailybugle.com',
            'phone' => '5551435', 'address' => 'Aunt May\'s House'
        ])->seeJson([
            'data' => [
                'message' => 'The user has been created',
                'id_created' => 2
            ]
        ])->assertResponseStatus(201);

        $this->post('/users', [
            'name' => 'Mary Jane', 'email' => 'peter.p@dailybugle.com',
            'phone' => '5551440', 'address' => 'Near Aunt May\'s House'
        ])->seeJson([
            'data' => [
                'message' => 'You cannot insert another user with the same email'
            ]
        ])->assertResponseStatus(409);
    }
}