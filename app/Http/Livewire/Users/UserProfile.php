<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $role;
    public $photos;
    public $avatar;
    public $hero;
    public $pic01;
    public $pic02;
    public $pic03;

    public $tmp_avatar;

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

        $this->test = $photos->avatar;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $role;
        $this->avatar = $photos->avatar;
        //$this->path_avatar = $photos->path_avatar;
    }

    public function updatedPhoto()

    {

        $this->validate([
            'tmp_avatar' => 'image|max:1024',
        ]);

    }

    public function save()
    {

        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;

        $photos = UserPhoto::where('user_id',$user->id)->pluck('id')->toArray();
        $photos = UserPhoto::findOrFail($photos[0]);
        //$photos->name_avatar = $this->name_avatar;
        $photos->avatar = 'storage/avatar/'.$this->tmp_avatar->getClientOriginalName();

        $this->tmp_avatar->storeAs('avatar', $this->tmp_avatar->getClientOriginalName(), 'public');

/*        $image_path = User::findorFail($this->userId);
        $image_path = 'storage/avatar/' . $image_path->avatar;  // prev image path
        if (File::exists($image_path)) {
            File::delete($image_path);
        }*/



        $photos->save();
        //$user->save();
        $this->redirect('/profile');
        session()->flash('message', 'Profile updated successfully.');
    }
}
