<?php

namespace App\Http\Livewire;


use Illuminate\Http\Request;
use Livewire\Component;

class EditUser extends Component
{
    public $user;
    public $name;
    public $email;

    public function render()
    {
        return view('livewire.edit-user',[
            $this->name = 'pippo',
            $this->email = 'email'
        ]);
    }



    public function editId($field)
    {
        $this->name = 'pippo';
        $this->email = 'email';
    }
}
