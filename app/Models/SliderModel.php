<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SliderModel extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = [
        'id' , 'name' , 'descripstion' , 'link'
    ];

    public function listItem($params = null, $options = null)
    {
        $result = null;

        echo "<pre>";
        print_r($params);
        echo "</pre>";

        if ($options['task'] == 'admin-list-item') {
            // $result = SliderModel::all();
            $query = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');
            
            // Lọc trạng thái
            if($params['filter']['status'] !== 'all')
            {
                $query->where('status' , '=' , $params['filter']['status']);
            }

            if($params['search']['value'] !== '')
            {
                if($params['search']['field'] == 'all')
                {

                }
                else if(in_array($params['search']['field'], $this->fieldSearchAccepted))
                {
                    $query->where($params['search']['field'], 'LIKE' , '%'.$params['search']['value'].'%');
                }
                else{

                }
            }

            $result = $query->orderBy('id','desc')->paginate($params['pagination']['totalItemPerPage']);
        }
        return $result;
    }

    public function countItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-count-item') {
            // $result = SliderModel::all();
            $result = self::select(DB::raw('count(id) as count, status'))
                            ->groupBy('status')
                            ->get()
                            ->toArray();
        }
        return $result;
    }
}
