<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;

class ArticleController extends Controller
{
    private $pathViewController = "news.pages.article.";
    private $controllerName = "article";
    private $params = [];

    public function __construct()
    {
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function index(Request $request)
    {
        $params['article_id']   = $request->article_id;
        $articleModel           = new ArticleModel();
        
        $itemsArticle           = $articleModel->getItem($params, ['task' => 'news-get-item']);
        if(empty($itemsArticle)) return redirect()->route('home');
        
        $itemsLatest            = $articleModel->listItems(null, ['task' => 'news-list-article-latest']);
        $params['category_id'] = $itemsArticle['category_id'];

        $itemsArticle['related_article']          = $articleModel->listItems($params, ['task' => 'news-list-article-related']);
       
        
        return view($this->pathViewController . "index", [
            'params'            => $this->params,
            'itemsArticle'      => $itemsArticle,
            'itemsLatest'       => $itemsLatest,
            // 'itemsRelated'      => $itemsRelated
        ]);
    }
}