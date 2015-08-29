$(function () {
    /**
     * RoyalSlider
     */
    if ($('.royalSlider').length) {
        $('.royalSlider').royalSlider({
            slidesSpacing: 0,
            keyboardNavEnabled: true,
            arrowsNav: false,
            loop: true,
            loopRewind: true,
            autoHeight: true,
            autoPlay: {
                enabled: true,
                pauseOnHover: true,
                delay: 8000
            },
            transitionType: 'fade'
        });
    }

    /**
     * fancybox
     */
    if (typeof $.fancybox == 'function') {
        $('a[href$="jpg"], a[href$="png"], a[href$="jpeg"], .fancybox').fancybox({
            openEffect: 'elastic',
            closeEffect: 'elastic',
            margin: 40,
            padding: 0,
            helpers : {
                overlay : {
                    css : {
                        'background' : 'rgba(0,0,0,.85)'
                    }
                }
            }
        });
    }

    /**
     * Ajax form validation
     */
    $.fn.FormCaptcha();

    /**
     * Ajax form validation
     */
    $.fn.AjaxFormValidation();

    /**
     * Responsive nav
     */
    $('.responsive_toggle').click(function () {
        $(this).next().toogleClass('open');
        return false;
    });

    /**
     * Responsive handling
     */
    function responsive_handling() {
        var browser_width = $(window).width();

        // set a class if window width is < X
        if ((browser_width) < 768) {
           $('body').addClass('mobile_active');
        } else {
           $('body').removeClass('mobile_active');
           $('.responsive_toggle').next().removeClass('open');
        }
    }
    responsive_handling();
    
    /**
     * Event trigger
     */
    $(window).resize(function () {
        responsive_handling();
    });
});