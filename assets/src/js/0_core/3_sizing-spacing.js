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
            window.salemoche.headerHeight = $('.hsl-navigation').height();
            window.salemoche.footerHeight = $('.hsl-footer').height();

            $('main').css('min-height', window.innerHeight - $('.hsl-footer').height() + 90 + 'px');

            $('.hsl-image').each( function () {
                const image = $(this);
                image.css('height', image.width() / 1.5 + 'px');
            })

            $('.hsl-tile-image').each( function () {
                const image = $(this);
                image.css('height', image.width() / 1.5 + 'px');
            })

            $('.hsl-tile-team .hsl-tile-image').each( function () {
                const image = $(this);
                image.css('height', image.width() + 'px');
            })
        }

        window.salemoche.setSizes = setSizes;


    })

})(jQuery)