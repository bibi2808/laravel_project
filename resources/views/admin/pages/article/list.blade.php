@php
    use App\Helpers\Template as Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Article Info</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Category</th>
                    <th class="column-title">Type</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $value)
                        @php
                            $key                = $key + 1;
                            $id                 = $value['id'];
                            $class              = ($key % 2 == 0) ? 'even' : 'odd';
                            $name               = $value['name'];
                            $content            = substr($value['content'], 0, 200);
                            $categoryName       = $value['category_name'];
                            $thumb              = Template::showItemThumb($controllerName, $value['thumb'], $value['name']);
                            $status             = Template::showItemStatus($controllerName, $id, $value['status']); // $controllerName from Controller
                            $type               = Template::showItemDisplay($controllerName, $id, $value['type'], 'type'); 
                            $showButton         = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td class="">{{ $key }}</td>
                            <td width="25%">
                                <p><strong>Name: </strong>{{ $name }}</p>
                                <p><strong>Content: </strong>{!! $content !!}</p>
                            </td>
                            <td width="15%">{!! $thumb !!}</td>
                            <td width="10%">{!! $categoryName !!}</td>
                            <td width="10%">{!! $type !!}</td>
                            <td>{!! $status !!}</td>
                            <td class="last">{!! $showButton !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif

            </tbody>
        </table>
    </div>
</div>