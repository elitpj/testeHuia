<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $rules = [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return json_encode($validator->messages());
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request) {
        $rules = [
            'email' => 'email|required',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return json_encode($validator->messages());
        }

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
