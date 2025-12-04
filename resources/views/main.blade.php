<!doctype html>
<html @lang('en')>
<head>
  @include('partials/_head')
  @include('partials/_css')
</head>

<body>
    @include('partials/_nav')

    @yield('content')

    @include('partials/_footer')
    @include('partials/_script')

@yield('script')
  </body>
</html>