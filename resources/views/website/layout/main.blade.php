{{-- partials header --}}
@include('website.partials.header')
{{-- .end partials header --}}
    <body>
        {{-- partials navbar --}}
        @include('website.partials.navbar')
        {{-- .end partials navbar --}}

        {{-- CONTENT --}}
            @yield('content')
        {{-- END CONTENT --}}

        {{-- partials footer --}}
        @include('website.partials.footer')
        {{-- .end partials footer --}}

        {{-- partials js --}}
        @include('website.partials.js')
        {{-- .end partials js --}}
    </body>
</html>
