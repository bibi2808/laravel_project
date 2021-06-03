@php
    use App\Helpers\Template as Template;
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
                $linkCategory = '#';
                $linkArticle = '#';
            @endphp
           <!-- Latest Post -->
            <div class="latest_post d-flex flex-row align-items-start justify-content-start">
                <div><div class="latest_post_image"><img src="{{ $thumb }}" alt="{{ $name }}"></div></div>
                <div class="latest_post_content">
                    <div class="post_category_small cat_video"><a href="the-loai/so-hoa-6.html">{{ $categoryName }}</a></div>
                    <div class="latest_post_title"><a href="bai-viet/asus-ra-mat-zenfone-6-voi-camera-lat-tu-dong-23.html">{{ $name }}</a></div>
                    <div class="latest_post_date">{{ $created }}</div>
                </div>
            </div>
        @endforeach        
    </div>
</div>