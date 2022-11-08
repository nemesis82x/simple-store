<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{
    public $name;
    public $email;
    public $role;



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
}
