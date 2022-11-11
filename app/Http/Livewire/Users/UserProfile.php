<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Support\Facades\File;
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
    public $tmp_hero;

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

        //Image Section
        $this->avatar = $photos->avatar;
        $this->hero = $photos->hero;
    }

    public function updatedPhoto()

    {

        $this->validate([
            'tmp_avatar' => 'image|max:1024',
            'tmp_hero' => 'image|max:1024',
        ]);

    }

    public function save()
    {

        $user = User::findOrFail(auth()->id());
        $user->name = $this->name;

        $photos = UserPhoto::where('user_id',$user->id)->pluck('id')->toArray();
        $photos = UserPhoto::findOrFail($photos[0]);
        //$photos->name_avatar = $this->name_avatar;

                if($this->tmp_avatar){
                    $old_avatar = $photos->avatar;  // prev image path
                    //dd($old_avatar);
                    if (File::exists($old_avatar)) {
                        File::delete($old_avatar);
                    }

                $photos->avatar = time(). '_'.$this->tmp_avatar->getClientOriginalName();
                $this->tmp_avatar->storeAs('avatar', time(). '_'. $this->tmp_avatar->getClientOriginalName(), 'public');
                }

                if($this->tmp_hero){
                    $old_hero = $photos->hero;  // prev image path
                    //dd($old_avatar);
                    if (File::exists($old_hero)) {
                        File::delete($old_hero);
                    }

                    $photos->hero = time(). '_'.$this->tmp_hero->getClientOriginalName();
                    $this->tmp_hero->storeAs('hero', time(). '_'. $this->tmp_hero->getClientOriginalName(), 'public');
                }


        $photos->save();
        $user->save();
        $this->redirect('/profile');
        session()->flash('message', 'Profile updated successfully.');
    }
}
