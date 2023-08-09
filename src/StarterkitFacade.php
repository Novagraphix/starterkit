<?php

namespace Novagraphix\Starterkit;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Devdojo\Genesis\Skeleton\SkeletonClass
 */
class StarterkitFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'starterkit';
    }
}
