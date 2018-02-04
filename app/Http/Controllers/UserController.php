<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Login
    public function login(Request $request)
    {
        return view('login');
    }

    // Do Login
    public function doLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $check = DB::table('users')
                ->where('username', $username)
                ->first();
                
        if($check)
        {
            if(Hash::check($password, $check->password)){
                $data = array(
                    'id' => $check->id,
                    'username' => $check->username,
                    'fullname' => $check->fullname,
                    'email' => $check->email,
                    'level' => $check->level
                );

                $request->session()->put('login_data', $data);

                return redirect('home');
            }else{
                $request->session()->flash('errors', 'Email or Password Incorrect!');
    
                return redirect('login');
            }
        }else{
            $request->session()->flash('errors', 'Email or Password Incorrect!');

            return redirect('login');
        }
    }

    // Log Out
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('login');
    }
}
