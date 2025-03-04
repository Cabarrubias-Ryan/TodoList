<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function registerAccount(Request $request)
    {
        $result = Account::where('email', $request->email)->first();

        if($result){
            return response()->json(['Error' => 1, 'Message' => 'The email has already been used.']);
        }else{
            $username = Account::where('username', $request->username)->first();

            if($username){
                return response()->json(['Error' => 1, 'Message' => 'The username hase already been used.']);
            }
            else{
                $data = [
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'name' => $request->name,
                    'email' => $request->email,
                    'authentication_type' => null,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ];

                $AddingData = Account::create($data);

                if($AddingData){
                    return response()->json(['Error' => 0, 'Message' => 'Account Successfully Created.']);
                }

            }

        }
    }
    public function loginAccount(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $account = Account::where('username', $request->username)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            return redirect()->back()->withErrors(['username' => 'Invalid credentials'])->withInput();
        }

        Auth::login($account);
        return redirect('/home')->with('login_success', 'You have successfully logged in.');
    }
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            // Get the user information from Google
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Throwable $e) {
            return redirect('/')->with('error', 'Authentication failed.');
        }

        // Check if the user already exists in the database
        $existingUser = Account::where('email', $user->email)->first();
        if ($existingUser) {
            // Log the user in if they already exist
            $Account = Account::where('authentication_type', '=',$provider)->get();

            if($Account){
                Auth::login($existingUser);
            }
            else{
                return redirect('/')->with('error', 'Email has already been used.');
            }
        } else {
            // Otherwise, create a new user and log them in
            $newUser = Account::updateOrCreate([
                'email' => $user->email
            ], [
                'name' => $user->name,
                'email_password' => bcrypt(Str::random(16)), // Set a random password
                'email_verified_at' => now(),
                'account_id' => $user->id,
                'authentication_type' => $provider,
                'created_at' => now(),
                'updated_at' => null,
                'deleted_at' => null,
            ]);
            Auth::login($newUser);
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect('/home')->with('login_success', 'You have successfully logged in.');
    }
    public function logout()
    {
        session()->invalidate();
        session()->regenerateToken();
        Auth::logout();

        // Redirect to the homepage or login page
        return redirect('/');
    }
}
