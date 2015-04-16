<?php namespace App\Events;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

abstract class Event
{
    /**
     * Date created
     *
     * @var Carbon
     */
    public $created_at;

    /**
     * Create new event
     */
    public function __construct()
    {
        $this->created_at = Carbon::now();
    }

    /**
     * Get event summary
     *
     * @param  Model|null $model
     *
     * @return string
     */
    public function getSummary(Model $model = null)
    {
        return get_class($this) .
            ' was fired at '.$this->created_at .
            (!is_null($model) ? ' with '.$model->getTattle() : '');
    }
}
