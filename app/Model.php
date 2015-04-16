<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    /**
     * Get model descriptor for debugging during demo
     *
     * @return string
     */
    public function getTattle()
    {
        return get_class($this).'::'.$this;
    }
}
