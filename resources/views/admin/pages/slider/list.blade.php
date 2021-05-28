@php
    use App\Helpers\Template as Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Slider Info</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">New</th>
                    <th class="column-title">Edit</th>
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
                            $description        = $value['description'];
                            $link               = $value['link'];
                            $thumb              = Template::showItemThumb($controllerName, $value['thumb'], $value['name']);
                            $status             = Template::showItemStatus($controllerName, $id, $value['status']); // $controllerName from Controller
                            $createdHistory     = Template::modeHistory($value['created_by'], $value['created']);
                            $modifiedHistory    = Template::modeHistory($value['modified_by'], $value['modified']);
                            $showButton         = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td class="">{{ $key }}</td>
                            <td width="40%">
                                <p><strong>Name: </strong>{{ $name }}</p>
                                <p><strong>Description: </strong>{{ $description }}</p>
                                <p><strong>Link: </strong><a href="{{ $link }}">{{ $link }}</a></p>
                                <p>{!! $thumb !!}</p>
                            </td>
                            <td>{!! $status !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $createdHistory !!}</td>
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