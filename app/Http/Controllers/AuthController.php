<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request){
        if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){
            if (Auth::user()->permision === "user") {
                $request->session()->regenerate();
                return redirect('/User');
            }else {
                $request->session()->regenerate();
                return redirect('/Admin');
            }
        }
        return back();
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function NewUser(Request $request)
    {
        if($request->password === $request->password_Confirmation){
            $User = new User();
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);
            $User->permision = 'user';
            $User->save();

            if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){
                if (Auth::user()->permision === "user") {
                    $request->session()->regenerate();
                    return redirect('/User');
                }
            }
        }else{
            return redirect()->route('Signup');
        }
    }
}
