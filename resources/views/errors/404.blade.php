@if(strpos($_SERVER['REQUEST_URI'],'admin'))
    @include('admin.errors.404');
@else
    @include('workwise.errors.404');
@endif