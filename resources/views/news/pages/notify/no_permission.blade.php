@extends('news.main')
@section('content')

<div class="section-category">
    {{--  @include('news.block.breadcrumb_article', ['item' => $itemsArticle])  --}}
    <div class="content_container container_category">
        <div class="featured_title">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-9">
                        <div class="single_post">
                            
                            <h3>Have no permission !</h3>
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <div class="sidebar">
                            <!-- Latest Posts -->
                                @include('news.block.latest_posts',['items' => $itemsLatest])

                                <!-- Advertisement -->
                                @include('news.block.advertisement',['itemsAdvertisement' => [] ])

                                <!-- Most Viewed -->
                                @include('news.block.most_viewed',['itemsMostViewed' => [] ])

                                <!-- Tags -->
                                @include('news.block.tags',['itemsTags' => [] ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection