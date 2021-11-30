(($) => {
    $(document).on('ready', () => {

        let scrollDist = $('body').scrollTop();

        //======================
        //	Scrolling Functions
        //======================
        
        $(window).on('scroll', () => {
            scrollDist = $('body').scrollTop();
        });

        $('a[href^="#"').click((e) => {
            e.preventDefault();
            let targetId = e.target.href.split("#")[1];

            scrollTo('#' + targetId);
        })

        function fromBottom() {
            return $('html').height() - window.innerHeight - scrollDist;
        }

        function scrollTo(element) {
            let displacer = window.salemoche.currentBreakpoint == 'small' ? 68 : 144;
            let position = $(`${element}`).position().top;
            $("body").animate({ scrollTop: position - displacer }); 
        }

        function toggleElement(selector, method, distance) {

            if (method == 'top') {
                if (scrollDist > distance) {
                    $(selector).addClass('visible');
                } else {
                    $(selector).removeClass('visible');
                }
            } else if (method == 'bottom') {
                if (fromBottom() < distance) {
                    $(selector).addClass('visible');
                } else {
                    $(selector).removeClass('visible');
                }
            }
        }
        
        function scrollIntoView(element, offset, callback) {

            let windowTop = scrollDist;
            let windowBottom = windowTop + window.innerHeight;
            let scrolledPastDist = windowBottom - offset - element.position().top;
            let scrolledPastPercent = scrolledPastDist / element.height() * 100;
            // console.log(scrolledPastDist, element.height())

            if (windowBottom - offset  >= element.position().top && windowTop + offset  <= element.position().top + element.height() ) {
                callback(element, scrolledPastDist, scrolledPastPercent );
            }
        }

    })
})( jQuery )