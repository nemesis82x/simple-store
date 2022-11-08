<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use App\Models\UserPhoto;
use Livewire\Component;

class UserProfile extends Component
{
    public $name;
    public $email;
    public $role;
    public $avatar;
    public $hero;
    public $pic01;
    public $pic02;
    public $pic03;



    public function render()
    {
        return view('livewire.user-profile');
    }

    public function mount()
    {

        $user = User::with('roles')->findOrFail(auth()->id());
        $role = Role::whereHas('users', function($query) {
            $query->where('user_id',auth()->id());
        })->pluck('name');

        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $role;
    }

    public function save()
    {
        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;

        $avatar = new UserPhoto;
        $avatar->name = 'avatar';


        $user->photos()->save($avatar);
        $user->save();
        $this->redirect('/profile');
        session()->flash('message', 'Profile updated successfully.');
    }
}
