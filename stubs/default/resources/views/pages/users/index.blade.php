<?php

use function Laravel\Folio\name;
use App\Models\User;
use function Livewire\Volt\{state};

name('users.index');

state(['users' => fn() => User::all()]);
?>

<x-layouts.app>
    @volt('users')
        <x-ui.content>
            <div>
                <x-ui.table>

                    <x-slot:header>
                        <tr
                            class="hidden bg-gray-800 text-[0.55em] uppercase leading-normal text-gray-100 dark:bg-gray-700 dark:text-gray-100 lg:table-row lg:text-[10px] xl:text-xs">
                            <th class="px-2 text-left">ID</th>
                            <th class="px-2 text-left">Name</th>
                            <th class="px-2 text-left">Typ</th>
                            <th class="px-2"></th>
                        </tr>
                    </x-slot:header>

                    <x-slot:body>
                        @foreach ($users as $user)
                            <tr class="text-[0.65em] dark:text-gray-100 lg:text-xs 2xl:text-sm">
                                <td
                                    class="block px-2 before:mr-1 before:font-bold before:content-['ID'] lg:table-cell lg:p-2 lg:before:content-none">
                                    <a href="/users/{{ $user->id }}">{{ $user->id }}</a>
                                </td>
                                <td
                                    class="block px-2 before:mr-1 before:font-bold before:content-['Name'] lg:table-cell lg:p-2 lg:before:content-none">
                                    <a href="/users/{{ $user->id }}">{{ $user->name }}</a>
                                </td>
                                <td
                                    class="block px-2 before:mr-1 before:font-bold before:content-['Typ'] lg:table-cell lg:p-2 lg:before:content-none">
                                    <a href="/users/{{ $user->id }}">Admin</a>
                                </td>
                                <td class="block px-2 lg:table-cell">
                                    <div
                                         class="flex flex-col items-end justify-end text-xs text-gray-700 dark:text-gray-300 dark:hover:text-secondary-400 xl:flex-row xl:items-center xl:gap-2">
                                        <div
                                             class="group flex transition-all duration-500 hover:-translate-y-[2px] hover:text-secondary-500">
                                            <div
                                                 class="transition-color mb-1 mr-1 h-3 w-3 text-gray-900 duration-500 group-hover:text-secondary-500 dark:text-gray-100">
                                                @svg('fas-square-arrow-up-right')
                                            </div>
                                            <a href="/users/{{ $user->id }}"
                                               class="font-medium">bearbeiten</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot:body>

                </x-ui.table>
            </div>
        </x-ui.content>
    @endvolt
</x-layouts.app>
