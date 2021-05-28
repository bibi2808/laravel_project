@php
    $totalItems = $items->total();
    $totalPages = $items->lastPage();
    $totalItemsPerPage = $items->perPage();
@endphp
<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <p class="m-b-0">
                <span class="label label-info label-pagination">{{ $items->perPage() }} items perPage</span>
                <span class="label label-success label-pagination">{{ $items->total() }} items</span>
                <span class="label label-danger label-pagination">{{ $items->lastPage() }} pages</span>
            </p>
        </div>
        <div class="col-md-12">
            {{ $items->links('pagination.pagination_admin') }}
            {{--  ['paginator' => $items]) nếu muốn đặt tên khác [paginator] thì truyền thêm params , ko truyền thì mặc định là paginator  --}}
        </div>
    </div>
</div>