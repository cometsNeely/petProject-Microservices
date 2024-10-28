<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class IviJobFacade extends Facade 
{
  protected static function getFacadeAccessor()
  {
    return 'iviJob';
  }
}