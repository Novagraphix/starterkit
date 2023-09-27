<?php

use function Laravel\Folio\name;

name('users.index');

?>

<x-layouts.app>
    @volt('users')
        <div>
            Users
        </div>
    @endvolt
</x-layouts.app>
