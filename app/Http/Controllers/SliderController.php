<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    private $pathViewController = "admin.slider.";
    private $controllerName = "slider";

    public function __construct()
    {
        view()->share("controllerName", $this->controllerName);
    }

    public function index()
    {
        return view($this->pathViewController . "index", []);
    }
}
