<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel as MainModel;
use App\Http\Requests\UserRequest as MainRequest;

class UserController extends Controller
{
    private $pathViewController = "admin.pages.user.";
    private $controllerName = "user";
    private $notify = 'status';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel(); // khởi tạo đối tượng model
        $this->params['pagination']['totalPerPage'] = 5; // số items trên 1 page
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function index(Request $request)
    {
        
        // echo($request->input('filter_status', 'all')); // get params from URL
        
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field'] = $request->input('search_field', '');
        $this->params['search']['value'] = $request->input('search_value', '');
        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $itemsStatusCount = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);

        return view($this->pathViewController . "index", [
            'params'            => $this->params,
            'items'             => $items,
            'itemsStatusCount'  => $itemsStatusCount
        ]);
    }

    public function status(Request $request){
        $params['currentStatus'] = $request->status;
        $params['id'] = $request->id;
        $this->model->saveItem($params,['task' => 'change-status']);

        return redirect()->route($this->controllerName)->with($this->notify, 'Status updated!');// flash keyword
    }

    public function level(Request $request){
        
        $params['currentLevel'] = $request->level;
        $params['id'] = $request->id;
        
        $this->model->saveItem($params,['task' => 'change-level']);

        return redirect()->route($this->controllerName)->with($this->notify, 'Level updated!');// flash keyword
    }

    public function delete(Request $request) {
        $params['id'] = $request->id;
        $this->model->delete($params, ['task' => 'delete-item']);

        return redirect()->route($this->controllerName)->with($this->notify, 'Delete Item successfully!');
    }

    public function form(Request $request){
        $item = null;
        if($request->id !== null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        
        return view($this->pathViewController . "form", [
            'item' => $item
        ]);
    }

    public function changePassword(MainRequest $request){
        if($request->method() == 'POST') {
            
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with($this->notify, 'Change password successfully !');
        }
    }

    public function changeLevel(MainRequest $request){
        if($request->method() == 'POST') {
            
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-level-post']);
            return redirect()->route($this->controllerName)->with($this->notify, 'Change level successfully !');
        }
    }

    public function save(MainRequest $request){
        // MainRequest là RequestFile => file validation
        if($request->method() == 'POST'){
            $params = $request->all();

            $task = 'add-item';
            $notify = 'Added';

            if($params['id'] !== null) {
                $task = 'edit-item';
                $notify = 'Updated!';
            }

            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with($this->notify, $notify);
        }

        echo __METHOD__;
    }
}
