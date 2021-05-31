<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{
    private $pathViewController = "admin.pages.slider.";
    private $controllerName = "slider";
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

        return redirect()->route($this->controllerName)->with('status', 'Status updated!');// flash keyword
    }

    public function delete(Request $request) {
        $params['id'] = $request->id;
        $this->model->delete($params, ['task' => 'delete-item']);

        return redirect()->route($this->controllerName)->with('status', 'Delete Item successfully!');
    }

    public function form(Request $request){
        $item = null;
        // echo $request->id;
        if($request->id !== null) {
            $params['id'] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        

        return view($this->pathViewController . "form", [
            'item' => $item
        ]);
    }

    public function save(Request $request){
        echo __METHOD__;
    }
}
