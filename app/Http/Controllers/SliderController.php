<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    private $pathViewController = 'admin.slider.';

    public function index()
    {
        return view($this->pathViewController .'index');
    }


    public function form( Request $request)
    {
        return view($this->pathViewController .'form');
    }


    public function delete(Request $request)
    {
        return 'SliderController - delete - ID: '. $request->route('id');
    }
}