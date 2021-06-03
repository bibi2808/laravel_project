<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use App\Models\CategoryModel;
use App\Models\ArticleModel;

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

        $articleModel = new ArticleModel();
        $itemsFeatured = $articleModel->listItems(null, ['task' => 'news-list-article-featured']);
        $itemsLatest = $articleModel->listItems(null, ['task' => 'news-list-article-latest']);

        
        return view($this->pathViewController . "index", [
            'params'            => $this->params,
            'itemsSlider'       => $itemsSlider,
            'itemsCategory'     => $itemsCategory,
            'itemsFeatured'     => $itemsFeatured,
            'itemsLatest'       => $itemsLatest
        ]);
    }
}
