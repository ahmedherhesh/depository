<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-light d-flex justify-content-center">
    <button type="button" class="nav-link modal-btn w-100" data-bs-toggle="modal" data-bs-target="#seacrhModal">
        <img src="{{ asset('imgs/quick_reference_all.svg') }}" alt=""><span>بحث</span>
    </button>
    <span class="menu-btn"><img src="{{ asset('imgs/menu.svg') }}" alt=""></span>
</nav>

@section('js')
    @parent
    <script>
        let sidebar = $('.sidebar'),
            outlay = $('.outlay');
        $('.menu-btn').on('click', function() {
            if (sidebar.css('right') == '-265px') {
                sidebar.css('right', 0);
                outlay.fadeIn()
            }
        })
        outlay.on('click', function() {
            sidebar.css('right', '-265px')
            outlay.fadeOut()
        })

        $(window).on('resize', function() {
            console.log($(this).width());
            if ($(this).width() > 640) {
                outlay.fadeOut();
                sidebar.css('right', 0);
            } else {
                sidebar.css('right', '-265px');
            }
        })
    </script>
@endsection
