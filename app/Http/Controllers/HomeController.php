<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $pathViewController = "news.pages.home.";
    private $controllerName = "home";
    private $notify = 'status';
    private $params = [];
    private $model;

    public function __construct()
    {
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function index(Request $request)
    {
        echo 'dsa';
        // return view($this->pathViewController . "index", [
        //     'params'            => $this->params
        // ]);
    }
}
