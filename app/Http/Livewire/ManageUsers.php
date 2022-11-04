<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public $search = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'page' => ['except' => 1, 'as' => 'p'],

    ];
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $deleteGetId;

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

        if($this->sortField == 'role'){
            //dd($this->sortField);
            return view('livewire.manage-users',[
                'users' => User::wherehas('roles', function ($query){
                        $query->where('name','like','%' . $this->search .'%')
                            ->orderby('name',$this->sortDirection);
                    })
                    ->paginate(6)
            ]);
        }

        return view('livewire.manage-users',[
            'users' => User::with('roles')
            ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email','like', '%'.$this->search.'%')
                ->orwhereHas('roles', function ($query){
                    $query->where('name','like','%' . request('search') .'%');
                })
                ->paginate(6)
        ]);
    }

}


/*'users' => User::with('roles')
    ->where('name','like','%' . $this->search .'%')
    ->paginate(6)*/
