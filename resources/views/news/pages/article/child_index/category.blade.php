@if ($item['display'] == 'list')
    @include('news.pages.category.child_index.category_list')
@elseif ($item['display'] == 'grid')
    @include('news.pages.category.child_index.category_grid')
@endif