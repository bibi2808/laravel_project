@if (session('news_notify'))
    <div class="alert alert-danger">
        {{ session('news_notify') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
    </div>
@endif