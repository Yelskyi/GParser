<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleSearchFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'googleSearch';
    }
}