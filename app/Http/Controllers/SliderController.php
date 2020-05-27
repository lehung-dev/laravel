<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    private $pathViewController = 'admin.slider.';
    private $controllerName = 'slider';

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        return view($this->pathViewController . 'index');
    }


    public function form(Request $request)
    {
        $data = array('id' => $request->id);
        return view($this->pathViewController . 'form', $data);
    }


    public function delete(Request $request)
    {
        return 'SliderController - delete - ID: ' . $request->route('id');
    }

    public function status(Request $request)
    {
        echo 'SliderController - Status - ID: ' . $request->route('id') . ' - - STATUS: ' . $request->status;
        return redirect()->route('slider');
    }
}
