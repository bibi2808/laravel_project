@php
    use App\Helpers\Template as Template;
    use App\Helpers\URL;
@endphp

<div class="sidebar_latest">
    <div class="sidebar_title">Hot news</div>
    <div class="latest_posts">
        @foreach ($items as $item)
            @php
                $name = $item['name'];
                $categoryName = $item['category_name'];
                $thumb = asset('news/images/article') . '/' . $item['thumb'];
                $created = Template::showDateTimeFrontEnd($item['created']);
                $linkCategory = URL::linkCategory($item['category_id'], $categoryName);
                $linkArticle = URL::linkArticle($item['id'], $name);;
            @endphp
           <!-- Latest Post -->
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div><div class="latest_post_image"><img src="{{ $thumb }}" alt="{{ $name }}"></div></div>
                <div class="latest_post_content">
                    <div class="post_category_small cat_video"><a href="{{ $linkCategory }}">{{ $categoryName }}</a></div>
                    <div class="latest_post_title"><a href="{{ $linkArticle }}">{{ $name }}</a></div>
                    <div class="latest_post_date">{{ $created }}</div>
                </div>
            </div>
        @endforeach        
    </div>
</div>