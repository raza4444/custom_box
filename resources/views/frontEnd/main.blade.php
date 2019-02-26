@include('frontEnd.include.head')
@include('frontEnd.include.header')
<body>
<div class="body-wrapper" id="app">
@yield('content')
</div>
</body>

@include('frontEnd.include.footer')
@include('frontEnd.include.foot')
@yield('scripts')
</html>