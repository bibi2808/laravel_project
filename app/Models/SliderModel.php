<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SliderModel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = [
        'id',
        'name',
        'description',
        'link'
    ];

    public function listItems($params = null, $option = null)
    {
        // echo '<pre>';
        //     print_r($params);
        //     echo '<pre/>';
        $result = null;
        
        if ($option['task'] == "admin-list-items") {
            $query = $this::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');
            
            if($params['filter']['status'] !== "all"){
                $query->where('status', '=', $params['filter']['status']);
            }

            if($params['search']['value'] !== ''){
                if($params['search']['field'] == 'all'){
                    $query->where(function($query) use($params) {
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE', '%' . $params['search']['value'] . '%');
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)){
                    $query->where($params['search']['field'], 'LIKE', '%' . $params['search']['value'] . '%');
                }
            }

            $result = $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalPerPage']);
        }

        return $result;
    }

    public function countItems($params = null, $option = null)
    {
        $result = null;

        if ($option['task'] == "admin-count-items-group-by-status") {
            $result = self::select('status', DB::raw('count(id) as count, status '))
                            ->groupBy('status')
                            ->get()->toArray();
        }

        return $result;
    }
}
