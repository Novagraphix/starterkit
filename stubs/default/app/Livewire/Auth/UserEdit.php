<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    protected $rules = [
        'type' => 'required',
        'name' => 'required|min:6',
        'email' => 'required|email',
        'roles' => '',
        'permissions' => '',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->type = $user->type;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->model = User::class;

        $this->all_roles = Role::pluck('name')->toArray();
        $this->all_permissions = Permission::pluck('name')->toArray();

        $this->roles = $user->roles()->pluck('name')->implode(',');
        $this->permissions = $user->permissions()->pluck('name')->implode(',');
    }

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->user->update([
                'type' => $this->user->isMasterAdmin() ? $this->model::TYPE_ADMIN : $this->type ?? $this->user->type,
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if (!$this->user->isMasterAdmin()) {
                $tmp = explode(',', $this->roles);
                $roles = Role::whereIn('name', $tmp)->get();
                $this->user->syncRoles($roles ?? []);

                $tmp = explode(',', $this->permissions);
                $permissions = Permission::whereIn('name', $tmp)->get();
                $this->user->syncPermissions($permissions ?? []);
            }
        } catch (Exception $e) {
            DB::rollBack();
            // dump($e);
            throw new Exception(__('There was a problem updating this user. Please try again.'));
        }

        toastr()->success('Benutzer wurde erfolgreich aktualisiert!', 'Aktualisierung');

        DB::commit();

        return redirect()->route('user.index');
    }

    public function changeRoles(string $tags): void
    {
        if (empty($tags)) {
            $this->roles = '';
            return;
        }
        $this->roles = collect(json_decode($tags))->pluck('value')->implode(',');
    }

    public function changePermissions(string $tags): void
    {
        if (empty($tags)) {
            $this->permissions = '';
            return;
        }
        $this->permissions = collect(json_decode($tags))->pluck('value')->implode(',');
    }

    public function render()
    {
        return view('livewire.auth.user-edit');
    }
}
