<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if($credentials) {

            $user = User::create(['name' =>$request->name, 'email' => $request->email, 'password' => Hash::make($request->password)]);

            // with api token
            //$token = $user->createToken('MyApp')->plainTextToken;

            // with session cookie
            Auth::login($user);
            return response()->json(['message' => 'You`re registered successfully.']);

        }

    }

    public function login(UserRequest $request)
    {

        $credentials = $request->validated();

        //with session cookie
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response(['flag' => 'green', 'message' => 'You`re logged in.']);
        }

        return response(['flag' => 'red', 'message' => 'You`re not logged in. Your email or password are incorrect. Please type again.']);

    }

    public function logout(Request $request)
    {

        //for api token
        //auth('sanctum')->user()->currentAccessToken()->delete();\

        //for session cookie
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response(['flag' => 'green', 'message' => 'You`re logout successfully.']);

    }

}
