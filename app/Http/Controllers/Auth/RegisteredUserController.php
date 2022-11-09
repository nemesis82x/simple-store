<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPhoto;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public $totalAdmin;

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $totalAdmin = User::whereHas('roles', function ($query){
            $query->where('name','=','Administrator');})
            ->count();
        //dd($totalAdmin);

        // Il primo utente che si registra avrà ruolo di Administrator
        if($totalAdmin == 0){
            $user->roles()->sync('1'); // 1->Administrator
        }else{
            $user->roles()->sync('5'); // 5->Customer
        }

        //dd($user->id);

        $photos = UserPhoto::create([
            'user_id' => $user->id,
            'name_avatar' => '',
            'path_avatar' => '',
            'name_hero' => '',
            'path_hero' => '',
            'name_pic01' => '',
            'path_pic01' => '',
            'name_pic02' => '',
            'path_pic02' => '',
            'name_pic03' => '',
            'path_pic03' => '',
        ]);



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
