<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Domains\Auth\Models\User;

class UserEdit extends Component
{
    public $type;
    public $name;
    public $email;
    public $roles;
    public $permissions;

    public $all_roles;
    public $all_permissions;
    public $model;
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->type = $user->type;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->model = User::class;
    }

    public function render()
    {
        return view('livewire.auth.user-edit');
    }
}
