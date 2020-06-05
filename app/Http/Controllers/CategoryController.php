<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\CategoryModel              as MainModel;
use App\Http\Requests\CategoryRequest     as MainRequest;

class CategoryController extends Controller
{

    private $pathViewController = 'admin.pages.category.'; 
    private $controllerName = 'category';
    private $params = [];

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params['pagination']['totalItemPerPage'] = 20;

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
    
    public function is_home(Request $request)
    {
        $this->params['id'] = $request->route('id');
        $this->params['currentIsHome'] = $request->is_home;
        
        $tempIsHome = Config::get('pvt.template.is_home');
        
        $result = $this->model->saveItem($this->params, ['task' => 'change-is-home']);

        
        $isHomeChange = ($this->params['currentIsHome'] == 1) ? $tempIsHome[0]['name'] : $tempIsHome[1]['name'] ;
        $mess = ($result) ? 'Thay đổi trạng thái hiển thị danh sách bài viết thành: <strong>'.$isHomeChange.'</strong> thành công' : 'Có lỗi. Vui lòng thử lại';
        return redirect()->route($this->controllerName)->with('notify', $mess);
    }
    
    
    public function display(Request $request)
    {
        $this->params['id'] = $request->route('id');
        $this->params['currentDisplay'] = $request->display;
        
        $tempDisplay= Config::get('pvt.template.display');
        
        $result = $this->model->saveItem($this->params, ['task' => 'change-display']);

        
        $titleDislay = $tempDisplay[$request->display]['name'] ;
        $mess = ($result) ? 'Thay đổi dạng hiển thị : <strong>'.$titleDislay.'</strong> thành công' : 'Có lỗi. Vui lòng thử lại';
        return redirect()->route($this->controllerName)->with('notify', $mess);
    }
}
