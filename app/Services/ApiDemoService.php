<?php namespace App\Services;

use Illuminate\Support\Facades\Session;

class ApiDemoService
{
    protected $key = 'demo.messages';

    public function push($message)
    {
        Session::push($this->key, $message);
    }

    public function fetch()
    {
        $data = Session::get($this->key);
        Session::flush();

        return $data;
    }
}
