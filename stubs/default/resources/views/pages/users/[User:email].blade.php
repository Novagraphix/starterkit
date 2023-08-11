<?php

use function Laravel\Folio\{middleware};

middleware(['auth', 'verified']);

?>

<div>
    User {{ $user->name }}
</div>
