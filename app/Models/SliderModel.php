<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderModel extends AdminModel
{
    
    public function __construct()
    {
        $this->table = 'slider';
        $this->folderUpload = 'slider';
        $this->fieldSearchAccepted = [ 'id', 'name', 'description', 'link' ];
        $this->fieldSearchAccepted = [ '_token', 'thumb_current' ];
    }

    public function listItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-item') {
            // $result = SliderModel::all();
            $query = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');

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
        return $result;
    }

    public function countItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-count-item') {
            // $result = SliderModel::all();
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
    
    static public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'description', 'link', 'thumb', 'status')->where('id', '=', $params['id'])->first()->toArray();
        }
        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', '=', $params['id'])->first()->toArray();
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'change-status')
        {
            $status = ($params['currentStatus'] == 'active') ? 'inactive' : 'active';
            $result = self::where('id', $params['id'])->update(['status' => $status]);
        }
        
        if($options['task'] == 'add-item')
        {
            $params['thumb'] = self::uploadThumb($params['thumb']);;
            $params['created_by'] = 'van hung';
            $params['created'] = date('Y-m-d');
            $params = self::prepareParams($params);
            
            // var_dump($params); die();
            $result = self::insert($params);
        }
        
        if($options['task'] == 'edit-item')
        {
            if(!empty($params['thumb']))
            {
                // Xóa cũ
                self::deleteThumb($params['thumb_current']);
                //Up mới
                $params['thumb'] = self::uploadThumb($params['thumb']);
            }
           
            $params['modified_by'] = 'van hung';
            $params['modified'] = date('Y-m-d');
            $params = self::prepareParams($params);
            // var_dump($params); die();
            $result = self::where('id', $params['id'])->update($params);
        }

        return $result;
    }
    
    public function deleteItem($params = null, $options = null)
    {
        $result = null;
        if($options['task'] == 'delete-item')
        {
            $item = self::getItem($params, ['task' => 'get-thumb']);
            self::deleteThumb($item['thumb']);
            $result = self::where('id', $params['id'])->delete();
        }
        return $result;
    }
    
}
