<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return $this->createJsonResponse($users, 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return $this->createJsonResponse($user, 200);
        }
        return $this->createJsonResponse([
            'messsage' => "The user with id {$id} does not exist"
        ], 404);
    }

    public function store(Request $request)
    {
        $user = User::whereEmail($request->get('email'))->first();
        if ($user) {
            return $this->createJsonResponse([
                'message' => 'You cannot insert another user with the same email'
            ], 409);
        }

        $user = User::create($request->all());
        return $this->createJsonResponse([
            'message' => 'The user has been created', 'id_created' => $user->id
        ], 201);
    }

}