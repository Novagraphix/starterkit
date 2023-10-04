<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $guard_name;
    public $name;
    public $role;

    protected $rules = [
        'guard_name' => 'required',
        'name' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->role = Role::create([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            dump($e);
            throw new Exception(__('There was a problem creating this role. Please try again.'));
        }

        toastr()->success('Rolle wurde erfolgreich erstellt!', 'Erstellung');

        DB::commit();

        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.auth.role-form');
    }
}
