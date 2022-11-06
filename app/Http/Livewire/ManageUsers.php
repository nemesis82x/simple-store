<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

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
    public $deleteGetId;
    public $totalAdmin;
    public $totalManager;

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
            return view('livewire.manage-users',[
                'users' => User::where('name', 'like', '%'.$this->searchName.'%')
                    ->orderby($this->sortField,$this->sortDirection)
                    ->paginate(6)

            ]);
        }

        if($this->searchEmail) {
            return view('livewire.manage-users',[
                'users' => User::where('email', 'like', '%'.$this->searchEmail.'%')
                    ->paginate(6)

            ]);
        }

        if($this->searchRole) {
            return view('livewire.manage-users',[
                'users' => User::whereHas('roles', function ($query){
                    $query->where('name','like', '%'.$this->searchRole.'%');})
                    ->paginate(6)

            ]);

        }

        return view('livewire.manage-users',[
            'users' => User::with('roles')
                ->paginate(6)

        ]);
    }

    public function mount(){
    $this->totalAdmin = User::whereHas('roles', function ($query){
            $query->where('name','=','Administrator');})
            ->count();

        $this->totalManager = User::whereHas('roles', function ($query){
            $query->where('name','=','Manager');})
            ->count();

    }

}
