<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AdminModel;
use DB;

class CategoryModel extends AdminModel
{
    // use HasFactory;
    public function __construct()
    {
        $this->table = 'category';
        $this->folderUpload = 'category';
        $this->fieldSearchAccepted = ['id','name'];
        $this->crudNotAccepted = ['_token'];
    }

    public function listItems($params = null, $option = null)
    {
        $result = null;
        
        if ($option['task'] == "admin-list-items") {
            $query = self::select('id', 'name', 'created', 'created_by', 'modified', 'modified_by', 'display', 'status', 'is_home');
            
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
            $query = self::select('id', 'name')->where('status', '=', 'active')->limit(8);
            $result = $query->get()->toArray();
        }

        if($option['task'] == 'news-list-category-is-home') {
            $query = self::select('id', 'name', 'display')->where('status', '=', 'active')->where('is_home', '=', 'yes')->limit(8);
            $result = $query->get()->toArray();
        }

        if($option['task'] == 'admin-list-items-in-selecbox') {
            $query = self::select('id', 'name')->where('status', '=', 'active')->orderBy('name', 'asc');
            $result = $query->get()->pluck('name', 'id')->toArray();
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
            
            self::insert($this->prepareParams($params));
        }

        if($option['task'] == 'edit-item') {
            $params['modified'] = date("Y-m-d");
            $params['modified_by'] = 'TuanDA';
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if($option['task'] == 'change-is-home'){
            $params['currentIsHome'];
            
            $isHome = ($params['currentIsHome'] == 'yes') ? 'no' : 'yes';
            self::where('id', $params['id'])
                ->update(['is_home' => $isHome]);
        } 

        if($option['task'] == 'change-display') {
            $display = $params['currentDisplay'];
            $params['modified_by'] = 'TuanDA';
            self::where('id', $params['id'])->update(['display' => $display]);
        }
        
        
    }

    public function getItem($params, $option){
        $result = null;
        
        if($option['task'] == 'get-item'){
            $result = self::select('id', 'name', 'status')->where('id', $params['id'])->first();
        }

        if($option['task'] == 'news-get-item'){
            $result = self::select('id', 'name', 'display')->where('id', $params['category_id'])->first();
            if($result) $result = $result->toArray();
        }

        return $result;
    }

    public function delete($params = null, $option = null) {
        if($option['task'] == 'delete-item'){
            
            self::where('id', $params['id'])->delete();
        }
    }
}
