<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    //
    protected $url = 'https://zccore.herokuapp.com/';
    protected $organisation_id = '612a3a914acf115e685df8e3';
    protected $plugin_id = '612e0c38a560ba3687c9ae4b';
    protected $collectionName = 'TodoDemoTask';
    protected $model;



    public function index()
    {
        $tasks = Http::get($this->url . 'data/read/' . $this->plugin_id .'/'. $this->collectionName . '/' . $this->organisation_id)->json();
        return $tasks;
    }
}
