<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Http\Requests\AuthLoginRequest as MainRequest;

class AuthController extends Controller
{
    private $pathViewController = "news.pages.auth.";
    private $controllerName = "auth";
    private $params = [];

    public function __construct()
    {
        view()->share("controllerName", $this->controllerName); // share controllerName to all of views in SliderClass
    }

    public function login(Request $request)
    {
        return view($this->pathViewController . 'login');
    }

    public function postLogin(MainRequest $request) {
        if($request->method() == 'POST') {
            $params = $request->all();
            $userModel = new UserModel();
            $userInfo = $userModel->getItem($params, ['task' => 'auth-login']);
            if(!$userInfo)
                return redirect()->route($this->controllerName . '/login')->with('news_notify', 'Email or Password is not correctly!');
                
            $request->session()->put('userInfo', $userInfo);
            return redirect()->route('home');
        }
    }

    public function logout(Request $request)
    {
        if($request->session()->has('userInfo')) {
            $request->session()->pull('userInfo');
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

}
