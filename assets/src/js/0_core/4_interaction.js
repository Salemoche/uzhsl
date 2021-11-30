(function($) {

    $(document).on('ready', () => {

        //======================
        //	Interaction
        //======================

        // $('a:not([href*="#"])').on('click', function (e) {
        //     unmountSite();
        // });

        // document.querySelector('.uzhsl-tile, a:not([href*="#"])').addEventListener('click', (e) => {
        //     console.log
        // })

        window.salemoche.addEventListeners = addEventListeners

        function addEventListeners () {

            $('.uzhsl-tile, a:not([href*="#"])').on('click', function (e) {
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
    
            $('.uzhsl-tag').on('click', function (e) {
                e.stopPropagation();
                const that = $(this)
                const baseUrl = that.data('href') || '';
                const searchLink = `${baseUrl}/?s=${that.data('name')}`.replaceAll(' ', '+');
    
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
            // $('.uzhsl-loading').addClass('visible');
        }

        $('.uzhsl-navigation__button').on('click', function (e) {
            $('.uzhsl-navigation').toggleClass('active');
        });
    })

})(jQuery)