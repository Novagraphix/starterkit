<?php

use App\Domains\Auth\Models\User;
use function Livewire\Volt\{state};

state(['user' => fn() => $user]);

?>
<x-layouts.app>
    @volt('user')
        <div>
            {{ $user->id }}
        </div>
    @endvolt
</x-layouts.app>
