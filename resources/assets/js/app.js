var Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = $('#csrf_token').attr('content');

new Vue({
    el: '#app',

    components: {
        'form-contact': require('./modules/FormContact.js')
    }
});


/**
 * App load
 */
jQuery(function(){
    initLocalScroll();
    initlazySizes();
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