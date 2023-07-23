@if(strpos($_SERVER['REQUEST_URI'],'admin'))
    403
@else
    @include('workwise.errors.403');
@endif