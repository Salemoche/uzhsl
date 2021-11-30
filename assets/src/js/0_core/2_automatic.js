import { smDevice, smSetCookie, smGetCookie } from '../../../../../../plugins/salemoche-wordpress-essentials/assets/src/js/helpers';

window.salemoche.device = smDevice;

// window.salemoche.colors = {
//     main: [
//         '#62B9ED', // '#424C66',
//         '#E94545', // '#4382FF',
//         '#E94545', // '#4F98F8',
//         '#62B9ED', // '#62B9ED',
//         '#D39F41', // '#6ECFE6',
//         '#D39F41', // '#74DAE2',
//         '#F1F7FC' // '#F1F7FC'
//     ],
//     gray: [
//         '#B5B5B5',
//         '#C4C4C4',
//         '#efefef'
//     ],
//     black: [
//         '#333333'
//     ]
// };

(function($) {
 
    window.addEventListener("load", function() {
        $('.uzhsl-loading').removeClass('visible');
    });

    $(document).on('ready', () => {

        //======================
        // Call Functions
        //======================

        setTimeout(() => {
            calculateBreakpoint();
            setColors();
        }, 0);

        $(window).on('resize', function () {
            calculateBreakpoint();
        })
        

        //======================
        // Body Classes
        //======================

        $('body').addClass(`body-${smDevice.client.name}`);

        //======================
        // Cookies
        //======================

        // if (smGetCookie('visited') != 'true') {
        //     smSetCookie('visited', 'true', 0.1);
        //     console.log('has not yet visited')
        //     showLanding();
        // } else {
        //     console.log('has visited')
        // }

        //======================
        // Title
        //======================
        
        function calculateBreakpoint() {
            if (window.innerWidth >= window.salemoche.breakpoints.large) {
                window.salemoche.currentBreakpoint = 'xlarge';
            } else if (window.innerWidth <= window.salemoche.breakpoints.large) {
                window.salemoche.currentBreakpoint = 'large';
            } else if (window.innerWidth <= window.salemoche.breakpoints.medium) {
                window.salemoche.currentBreakpoint = 'medium';
            } else if (window.innerWidth <= window.salemoche.breakpoints.small) {
                window.salemoche.currentBreakpoint = 'small';
            } else {
                window.salemoche.currentBreakpoint = 'small';
            }
        }

        //======================
        // Colors
        //======================

        function setColors() {
            $('.uzhsl-image, .uzhsl-slide-image, .uzhsl-tile, .section__meta-box').each( function () {
                const that = $(this);
                const colorIndex = Math.round(Math.random() * 5);
                that.css( 'color', window.salemoche.colors[`color${colorIndex}`])
            })
        }

        
        /**========================
        *	underline menu item
        *========================*/
        const href = window.location.href;
        let activeMenuId;
        // console.log(href);

        switch (true) {
            case href.includes('/teachings/'):
                activeMenuId = 98;
                break;
            case href.includes('/project/'):
                activeMenuId = 96;
                break;
            case href.includes('/team/'):
                activeMenuId = 95;
                break;
            case $('body').hasClass('single-post'):
                activeMenuId = 106;
                break;
            default:
                break;
        }

        $(`#menu-item-${ activeMenuId }`).addClass('menu-item--current');

    })

})(jQuery)