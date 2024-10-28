<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class IviFacade extends Facade 
{
  protected static function getFacadeAccessor()
  {
    return 'iviParser';
  }
}