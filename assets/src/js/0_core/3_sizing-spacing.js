(function($) {


    $(document).on('ready', () => {

        //======================
        //	Call Functions
        //======================

        setTimeout(() => {
            setSizes();
        }, 0);

        $(window).on('resize', function () {
            setSizes();
        })
        

        //======================
        //	Sizes
        //======================

        function setSizes () {
            window.salemoche.headerHeight = $('.uzhsl-navigation').height();
            window.salemoche.footerHeight = $('.uzhsl-footer').height();

            $('main').css('min-height', window.innerHeight - $('.uzhsl-footer').height() + 90 + 'px');

            $('.uzhsl-image').each( function () {
                const image = $(this);
                image.css('height', image.width() / 1.5 + 'px');
            })

            $('.uzhsl-tile-image').each( function () {
                const image = $(this);
                image.css('height', image.width() / 1.5 + 'px');
            })

            $('.uzhsl-tile-team .uzhsl-tile-image').each( function () {
                const image = $(this);
                image.css('height', image.width() + 'px');
            })
        }

        window.salemoche.setSizes = setSizes;


    })

})(jQuery)