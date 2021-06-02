@if (count($itemsCategory) > 0)
    @foreach ($itemsCategory as $item)
        @if ($item['display'] == 'list')
            @include('news.pages.home.child_index.category_list')
        @elseif ($item['display'] == 'grid')
            @include('news.pages.home.child_index.category_grid')
        @endif
    @endforeach
@endif



