<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;
use App\Models\CategoryModel;

class CategoryController extends Controller
{
    private $pathViewController = "news.pages.category.";
    private $controllerName = "category";
    private $params = [];

    public function __construct()
    {
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function index(Request $request)
    {
        $params['category_id'] = $request->category_id;

        $articleModel       = new ArticleModel();
        $categoryModel      = new CategoryModel();

        
        $itemsCategory        = $categoryModel->getItem($params, ['task' => 'news-get-item']);
        if(empty($itemsCategory)) 
            return redirect()->route('home');

        $itemsLatest        = $articleModel->listItems(null, ['task' => 'news-list-article-latest']);
        $itemsCategory['articles'] = $articleModel->listItems(['category_id' =>$itemsCategory['id']], ['task' => 'news-list-articles-in-category']);
      
        return view($this->pathViewController . "index", [
            'params'            => $this->params,
            'itemsLatest'       => $itemsLatest,
            'itemsCategory'     => $itemsCategory
        ]);
    }
}
