<?php namespace Gazatem\Glog\Facade;

use Illuminate\Support\Facades\Facade;

class Glog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'glog';
    }
}
