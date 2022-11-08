<?php

namespace App\Http\Livewire\Users;

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
        $this->pippo = 'ciao';
    }
}
