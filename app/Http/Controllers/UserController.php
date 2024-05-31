<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('User');
        }else{
            return redirect('');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if($request->New_password === $request->Password_Confirmation){
            $User = User::find($id);
            $User->name = $request->name;
            if($User->password === Hash::make($request->New_password)){
                $User->password = $User->password;
            }else{
                $User->password = Hash::make($request->New_password);
            }
            $User->email = $request->new_email;
            $User->save();
            return redirect('')->with('update_success','Updated !!!');
        }else{
            
            return redirect('');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
