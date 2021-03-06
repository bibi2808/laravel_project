<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AdminModel;
use DB;

class UserModel extends AdminModel
{
    // use HasFactory;
    public function __construct()
    {
        $this->table = 'user';
        $this->folderUpload = 'user';
        $this->fieldSearchAccepted = ['id','username', 'email', 'fullname'];
        $this->crudNotAccepted = ['_token', 'avatar_current', 'password_confirmation', 'task'];
    }

    public function listItems($params = null, $option = null)
    {
        $result = null;
        
        if ($option['task'] == "admin-list-items") {
            $query = self::select('id', 'username', 'email', 'fullname', 'avatar', 'level', 'created', 'created_by', 'modified', 'modified_by', 'status');
            
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

        if($option['task'] == 'change-level'){
            $level = $params['currentLevel'];
            $params['modified_by'] = 'TuanDA';
            self::where('id', $params['id'])->update(['level' => $level]);
        } 
        
        if($option['task'] == 'add-item') {
            $params['created'] = date("Y-m-d");
            $params['created_by'] = 'TuanDA';
            $params['avatar'] = $this->uploadThumb($params['avatar']); // upload new Image
            $params['password'] = md5($params['password']);
            
            $params = array_diff_key($params, array_flip($this->crudNotAccepted));
            self::insert($this->prepareParams($params));
        }

        if($option['task'] == 'edit-item') {

            // up new image
            if(!empty($params['avatar'])){
                
                $this->deleteThumb($params['avatar_current']); // x??a image from folder
            
                $params['avatar'] = $this->uploadThumb($params['avatar']); // upload new Image
            }

            // kh??ng upload image
            $params['modified'] = date("Y-m-d");
            $params['modified_by'] = 'TuanDA';
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }

        if($option['task'] == 'change-password'){
            $password= md5($params['password']);
            self::where('id', $params['id'])->update(['password' => $password]);
        }

        if($option['task'] == 'change-level-post') {
            $level = $params['level'];
            self::where('id', $params['id'])->update(['level' => $level]);
        }
    }

    public function getItem($params, $option){
        $result = null;
        
        if($option['task'] == 'get-item'){
            $result = self::select('id', 'username', 'email', 'status', 'avatar', 'fullname', 'level')
                            ->where('id', $params['id'])->first();
        }

        if($option['task'] == 'get-thumb'){
            $result = self::select('id', 'thumb')
                            ->where('id', $params['id'])->first();
        }

        if($option['task'] == 'auth-login'){
            $result = self::select('id', 'username', 'email', 'fullname', 'avatar', 'status', 'level')
                            ->where('email', $params['email'])
                            ->where('password', md5($params['password']))
                            ->where('status', 'active')
                            ->first();
            if($result) $result = $result->toArray();
        }
        if($option['task'] == 'check-register'){
            $result = self::select('email')
                            ->where('email', $params['email'])
                            ->first();
            
            if($result) $result = $result->toArray();
        }

        return $result;
    }

    public function delete($params = null, $option = null) {
        if($option['task'] == 'delete-item'){
            $item = $this->getItem($params, ['task'=>'get-thumb']);
            $this->deleteThumb($item['thumb']); // x??a image from folder
            self::where('id', $params['id'])->delete();
        }
    }

    public function register($params = null, $option = null) {
        $params['created'] = date("Y-m-d");
        $params['created_by'] = 'TuanDA';
        $params['password'] = md5($params['password']);
        $params['level'] = 'member';
        $params['status'] = 'inactive';

        $params = array_diff_key($params, array_flip($this->crudNotAccepted));
        self::insert($this->prepareParams($params));
    }
}
