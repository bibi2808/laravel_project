@php
    use App\Helpers\Template as Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Username</th>
                    <th class="column-title">Email</th>
                    <th class="column-title">Fullname</th>
                    <th class="column-title">Level</th>
                    <th class="column-title">Avatar</th>
                    <th class="column-title">Status</th>
                    <th class="column-title">Created</th>
                    <th class="column-title">Modified</th>
                    <th class="column-title">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $value)
                        @php
                            $index              = $key + 1;
                            $id                 = $value['id'];
                            $class              = ($key % 2 == 0) ? 'even' : 'odd';
                            $username           = $value['username'];
                            $email              = $value['email'];
                            $fullname           = $value['fullname'];
                            $avatar             = Template::showItemThumb($controllerName, $value['avatar'], $value['username']);
                            $status             = Template::showItemStatus($controllerName, $id, $value['status']); // $controllerName from Controller
                            $level              = Template::showItemDisplay($controllerName, $id, $value['level'], 'level'); 
                            $createdHistory     = Template::modeHistory($value['created_by'], $value['created']);
                            $modifiedHistory    = Template::modeHistory($value['modified_by'], $value['modified']);
                            $showButton         = Template::showButtonAction($controllerName, $id);
                            
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td class="">{{ $index }}</td>
                            <td width="10%">{{ $username }}</td>
                            <td width="10%">{{ $email }}</td>
                            <td width="10%">{{ $fullname }}</td>
                            <td width="20%">{!! $level !!}</td>
                            <td width="5%">{!! $avatar !!}</td>
                            <td>{!! $status !!}</td>
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