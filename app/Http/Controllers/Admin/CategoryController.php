<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;

class CategoryController extends Controller
{
    private $pathViewController = "admin.pages.category.";
    private $controllerName = "category";
    private $notify = 'status';
    private $params = [];
    private $model;

    public function __construct()
    {
        $this->model = new MainModel(); // khởi tạo đối tượng model
        $this->params['pagination']['totalPerPage'] = 10; // số items trên 1 page
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

    public function isHome(Request $request){
        $params['currentIsHome'] = $request->isHome;
        $params['id'] = $request->id;
        $this->model->saveItem($params,['task' => 'change-is-home']);

        return redirect()->route($this->controllerName)->with($this->notify, 'Is home updated!');// flash keyword
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

    public function save(MainRequest $request){
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
    }

    public function display(Request $request){
        $params['currentDisplay'] = $request->display;
        $params['id'] = $request->id;
        $this->model->saveItem($params,['task' => 'change-display']);

        return redirect()->route($this->controllerName)->with($this->notify, 'Change Displat is updated!');// flash keyword
    }
}
