<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderModel extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = [
        'id', 'name', 'description', 'link'
    ];
    
    protected $crudNotAccepted = [
        '_token', 'thumb_current', 'thumb'
    ];

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
    
    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'description', 'link', 'thumb', 'status')->where('id', '=', $params['id'])->first()->toArray();
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
            $thumb = $params['thumb'];
            $params['thumb'] = Str::random(10) .'.'. $thumb->clientExtension(); 
            $thumb->storeAs('slider', $params['thumb'], 'zvn_storage_image');
            $params = array_diff_key($params, array_flip($this->crudNotAccepted));
            // var_dump($params); die();
            $result = self::insert($params);
        }

        return $result;
    }
    
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
