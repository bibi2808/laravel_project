@php
use App\Models\CategoryModel as CategoryModel;
use App\Helpers\URL;

$categoryModel = new CategoryModel();
$itemsCategory = $categoryModel->listItems(null,['task' => 'news-list-items']);
$xhtmlMenu = '';
$xhtmlMenuMobile = '';

    if(count($itemsCategory) > 0){

        $xhtmlMenu = '<nav class="main_nav"><ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">';
        $xhtmlMenuMobile = '<nav class="menu_nav"><ul class="menu_mm">';
        $currentIDCategory = Route::input('category_id');

            foreach($itemsCategory as $item){

                $link = URL::linkCategory($item['id'], $item['name']);
                $classActive = ($currentIDCategory == $item['id']) ? 'class="active"' : '';

                $xhtmlMenu.= sprintf('<li %s><a href="%s">%s</a></li>', $classActive, $link, $item['name']);
                $xhtmlMenuMobile .= sprintf('<li class="menu_mm"><a href="%s">%s</a></li>', $link, $item['name']);
            }
            if(session('userInfo')){
                $xhtmlAuth = sprintf('<li><a href="%s">%s</a></li>',route('user'), session('userInfo')['username']);
                if(session('userInfo')['level'] == 'admin'){
                    $xhtmlAuth .= sprintf('<li><a href="%s">%s</a></li>',route('user'), 'Admin');
                }
                $xhtmlAuth .= sprintf('<li><a href="%s">%s</a></li>',route('auth/logout'), 'Logout');
            }else {
                $xhtmlAuth = sprintf('<li><a href="%s">%s</a></li><li><a href="%s">%s</a></li>', route('auth/login'), 'Login', route('auth/register'), 'Register');
                
            }
            
        
        $xhtmlMenu .= $xhtmlAuth . '</ul></nav>';
        $xhtmlMenuMobile .= $xhtmlAuth . '</ul></nav>';
    }

@endphp

<!-- Header -->
<header class="header">
    <!-- Header Content -->
    <div class="header_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justfy-content-start">
                        <div class="logo_container">
                            <a href="{{ route('home') }}">
                                <div class="logo"><span>GEN</span>Z</div>
                            </a>
                        </div>
                        <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
                            <a href="#">
                                <div class="background_image"
                                    style="background-image:url({{ asset('news/images/zendvn-online.png') }});background-size: contain">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Navigation & Search -->
    <div class="header_nav_container" id="header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_nav_content d-flex flex-row align-items-center justify-content-start">

                        <!-- Logo -->
                        <div class="logo_container">
                            <a href="#">
                                <div class="logo"><span>Breaking The</span>Habit</div>
                            </a>
                        </div>
                   
                        {!! $xhtmlMenu !!}

                        <!-- Hamburger -->
                        <div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm"
                                aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menu -->
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container">
        <div class="menu_close">
            <div></div>
            <div></div>
        </div>
    </div>
    {!! $xhtmlMenuMobile !!}
    <div class="menu_subscribe"><a href="#">Subscribe</a></div>
    <div class="menu_extra">
        <div class="menu_social">
            <ul>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>