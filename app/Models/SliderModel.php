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

    public function listItems($params = null, $option = null)
    {
        $result = null;

        if ($option['task'] == "admin-list-items") {
            $result = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status')
                // ->where('id', '>=', 6)
                ->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalPerPage']);
            // ->get();
        }

        return $result;
    }

    public function countItems($params = null, $option = null)
    {
        $result = null;

        if ($option['task'] == "admin-count-items") {
            $result = self::select('status', DB::raw('count(id) as count, status '))
                            ->groupBy('status')
                            ->get()->toArray();
        }

        return $result;
    }
}
