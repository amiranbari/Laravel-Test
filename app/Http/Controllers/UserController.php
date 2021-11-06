<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function store(StoreRequest $request)
    {
        User::query()->create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        return response()->json([
            'status'     =>  201,
            'message'    =>  'User successfuly created.'
        ], 201);
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $userData = [
            'email'     => $request->username,
            'password'  => $request->password
        ];

        if (!Auth::attempt($userData))
            return redirect()->route('login');

        Cache::set('user', auth()->id(), now()->addDays(5));


        return redirect()->route('welcome');
    }

    public function logout()
    {
        Cache::delete('user');
        auth()->logout();
        return redirect()->route('login');
    }
}
