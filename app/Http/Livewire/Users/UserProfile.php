<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use App\Models\User;
use App\Models\UserPhoto;
use Illuminate\Support\Facades\File;
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
    public $tmp_pic01;
    public $tmp_pic02;
    public $tmp_pic03;

    protected $rules = [

        'tmp_avatar' => 'image|max:1024',
        'tmp_hero' => 'image|max:1024',
        'tmp_pic01' => 'image|max:1024',

    ];

    public function updated($field){

        $this->validateOnly($field);

    }

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

        //Image Section
        $this->avatar = $photos->avatar ? $photos->avatar : 'default.jpg';
        $this->hero = $photos->hero ? $photos->hero : 'default.jpg';
        $this->pic01 = $photos->pic01 ? $photos->pic01 : 'default.jpg';
        $this->pic02 = $photos->pic02 ? $photos->pic02 : 'default.jpg';
        $this->pic03 = $photos->pic03 ? $photos->pic03 : 'default.jpg';
    }

    public function save()
    {
        $this->validate();

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

                    if($this->tmp_pic01){
                        $old_pic01 = $photos->pic01;  // prev image path
                        //dd($old_avatar);
                        if (File::exists($old_pic01)) {
                            File::delete($old_pic01);
                        }

                        $photos->pic01 = time(). '_'.$this->tmp_pic01->getClientOriginalName();
                        $this->tmp_pic01->storeAs('picture', time(). '_'. $this->tmp_pic01->getClientOriginalName(), 'public');
                    }

                    if($this->tmp_pic02){
                        $old_pic02 = $photos->pic02;  // prev image path
                        //dd($old_avatar);
                        if (File::exists($old_pic02)) {
                            File::delete($old_pic02);
                        }

                        $photos->pic02 = time(). '_'.$this->tmp_pic02->getClientOriginalName();
                        $this->tmp_pic02->storeAs('picture', time(). '_'. $this->tmp_pic02->getClientOriginalName(), 'public');
                    }

                    if($this->tmp_pic03){
                        $old_pic03 = $photos->pic03;  // prev image path
                        //dd($old_avatar);
                        if (File::exists($old_pic03)) {
                            File::delete($old_pic03);
                        }

                        $photos->pic03 = time(). '_'.$this->tmp_pic03->getClientOriginalName();
                        $this->tmp_pic03->storeAs('picture', time(). '_'. $this->tmp_pic03->getClientOriginalName(), 'public');
                    }


        $photos->save();
        $user->save();
        $this->redirect('/profile');
        session()->flash('message', 'Profile updated successfully.');
    }
}
