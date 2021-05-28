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
}
