<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleModel;

class NotifyController extends Controller
{
    private $pathViewController = "news.pages.notify.";
    private $controllerName = "auth";
    private $params = [];

    public function __construct()
    {
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function noPermission(Request $request)
    {
        $params['article_id']   = $request->article_id;
        $articleModel           = new ArticleModel();
        
        $itemsLatest            = $articleModel->listItems(null, ['task' => 'news-list-article-latest']);

       
        // echo '<pre>';
        // print_r($itemsLatest);
        // echo '<pre/>';
        // die();
        return view($this->pathViewController . "no_permission", [
            'params'            => $this->params,
            'itemsLatest'       => $itemsLatest
        ]);
    }
}
