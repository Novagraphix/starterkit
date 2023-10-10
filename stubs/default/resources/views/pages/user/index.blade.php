<?php

use function Laravel\Folio\{name, middleware};
use App\Domains\Auth\Models\User;
use function Livewire\Volt\{state, on};

name('user.index');

middleware(['role:Administrator']);

state(['users' => fn() => User::all()]);

on([
    'delete-user' => function (User $model) {
        $model->delete();
        toastr()->error('Benutzer wurde erfolgreich gelöscht!', 'Löschung');
        return redirect()->route('user.index');
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
        {{ __('Benutzerverwaltung') }}
    </x-slot>

    <x-slot name="buttons">
        <x-ui.button title="{{ __('create') }}"
                     size="md"
                     tag="a"
                     href="/user/create"
                     icon="fas-user-plus"
                     type="success" />
        <x-ui.button title="{{ __('roles') }}"
                     size="md"
                     tag="a"
                     href="/user/role"
                     icon="fas-user-shield"
                     type="info" />
        <x-ui.button title="{{ __('permissions') }}"
                     size="md"
                     tag="a"
                     href="/user/permission"
                     icon="fas-list"
                     type="info" />
    </x-slot>

    <x-ui.content>
        @volt('users')
            <x-ui.table>

                <x-slot:header>
                    <tr
                        class="hidden bg-gray-800 text-[0.55em] uppercase leading-normal text-gray-100 dark:bg-gray-700 dark:text-gray-100 lg:table-row lg:text-[10px] xl:text-xs">
                        <th class="px-2 py-2 text-left">Typ</th>
                        <th class="px-2 text-left">Name</th>
                        <th class="px-6 py-3 text-left">E-Mail</th>
                        <th class="px-6 py-3 text-left">Rollen</th>
                        <th class="px-6 py-3 text-left">Zusätzliche Berechtigungen</th>
                        <th class="px-2"></th>
                    </tr>
                </x-slot:header>

                <x-slot:body>
                    @foreach ($users as $user)
                        <tr
                            class="text-[0.65em] even:bg-gray-100 hover:bg-amber-50 dark:text-gray-100 dark:even:bg-gray-800 lg:text-xs 2xl:text-sm">
                            <td
                                class="block px-2 align-top font-bold before:mr-1 before:font-bold before:content-['Typ'] lg:table-cell lg:p-2 lg:before:content-none">
                                @if ($user->isAdmin())
                                    @lang('Administrator')
                                @elseif ($user->isUser())
                                    @lang('User')
                                @elseif ($user->isApi())
                                    @lang('API')
                                @else
                                    @lang('N/A')
                                @endif
                            </td>
                            <td
                                class="block px-2 align-top before:mr-1 before:font-bold before:content-['Name'] lg:table-cell lg:p-2 lg:before:content-none">
                                <a href="/users/{{ $user->id }}">{{ $user->name }}</a>
                            </td>
                            <td class="px-6 py-3 text-left align-top">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-3 text-left align-top">
                                @if (count($user->roles) > 0)
                                    @foreach ($user->roles as $role)
                                        <strong>{{ $role->name }}</strong>
                                    @endforeach
                                @else
                                    Keine
                                @endif
                            </td>
                            <td class="px-6 py-3 text-left">
                                @if (count($user->permissions) > 0)
                                    @foreach ($user->permissions as $permission)
                                        {{ $permission->name }}<br>
                                    @endforeach
                                @else
                                    Keine
                                @endif
                            </td>
                            <td class="block px-2 py-3 align-top lg:table-cell">
                                <div
                                     class="flex flex-col items-end justify-end text-xs text-gray-700 dark:text-gray-300 dark:hover:text-secondary-400 xl:flex-row xl:items-center xl:gap-2">
                                    <x-ui.button title="{{ __('edit') }}"
                                                 size="xs"
                                                 tag="a"
                                                 href="/user/edit/{{ $user->id }}"
                                                 icon="fas-edit" />

                                    @canBeImpersonated($user)
                                    <x-ui.button type="warning"
                                                 title="{{ __('Impersonate') }}"
                                                 size="xs"
                                                 tag="route"
                                                 href="impersonate"
                                                 :params="$user"
                                                 icon="fas-user-secret" />
                                    @endCanBeImpersonated

                                    <x-ui.button wire:click.live="showConfirmation('delete-user', {{ $user->id }})"
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
