@php
    use App\Helpers\Template as Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">Display at Home</th>
                    <th class="column-title">Display</th>
                    <th class="column-title">Created</th>
                    <th class="column-title">Modified</th>
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
                            $status             = Template::showItemStatus($controllerName, $id, $value['status']); // $controllerName from Controller
                            $isHome             = Template::showItemIsHome($controllerName, $id, $value['is_home']);
                            $display            = Template::showItemDisplay($controllerName, $id, $value['display'], 'display'); 
                            $createdHistory     = Template::modeHistory($value['created_by'], $value['created']);
                            $modifiedHistory    = Template::modeHistory($value['modified_by'], $value['modified']);
                            $showButton         = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td class="">{{ $key }}</td>
                            <td width="40%">
                                <p><strong>Name: </strong>{{ $name }}</p>
                            </td>
                            <td>{!! $status !!}</td>
                            <td>{!! $isHome !!}</td>
                            <td>{!! $display !!}</td>
                            <td>{!! $createdHistory !!}</td>
                            <td>{!! $modifiedHistory !!}</td>
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