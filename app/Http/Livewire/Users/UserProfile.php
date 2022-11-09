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

        $photos = UserPhoto::where('user_id',$user->id)->pluck('id')->toArray();
        $photos = UserPhoto::findOrFail($photos[0]);

        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $role;
        $this->avatar = $photos->name_avatar;
    }

    public function save()
    {
        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;

        $avatar = UserPhoto::where('user_id',auth()->id())
        ->where('type','avatar')
        ->pluck('id')
        ->toArray();
        //dd($avatar);

        $avatar_update = UserPhoto::where('user_id','101')
            ->where('type','avatar')
            ->firstOrFail();

           // dd($avatar);

            $user->photos()->sync('pippo');


       // $avatar = UserPhoto::findOrFail($avatar[0]);

        //dd($avatar);
        $avatar->name = 'avatar';
        $avatar->path = 'ava_path';

        $avatar->save();
        //$user->save();
        $this->redirect('/profile');
        session()->flash('message', 'Profile updated successfully.');
    }
}
