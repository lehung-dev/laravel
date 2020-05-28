<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{

    private $pathViewController = 'admin.pages.slider.';
    private $controllerName = 'slider';
    private $params = [];

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 10 ;

        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');

        $result = $this->model->listItem($this->params, ['task' => 'admin-list-item']);
        $itemsStatusCount = $this->model->countItem($this->params, ['task' => 'admin-count-item']);
        

        return view($this->pathViewController . 'index', [
            'params'            =>  $this->params,
            'items'             =>  $result,
            'itemsStatusCount'  =>  $itemsStatusCount
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
