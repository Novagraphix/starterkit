<?php

namespace App\Livewire\Auth;

use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Domains\Auth\Models\Permission;

class PermissionCreate extends Component
{
    public $guard_name;
    public $name;
    public $permission;

    protected $rules = [
        'guard_name' => 'required',
        'name' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $this->permission = Permission::create([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            dump($e);
            throw new Exception(__('There was a problem creating this permission. Please try again.'));
        }

        toastr()->success('Berechtigung wurde erfolgreich erstellt!', 'Erstellung');

        DB::commit();

        return redirect()->route('permission.index');
    }

    public function render()
    {
        return view('livewire.auth.permission-form');
    }
}
