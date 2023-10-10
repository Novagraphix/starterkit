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

    public $all_roles;
    public $grouped_permissions;
    public $model;
    public $user;
    public $permission = [];

    protected $rules = [
        'type' => 'required',
        'name' => 'required|min:6',
        'email' => 'required|email',
        'roles' => '',
        'permission' => '',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->type = $user->type;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->model = User::class;

        $this->all_roles = Role::pluck('name')->toArray();

        $collection = Permission::whereRaw('LENGTH(name) - LENGTH(REPLACE(name, ".", "")) >= 3')->get();
        $this->grouped_permissions = $collection->groupBy(function ($item) {
            $parts = explode('.', $item);
            return $parts[2] ?? null;
        });

        $this->permission = formReadablePermissions($user);

        $this->roles = $user->roles()->pluck('name')->implode(',');
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

            $tmp = explode(',', $this->roles);
            $roles = Role::whereIn('name', $tmp)->get();
            $this->user->syncRoles($roles ?? []);

            $this->user->syncPermissions(formWriteablePermissions($this->permission) ?? []);
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

    public function render()
    {
        return view('livewire.auth.user-edit');
    }
}
