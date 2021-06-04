<div class="world">
    <div class="row world_row">
        <div class="col-lg-11">
            <div class="row">
                @foreach ($item['articles'] as $article)
                    <div class="col-lg-6">
                        <div class="post_item post_v_small d-flex flex-column align-items-start justify-content-start">
                            @include('news.patials.article.image', ['item' => $article])
                            @include('news.patials.article.content', ['item' => $article, 'lengthContent' => 200,
                            'showCategory' => false])
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="home_button mx-auto text-center"><a href="the-loai/giao-duc-2.html">Xem
                        thêm</a></div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach ($item['articles'] as $article)
            <div class="col-lg-6">
                <div class="post_item post_v_med d-flex flex-column align-items-start justify-content">
                    @include('news.patials.article.image', ['item' => $article])
                    @include('news.patials.article.content', ['item' => $article, 'lengthContent' =>])
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div> --}}