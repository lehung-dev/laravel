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

    public function listItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-item') {
            // $result = SliderModel::all();
            $query = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');
            if($params['filter']['status'] !== 'all')
            {
                $query->where('status' , '=' , $params['filter']['status']);
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
