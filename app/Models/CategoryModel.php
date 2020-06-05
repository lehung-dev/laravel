<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryModel extends AdminModel
{
    
    public function __construct()
    {
        $this->table = 'category';
        $this->folderUpload = 'category';
        $this->fieldSearchAccepted = [ 'id', 'name'];
        $this->fieldSearchAccepted = [ '_token' ];
    }

    /*===================================================================*/
    public function listItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-item') {
            // $result = CategoryModel::all();
            $query = self::select('id', 'name', 'is_home', 'display' ,'created', 'created_by', 'modified', 'modified_by', 'status');

            // Lọc trạng thái
            if ($params['filter']['status'] !== 'all') {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $key) {
                            //you can use orWhere the first time, doesn't need to be ->where
                            $query->orWhere($key, 'LIKE', '%' . $params['search']['value'] . '%');
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', '%' . $params['search']['value'] . '%');
                } else {
                }
            }

            $result = $query->orderBy('id', 'desc')->paginate($params['pagination']['totalItemPerPage']);
        }
                
        if ($options['task'] == 'news-list-item') {
            $query = self::select('id', 'name', 'status');
            $query->where('status', 'LIKE', 'active');
            $result = $query->orderBy('id', 'asc')->limit(8)->get();
        }

        if ($options['task'] == 'news-list-item-is-home') {
            $query = self::select('id', 'name' , 'display');
            $query->where('is_home', '=', 1);
            $result = $query->orderBy('id', 'asc')->limit(8)->get()->toArray();
        }
        return $result;
    }

    /*===================================================================*/
    public function countItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-count-item') {
            // $result = CategoryModel::all();
            $query = self::select(DB::raw('count(id) as count, status'));

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $key) {
                            //you can use orWhere the first time, doesn't need to be ->where
                            $query->orWhere($key, 'LIKE', '%' . $params['search']['value'] . '%');
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', '%' . $params['search']['value'] . '%');
                } else {

                }
            }

            $result = $query->groupBy('status')->get()->toArray();
        }
        return $result;
    }
    
    /*===================================================================*/
    static public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'status')->where('id', '=', $params['id'])->first()->toArray();
        }
        return $result;
    }

    /*===================================================================*/
    public function saveItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'change-status')
        {
            $status = ($params['currentStatus'] == 'active') ? 'inactive' : 'active';
            $result = self::where('id', $params['id'])->update(['status' => $status]);
        }
        
        if($options['task'] == 'change-is-home')
        {
            $isHome = ($params['currentIsHome'] == 1) ? 0 : 1;
            $result = self::where('id', $params['id'])->update(['is_home' => $isHome]);
        }
        
        if($options['task'] == 'change-display')
        {
            $currentDisplay = $params['currentDisplay'];
            $result = self::where('id', $params['id'])->update(['display' => $currentDisplay]);
        }
        
        if($options['task'] == 'add-item')
        {
            $params['created_by'] = 'van hung';
            $params['created'] = date('Y-m-d');
            $params = self::prepareParams($params);
            
            // var_dump($params); die();
            $result = self::insert($params);
        }
        
        if($options['task'] == 'edit-item')
        {
            $params['modified_by'] = 'van hung';
            $params['modified'] = date('Y-m-d');
            $params = self::prepareParams($params);
            // var_dump($params); die();
            $result = self::where('id', $params['id'])->update($params);
        }

        return $result;
    }
    
    /*===================================================================*/
    public function deleteItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'delete-item')
        {
            $result = self::where('id', $params['id'])->delete();
        }
        return $result;
    }
    
}
