<?php

namespace App\Http\Controllers\News;

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
        $sliderModel        = new SliderModel();
        $categoryModel      = new CategoryModel();
        $articleModel       = new ArticleModel();

        $itemsSlider        = $sliderModel->listItems(null, ['task' => 'news-list-items']);
        $itemsCategory      = $categoryModel->listItems(null, ['task' => 'news-list-category-is-home']);
        $itemsFeatured      = $articleModel->listItems(null, ['task' => 'news-list-article-featured']);
        $itemsLatest        = $articleModel->listItems(null, ['task' => 'news-list-article-latest']);

        foreach($itemsCategory as $key => $category){
            $itemsCategory[$key]['articles'] = $articleModel->listItems(['category_id' =>$category['id']], ['task' => 'news-list-articles-in-category']);
        }
        
        
        return view($this->pathViewController . "index", [
            'params'            => $this->params,
            'itemsSlider'       => $itemsSlider,
            'itemsCategory'     => $itemsCategory,
            'itemsFeatured'     => $itemsFeatured,
            'itemsLatest'       => $itemsLatest
        ]);
    }
}
