@foreach ($item['related_article'] as $article)
    <div class="posts">
        <div class="post_item post_h_large">
            <div class="row">
                <div class="col-lg-5">
                    @include('news.patials.article.image', ['item' => $article])
                </div>
                <div class="col-lg-7">
                    @include('news.patials.article.content', ['item' => $article, 'lengthContent' => 200, 'showCategory' => false])
                </div>
            </div>
        </div>
    </div>
@endforeach