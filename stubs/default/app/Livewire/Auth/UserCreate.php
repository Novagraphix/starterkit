<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserCreate extends Component
{
    public $type;
    public $name;
    public $email;
    public $roles;
    public $password;

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

    public function mount()
    {
        $this->type = 'user';
        $this->model = User::class;

        $collection = Permission::whereRaw('LENGTH(name) - LENGTH(REPLACE(name, ".", "")) >= 3')->get();
        $this->grouped_permissions = $collection->groupBy(function ($item) {
            $parts = explode('.', $item);
            return $parts[2] ?? null;
        });

        $this->all_roles = Role::pluck('name')->toArray();
    }

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->user = User::create([
                'type' => $this->type,
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);

            if (!$this->user->isMasterAdmin()) {
                $tmp = explode(',', $this->roles);
                $roles = Role::whereIn('name', $tmp)->get();
                $this->user->syncRoles($roles ?? []);

                $this->user->syncPermissions(formWriteablePermissions($this->permission) ?? []);
            }
        } catch (Exception $e) {
            DB::rollBack();
            // dump($e);
            throw new Exception(__('There was a problem updating this user. Please try again.'));
        }

        toastr()->success('Benutzer wurde erfolgreich angelegt!', 'Erstellung');

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
        return view('livewire.auth.user-create');
    }
}
