<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\CategoryModel;

class HomeController extends Controller
{
    private $pathViewController = "news.pages.home.";
    private $controllerName = "home";
    private $params = [];

    public function __construct()
    {
        
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function index(Request $request)
    {
        $sliderModel = new SliderModel();
        $itemsSlider = $sliderModel->listItems(null, ['task' => 'news-list-items']);

        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-category-is-home']);

        return view($this->pathViewController . "index", [
            'params'            => $this->params,
            'itemsSlider'       => $itemsSlider,
            'itemsCategory'     => $itemsCategory
        ]);
    }
}
