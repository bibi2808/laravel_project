<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function listItems($params, $option)
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
}
