<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TrashUsers extends Component
{
    use WithPagination;

    public $deleteGetId;
    public $search = '';
    public $searchName = '';
    public $searchEmail = '';
    public $searchRole = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],

    ];
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function updatingSearch()

    {

        $this->resetPage();

    }

    public function sortBy($field)
    {

        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        //dd($field);
        $this->sortField = $field;
    }


    public function render()
    {

        if($this->searchName) {
            return view('livewire.trash-users',[
                'users' => User::onlyTrashed()
            ->where('name', 'like', '%'.$this->searchName.'%')
                    ->orderby($this->sortField,$this->sortDirection)
                    ->paginate(6)

            ]);
        }

        if($this->searchEmail) {
            return view('livewire.trash-users',[
                'users' => User::onlyTrashed()
            ->where('email', 'like', '%'.$this->searchEmail.'%')
                    ->paginate(6)

            ]);
        }


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
