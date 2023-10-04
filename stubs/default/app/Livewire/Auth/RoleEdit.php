<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    public $guard_name;
    public $name;
    public $role;

    protected $rules = [
        'guard_name' => 'required',
        'name' => 'required',
    ];

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->guard_name = $role->guard_name;
    }

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->role->update([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            // dump($e);
            throw new Exception(__('There was a problem updating this role. Please try again.'));
        }

        toastr()->success('Rolle wurde erfolgreich aktualisiert!', 'Aktualisierung');

        DB::commit();

        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.auth.role-form');
    }
}
