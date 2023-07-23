@if(strpos($_SERVER['REQUEST_URI'],'admin'))
    401
@else
    @include('workwise.errors.401');
@endif