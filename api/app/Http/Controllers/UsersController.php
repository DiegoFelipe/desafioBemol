<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{
    public function store(CreateUserRequest $request) {
        // $validated = $request->validated();
        dd($request->all());

    }
}
