@if ($errors->any())
        <div class="alert alert-danger">
            <h4 class="fa fa-warning">Warning!</h4>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    @endif