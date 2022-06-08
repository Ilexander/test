
@if($orientation == 'rtl')
    @if(explode('.',request()->route()->getName())[0] === 'auth')
        <link rel="stylesheet" href="{{asset('admin/sass/main-rtl.min.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('admin/css/style-rtl.min.css')}}">
    @endif
@else
    @if(explode('.',request()->route()->getName())[0] === 'auth')
        <link rel="stylesheet" href="{{asset('admin/sass/main.min.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('admin/css/style.min.css')}}">
    @endif
@endif
<input type="hidden" id="current_orientation" value="{{$orientation}}">
