// page init
jQuery(function(){
    initLocalScroll();
    initlazySizes();
    initModalWindow();
    initFancybox();
    initPreloader();
});

function initModalWindow() {
    if(window.modal_overlay == true){

        // alert dialog
        alertify.set({
            labels: {
                ok     : "Schließen"
            }
        });
        alertify.alert('<div class="alertify_modal_content">'+$('.modal_overlay').html()+'</div>');
    }
}

function initFancybox() {
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
}

function initLocalScroll() {
    $.localScroll({
        hash: true,
        offset: {top:-155, left:0}
    });
}



function initlazySizesAfterEvent() {
    $(document).on('lazybeforeunveil', (function(){
        var onLoad = function(e){
            // var img = $('.carousel .slide img');
            // $('.carousel').height(img.height());
        };

        return function(e){
            if(!e.isDefaultPrevented()){
                $(e.target).filter('img').on('load', onLoad);
            }
        };
    })());

    jQuery(window).on('resize orientationchange blur focus', function(){
        //$('.carousel').height($('.carousel .slide img').height());
    });
}

function initlazySizes() {
    // Must execute set before lazySizes.init();
    initlazySizesAfterEvent();

    // Settings
    window.lazySizesConfig = window.lazySizesConfig || {};
    window.lazySizesConfig.customMedia = {
        '--small': '(max-width: 480px)',
        '--large': '(min-width: 800px)'
    };

    // Load
    lazySizes.init();
}

function initHashNav() {
    if(location.hash != "") {
        setHashItemsToActive('/'+location.hash);
    }

    $('#menu-hauptmenue a').click(function(){
        var href = $(this).attr('href');

        // Execute only if href contains a hash "#"
        if(href.indexOf("#") >= 0){
            setHashItemsToActive(href);
        }
    });

    function setHashItemsToActive(hash){
        $('#menu-hauptmenue li').removeClass('current-menu-item current_page_item active'); //LINE CHANGED
        $('#menu-hauptmenue li:has(a[href="'+hash+'"])').addClass('current-menu-item current_page_item active'); //LINE CHANGED
    }
}

// initialize custom form elements
function initCustomForms() {
    jQuery('input, textarea').placeholder();

	jcf.replaceAll();

    function refreshCaptcha(element,captcha_image_container) {
        console.log(element.attr('data-captcha-image-path'));
        captcha_image_container.find('.captcha_image').css("background-image", 'url(' + element.attr('data-captcha-image-path') + Math.floor(Math.random()*9999999999)+')');
    }


    $("form").each(function() {
        var captcha_image_path = $(this).find('[data-captcha-image-path]');
        var captcha_image_container = $(this).find('.captcha-frame');

        captcha_image_container.find('a').click(function(event) {
            console.log(captcha_image_path);
            console.log(captcha_image_container);
            refreshCaptcha(captcha_image_path, captcha_image_container);
            event.preventDefault();
        });
    });
}

function initPreloader(){
    // Simple preloader
    $(window).load(function(){
        $("#preloader").delay(350).fadeOut(300);
    });
}
