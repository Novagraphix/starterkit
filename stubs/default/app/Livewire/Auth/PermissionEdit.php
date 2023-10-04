<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends Component
{
    public $guard_name;
    public $name;
    public $permission;

    protected $rules = [
        'guard_name' => 'required',
        'name' => 'required',
    ];

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
        $this->name = $permission->name;
        $this->guard_name = $permission->guard_name;
    }

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->permission->update([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            // dump($e);
            throw new Exception(__('There was a problem updating this permission. Please try again.'));
        }

        toastr()->success('Berechtigung wurde erfolgreich aktualisiert!', 'Aktualisierung');

        DB::commit();

        return redirect()->route('permission.index');
    }

    public function render()
    {
        return view('livewire.auth.permission-form');
    }
}
