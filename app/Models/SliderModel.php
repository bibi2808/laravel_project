<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Storage;

class SliderModel extends Model
{
    use HasFactory;
    protected $table = 'slider';
    protected $folderUpload = 'slider';
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $fieldSearchAccepted = [
        'id',
        'name',
        'description',
        'link'
    ];
    protected $crudNotAccepted = [
        '_token',
        'thumb_current'
    ];

    public function listItems($params = null, $option = null)
    {
        $result = null;
        
        if ($option['task'] == "admin-list-items") {
            $query = self::select('id', 'name', 'description', 'link', 'thumb', 'created', 'created_by', 'modified', 'modified_by', 'status');
            
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

    public function saveItem($params = null, $option = null){
        if($option['task'] == 'change-status'){
            $status = ($params['currentStatus'] == 'active') ? 'inactive' : 'active';
            self::where('id', $params['id'])
                ->update(['status' => $status]);
        } 
        
        if($option['task'] == 'add-item') {
            
            $thumb = $params['thumb']; // đối tượng thumb
            $params['thumb'] = Str::random(10) . '.' . $thumb->clientExtension();
            $thumb->storeAs($this->folderUpload, $params['thumb'], 'zvn_storage_image'); // ( nơi lưu trữ image sau khi upload, newNameFile )
            $params = array_diff_key($params, array_flip($this->crudNotAccepted));
            self::insert($params);

        }
        
    }

    

    public function getItem($params, $option){
        $result = null;
        
        if($option['task'] == 'get-item'){
            $result = self::select('id', 'name', 'description', 'link', 'thumb', 'status')
                            ->where('id', $params['id'])->first();
        }

        if($option['task'] == 'get-thumb'){
            $result = self::select('id', 'thumb')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }

    public function delete($params = null, $option = null) {
        if($option['task'] == 'delete-item'){
            $item = self::getItem($params, ['task'=>'get-thumb']);
            Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $item['thumb']);
            self::where('id', $params['id'])->delete();
        }
    }
}
