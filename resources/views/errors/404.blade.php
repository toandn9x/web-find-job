@if(strpos($_SERVER['REQUEST_URI'],'admin'))
    404
@else
    @include('workwise.errors.404');
@endif