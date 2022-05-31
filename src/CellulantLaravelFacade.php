<?php

namespace Epmnzava\CellulantLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Epmnzava\CellulantLaravel\Skeleton\SkeletonClass
 */
class CellulantLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cellulant-laravel';
    }
}
