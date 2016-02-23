var Vue = require('vue');
Vue.use(require('vue-resource'));

new Vue({
    el: '#app',

    components: {
        'form-contact': require('./modules/FormContact.js'),
        'form-callback': require('./modules/FormCallback.js'),
        'form-application': require('./modules/FormApplication.js')
    }
});


/**
 * App load
 */
jQuery(function(){
    $(document).ready(function() {
        $('a[href="#"]').unbind('click').click(function(e) {
            e.preventDefault();
        });
        initLocalScroll();
        initFancybox();
    });
});


/**
 * Initialization: Fancybox
 */
function initFancybox() {
    $('a[href*="#form__contact"], a[href*="#form__application"]').attr('title','').unbind('click').on({
        click: function(e) {
            e.preventDefault();
            var $element = $(this);

            $.fancybox(
                $element,
                {
                    wrapCSS: 'fancybox-form',
                    openSpeed: 400,
                    openMethod: 'changeIn',
                    closeMethod: 'zoomOut',
                    openEasing: 'swing',
                    closeEasing: 'swing',
                    openEffect: 'fade',
                    closeEffect: 'fade',
                    maxWidth: 800,
                    padding: [0,0,0,0],
                    autoSize: true,
                    helpers: {
                        overlay: {
                            locked: true,
                            showEarly: false,
                            speedIn: 500,
                            speedOut: 500
                        }
                    },
                    scrolling: 'auto',
                    scrollOutside: true
                }
            );
        }
    });

    $(".iframe-content").attr('title','').on({
        click: function(e) {
            e.preventDefault();
            var $element = $(this);

            $.fancybox(
                $element,
                {
                    wrapCSS: 'fancybox-form',
                    type: 'ajax',
                    ajax: {
                        dataType: 'html',
                        headers: {'X-Content-Only': true}
                    },
                    maxWidth: 800,
                    maxHeight: 1000,
                    padding: [0,0,0,0],
                    fitToView: false,
                    width: '95%',
                    height: '90%',
                    autoSize: false,
                    closeClick: false,
                    openMethod: 'changeIn',
                    closeMethod: 'zoomOut',
                    openEasing: 'swing',
                    closeEasing: 'swing',
                    openEffect: 'fade',
                    closeEffect: 'fade',
                }
            );
        }
    });

    $(".fancybox").fancybox({
        wrapCSS: 'fancybox-media',
        maxWidth	: 1200,
        maxHeight	: 800,
        fitToView	: false,
        width		: '70%',
        height		: '70%',
        autoSize	: false,
        closeClick	: false,
        openMethod: 'changeIn',
        closeMethod: 'zoomOut',
        openEasing: 'swing',
        closeEasing: 'swing',
        openEffect: 'fade',
        closeEffect: 'fade',
    });
}


/**
 * Initialization: Local scroll
 */
function initLocalScroll() {
    $.localScroll({
        hash: true,
        offset: {top:-155, left:0}
    });
}