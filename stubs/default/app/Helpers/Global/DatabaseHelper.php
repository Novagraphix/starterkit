<?php

use App\Domains\Auth\Models\Permission;

if (!function_exists('formReadablePermissions')) {
    function formReadablePermissions($user)
    {
        $readablePermissions = [];
        $permissions = $user->permissions()->get();

        foreach ($permissions as $value) {
            $readablePermissions[str_replace('.', '_', $value->name)] = true;
        }

        return $readablePermissions;
    }
}

if (!function_exists('formWriteablePermissions')) {
    function formWriteablePermissions($permissions)
    {
        $writablePermissions = [];

        foreach ($permissions as $key => $value) {
            if ($value) {
                $writablePermissions[] = str_replace('_', '.', $key);
            }
        }

        return Permission::whereIn('name', $writablePermissions)->get();;
    }
}
