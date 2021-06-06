@php
    use App\Helpers\URL;
    $name = $item['name'];
    $created = $item['created'];
    $content = $item['content'];
    $thumb = asset('news/images/article') . '/' . $item['thumb'];
    $category_name = $item['category_name'];
    $linkCategory = URL::linkCategory($item['category_id'], $item['category_name']);
    $linkArticle = URL::linkArticle($item['id'], $item['name']);
@endphp


    <div class="post_image"><img src="{{ $thumb }}" alt="{{ $thumb }}" class="img-fluid w-100"></div>
    <div class="post_content">
        <div class="post_category cat_technology ">
            <a href="{{ $linkCategory }}">{{ $category_name }}</a>
        </div>
        <div class="post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
        <div class="post_info d-flex flex-row align-items-center justify-content-start">
            <div class="post_author d-flex flex-row align-items-center justify-content-start">
                <div class="post_author_name"><a href="{{ $linkArticle }}#">
                    TuanDA</a></div>
            </div>
            <div class="post_date"><a href="{{ $linkArticle }}#">{{ $created }}</a>
            </div>
        </div>
        <div class="post_text">
            <p>{!! $content !!}</p>
        </div>
    </div>