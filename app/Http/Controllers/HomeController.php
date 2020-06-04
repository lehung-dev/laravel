<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{

    private $pathViewController = 'news.pages.home.'; 
    private $controllerName = 'home';
    private $params = [];

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        return view($this->pathViewController . 'index', [
            'params'            =>  $this->params
        ]);
    }
}
