(function($) {

    $(document).on('ready', () => {

        //======================
        //	Interaction
        //======================

        // $('a:not([href*="#"])').on('click', function (e) {
        //     unmountSite();
        // });

        // document.querySelector('.hsl-tile, a:not([href*="#"])').addEventListener('click', (e) => {
        //     console.log
        // })

        window.salemoche.addEventListeners = addEventListeners

        function addEventListeners () {

            $('.hsl-tile, a:not([href*="#"])').on('click', function (e) {
                // if ( e.target. )
    
                const href = $(this).data('href') || $(this).attr('href');
                if (!href) return
    
                if (e.ctrlKey || e.metaKey ) {
                    window.open( href, "_blank")
                } else {
                    unmountSite();
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300);
                }
            });
    
            $('.hsl-tag').on('click', function (e) {
                e.stopPropagation();
                const that = $(this)
                const searchLink = `/?s=${that.data('href')}`.replace(' ', '+');
    
                if (e.ctrlKey || e.metaKey ) {
                    window.open( searchLink, "_blank")
                } else {
                    unmountSite();
                    setTimeout(() => {
                        window.location.href = searchLink;
                    }, 300);
                }
            });
        }

        addEventListeners();


        // $('a:not([href*="#"])').on('click', function (e) {
        //     e.stopPropagation();
        //     const that = $(this)
        //     const href = that.data('href');
        //     console.log('routing a:not');

        //     if (e.ctrlKey || e.metaKey ) {
        //         window.open( href, "_blank")
        //     } else {
        //         unmountSite();
        //         setTimeout(() => {
        //             window.location.href = href;
        //         }, 300);
        //     }
        // });

        function unmountSite() {
            $('html').css('opacity', '0');
            // $('.hsl-loading').addClass('visible');
        }

        $('.hsl-navigation__button').on('click', function (e) {
            $('.hsl-navigation').toggleClass('active');
        });
    })

})(jQuery)