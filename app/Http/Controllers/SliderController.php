<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{

    private $pathViewController = 'admin.pages.slider.';
    private $controllerName = 'slider';

    public function __construct()
    {
        $this->model = new MainModel();
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        $result = $this->model->listItem(null, ['task' => 'admin-list-item']);

        return view($this->pathViewController . 'index', [
            'items'     =>  $result
        ]);
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
