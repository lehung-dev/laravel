<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function listItem($params, $options)
    {
        $result = null;

        if ($options['task'] == 'admin-list-item') {
            // $result = SliderModel::all();
            $result = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status')->get();
        }
        return $result;
    }
}
