<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\SliderModel              as MainModel;
use App\Http\Requests\SliderRequest     as MainRequest;

class SliderController extends Controller
{

    private $pathViewController = 'admin.pages.slider.'; 
    private $controllerName = 'slider';
    private $params = [];

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 5;

        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field');
        $this->params['search']['value'] = $request->input('search_value');

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
        $data = array();
        $item = null;
        if($request->route('id') !== null)
        {
            $this->params['id'] = $request->route('id');
            $item = $this->model->getItem($this->params, ['task' => 'get-item']);
        }
        
        $data['item'] = $item;
        return view($this->pathViewController . 'form', $data);
    }
    
    public function save(MainRequest $request)
    {
        if($request->method() == 'POST')
        {
            $params = $request->all();

            $task = 'add-item';
            $notify = 'Thêm mới phần tử thành công';

            if($params['id'] !== null)
            {
                $task = 'edit-item';
                $notify = 'Cập nhập phần tử thành công';
            }

            $this->model->saveItem($params, ['task' => $task]);
       
            return redirect()->route($this->controllerName)->with('notify', $notify);
        }
    }


    public function delete(Request $request)
    {
        $this->params['id'] = $request->route('id');
        $result = $this->model->deleteItem($this->params, ['task' => 'delete-item']);
        $mess = ($result) ? 'Đã xóa thành công ID: <strong>'.$this->params['id'].'</strong> thành công' : 'Có lỗi. Vui lòng thử lại';
        return redirect()->route($this->controllerName)->with('notify', $mess);
    }

    public function status(Request $request)
    {
        $this->params['id'] = $request->route('id');
        $this->params['currentStatus'] = $request->status;
        
        $tempStatus = Config::get('pvt.template.status');
        
        $result = $this->model->saveItem($this->params, ['task' => 'change-status']);

        
        $statusChange = ($this->params['currentStatus'] == 'active') ? $tempStatus['inactive']['name'] : $tempStatus['active']['name'] ;
        $mess = ($result) ? 'Thay đổi trạng thái thành: <strong>'.$statusChange.'</strong> thành công' : 'Có lỗi. Vui lòng thử lại';
        return redirect()->route($this->controllerName)->with('notify', $mess);
    }
}
