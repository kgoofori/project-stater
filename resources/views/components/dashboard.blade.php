<x-master>
<body>
<div id="app">

    @include('partials.side-bar')

    <!-- MAIN CONTENT
    ================================================== -->
    <div class="main-content">
    
    @include('partials.top-bar')
    
    {{ $slot }}
    </div>

    @include('partials.utils')

</div>
</body>
</x-master>