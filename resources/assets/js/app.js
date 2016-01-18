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
    initLocalScroll();
    initFancybox();
    initPreloader();
});


/**
 * Initialization: Fancybox
 */
function initFancybox() {
    $(document).ready(function() {
        $('.fancybox').fancybox();
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


/**
 * Initialization: Simple preloader
 */
function initPreloader(){
    $(window).load(function(){
        $("#preloader").delay(350).fadeOut(300);
    });
}