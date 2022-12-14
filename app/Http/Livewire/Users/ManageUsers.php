<?php

namespace App\Http\Livewire\Users;

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
    public $totalUsers;

    public $editGetId;
    public $editName;
    public $editEmail;
    public $allRoles = [];
    public $editRole = [];

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

        // Per fare loop e popolare la select box.
        // va in accoppiata con $this->editRole nella
        // funzione editId
        $this->allRoles = Role::all();

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

        $this->totalBlogger = User::whereHas('roles', function ($query){
            $query->where('name','=','Blogger');})
            ->count();

        $this->totalShop = User::whereHas('roles', function ($query){
            $query->where('name','=','Shop');})
            ->count();

        $this->totalCustomer = User::whereHas('roles', function ($query){
            $query->where('name','=','Customer');})
            ->count();

    }

    public function searchRole($searchRole)
    {

       // dd($searchRole);
        $this->resetPage();
        $this->emit($this->render(), $this->searchRole = $searchRole);
    }

    public function deleteId($field){
        $this->deleteGetId = $field;
    }

    public function deleteYes(){

        $user = User::findorfail($this->deleteGetId);
        $user->roles()->sync([]); // Cancellare record in pivot table
        $user->forceDelete(); // Cancellare utente permanentemente
        $this->redirect('users'); // Faccio redirect cosi aggiorno la dashboard users
        session()->flash('message', 'User deleted permanently.');

    }

    public function trashYes($field){

        $this->deleteGetId = $field;
        $user = User::findorfail($this->deleteGetId);
        //$user->roles()->sync([]); // Mettendo in TRASH non rimuovere sync con pivot
        $user->delete(); // Mettere utente in trash con Softdelete
        $this->redirect('users'); // Faccio redirect cosi aggiorno la dashboard users
        session()->flash('message', 'User successfully move to trash.');

    }

    public function editId($field){
       // $this->deleteGetId = $field;
        $this->editGetId = $field;
        //$user = User::findOrFail($field);
        $user = User::with('roles')
            ->findOrFail($field);
        $this->editName = $user->name;
        $this->editEmail = $user->email;

        $this->editRole = Role::whereHas('users', function($query) {
            $query->where('user_id',$this->editGetId);
        })->pluck('name');

    }

    public function editYes(){
        //dd($this->editGetId);
        //dd($this->editName);
        //dd($this->editRole[0]);

        $user = User::with('roles')->findOrFail($this->editGetId);
        $user->name = $this->editName;
        $user->email = $this->editEmail;

        $userRole = Role::where('name',$this->editRole)->pluck('id');

        $user->roles()->sync($userRole);

        $user->save();
        $this->redirect('users'); // Faccio redirect cosi aggiorno la dashboard users
        session()->flash('message', 'User successfully updated.');
    }

}
