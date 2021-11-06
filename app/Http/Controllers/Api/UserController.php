<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserRecourse;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return UserRecourse::collection(User::all());
    }
}
