{{-- HEADER --}}
@include('partials.header')
{{-- END HEADER --}}
<body class="vertical light">
    <div class="wrapper">
        {{-- TOPBAR --}}
        @include('partials.topbar')
        {{-- END TOPBAR --}}
        {{-- SIDEBAR --}}
        @include('partials.sidebar')
        {{-- END SIDEBAR --}}
        <main role="main" class="main-content">
            {{-- CONTENT --}}
            @yield('content')
            {{-- END CONTENT --}}
        </main> <!-- main -->
    </div> <!-- .wrapper -->
{{-- FOOTER --}}
@include('partials.footer')
{{-- END FOOTER --}}
</body>
</html>



