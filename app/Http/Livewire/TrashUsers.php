<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TrashUsers extends Component
{
    public $deleteGetId;

    public function render()
    {
        return view('livewire.trash-users',[
            'users' => User::onlyTrashed()
            ->paginate(6)
        ]);
    }

    public function restoreYes($field)
    {
        User::withTrashed()
            ->where('id',$field)
            ->restore();
        $this->redirect('trash'); // Faccio redirect cosi aggiorno la dashboard users
        session()->flash('message', 'User restored succesfully.');
    }

    public function deleteId($field){
        $this->deleteGetId = $field;
    }

    public function deleteYes(){


        $user = User::withTrashed()
            ->findorfail($this->deleteGetId);

        $user->roles()->sync([]); // Cancellare record in pivot table
        $user->forceDelete(); // Cancellare utente permanentemente
        $this->redirect('trash'); // Faccio redirect cosi aggiorno la dashboard users
        session()->flash('message', 'User deleted permanently.');

    }
}
