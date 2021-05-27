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
        $this->params['pagination']['totalPerPage'] = 1; // pagination
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function index()
    {
        $items = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        return view($this->pathViewController . "index", [
            'items' => $items
        ]);
    }
}
