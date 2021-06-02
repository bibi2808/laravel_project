<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AdminModel;
use DB;

class ArticleModel extends AdminModel
{
    // use HasFactory;
    public function __construct()
    {
        $this->table = 'article as a';
        $this->folderUpload = 'article';
        $this->fieldSearchAccepted = ['id','name', 'description', 'link'];
        $this->crudNotAccepted = ['_token', 'thumb_current'];
    }

    public function listItems($params = null, $option = null)
    {
        $result = null;
        
        if ($option['task'] == "admin-list-items") {
            
            $query = self::select('a.id', 'a.name', 'a.content', 'a.thumb', 'a.created', 'a.type', 'a.created_by', 'a.modified', 'a.modified_by', 'a.status', 'a.publish_at', 'a.type', 'c.name as category_name')->leftJoin('category as c', 'a.category_id', '=', 'c.id');
            
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

        if($option['task'] == 'news-list-items') {
            $query = self::select('id', 'name', 'description', 'link', 'thumb')->where('status', '=', 'active')->limit(5);
            $result = $query->get()->toArray();
        }

        return $result;
    }

    public function countItems($params = null, $option = null)
    {
        $result = null;

        if ($option['task'] == "admin-count-items-group-by-status") {
            // $result = self::select('status', DB::raw('count(id) as count, status '))
            //                 ->groupBy('status')
            //                 ->get()->toArray();

            $query = self::select('status', DB::raw('COUNT(id) as count, status '))
                            ->groupBy('status');

            if($params['search']['value'] !== ""){
                if($params['search']['field'] == "all"){
                    $query->where(function($query) use($params) {
                        foreach($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE', "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'],'LIKE', "%{$params['search']['value']}%");
                }
            }

            $result = $query->get()->toArray();
            
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
            $params['created'] = date("Y-m-d");
            $params['created_by'] = 'TuanDA';
            $params['thumb'] = $this->uploadThumb($params['thumb']); // upload new Image
            
            $params = array_diff_key($params, array_flip($this->crudNotAccepted));
            self::insert($this->prepareParams($params));
        }

        if($option['task'] == 'edit-item') {

            // up new image
            if(!empty($params['thumb'])){
                
                $this->deleteThumb($params['thumb_current']); // xóa image from folder
            
                $params['thumb'] = $this->uploadThumb($params['thumb']); // upload new Image
            }

            // không upload image
            $params['modified'] = date("Y-m-d");
            $params['modified_by'] = 'TuanDA';
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        
    }

    public function getItem($params, $option){
        $result = null;
        
        if($option['task'] == 'get-item'){
            $result = self::select('id', 'name', 'content', 'thumb', 'status', 'category_id')
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
            $item = $this->getItem($params, ['task'=>'get-thumb']);
            $this->deleteThumb($item['thumb']); // xóa image from folder
            self::where('id', $params['id'])->delete();
        }
    }
}
