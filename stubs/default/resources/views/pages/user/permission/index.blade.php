<?php

use function Laravel\Folio\{name, middleware};
use function Livewire\Volt\{state, on};
use Spatie\Permission\Models\Permission;

name('permission.index');

middleware(['role:Administrator']);

state(['permissions' => fn() => Permission::all()]);

on([
    'delete-permission' => function (Permission $model) {
        $model->delete();
        toastr()->error('Berechtigung wurde erfolgreich gelöscht!', 'Löschung');
        return redirect()->route('permission.index');
    },
]);

$showConfirmation = function ($method, $id) {
    $this->dispatch('swal:confirm', [
        'icon' => 'error', // warning, error, success, info, and question
        'title' => 'Bist Du Dir sicher, dass Du das tun willst?',
        'confirmText' => 'Ja, weiter!',
        'method' => $method,
        'params' => $id, // optional, send params to success confirmation
        'callback' => '', // optional, fire event if no confirmed
    ]);
};

?>

<x-layouts.app>
    <x-slot name="header">
        {{ __('Berechtigungsverwaltung') }}
    </x-slot>

    <x-slot name="buttons">
        <x-ui.button title="{{ __('create') }}"
                     size="md"
                     tag="a"
                     href="/user/permission/create"
                     icon="fas-plus"
                     type="success" />
        <x-ui.button title="{{ __('back') }}"
                     size="md"
                     tag="a"
                     href="/user"
                     icon="fas-backspace"
                     type="secondary" />
    </x-slot>

    <x-ui.content>
        @volt('permissions')
            <x-ui.table>

                <x-slot:header>
                    <tr
                        class="hidden bg-gray-800 text-[0.55em] uppercase leading-normal text-gray-100 dark:bg-gray-700 dark:text-gray-100 lg:table-row lg:text-[10px] xl:text-xs">
                        <th class="px-2 py-2 text-left">Typ</th>
                        <th class="px-2 text-left">Name</th>
                        <th class="px-2"></th>
                    </tr>
                </x-slot:header>

                <x-slot:body>
                    @foreach ($permissions as $permission)
                        <tr
                            class="text-[0.65em] even:bg-gray-100 hover:bg-amber-50 dark:text-gray-100 dark:even:bg-gray-800 lg:text-xs 2xl:text-sm">
                            <td
                                class="block px-2 font-bold before:mr-1 before:font-bold before:content-['Typ'] lg:table-cell lg:p-2 lg:before:content-none">
                                {{ $permission->guard_name }}
                            </td>
                            <td
                                class="block px-2 before:mr-1 before:font-bold before:content-['Name'] lg:table-cell lg:p-2 lg:before:content-none">
                                {{ $permission->name }}
                            </td>
                            <td class="block px-2 lg:table-cell">
                                <div
                                     class="flex flex-col items-end justify-end text-xs text-gray-700 dark:text-gray-300 dark:hover:text-secondary-400 xl:flex-row xl:items-center xl:gap-2">
                                    <x-ui.button title="{{ __('edit') }}"
                                                 size="xs"
                                                 tag="a"
                                                 href="/user/permission/edit/{{ $permission->id }}"
                                                 icon="fas-edit" />

                                    <x-ui.button wire:click.live="showConfirmation('delete-permission', {{ $permission->id }})"
                                                 size="xs"
                                                 type="danger"
                                                 icon="fas-trash" />

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>

            </x-ui.table>
        @endvolt
    </x-ui.content>
</x-layouts.app>
