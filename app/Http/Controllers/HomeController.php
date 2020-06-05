<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\SliderModel ;
use App\Models\CategoryModel  ;


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
        $sliderModel = new SliderModel();
        $list_slider = $sliderModel->listItem(null, ['task'  =>  'news-list-item']);
        
        
        $CategoryModel = new CategoryModel();
        $list_category_is_home = $CategoryModel->listItem(null, ['task'  =>  'news-list-item-is-home']);

        $data = array();
        $data['params']                 =  $this->params;
        $data['list_slider']            =  $list_slider;
        $data['list_category_is_home']  =  $list_category_is_home;

        return view($this->pathViewController . 'index', $data);
    }
}
