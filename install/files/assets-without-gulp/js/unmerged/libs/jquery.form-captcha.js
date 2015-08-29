(function($) {
    $.fn.FormCaptcha = function(){

        function refreshCaptcha(captcha_image_path,captcha_image_container) {
            captcha_image_container.css("background-image", 'url(' + captcha_image_path.attr('data-captcha-image-path') + Math.floor(Math.random()*9999999999)+')');
        }

		$("form").each(function() {
            var captcha_image_path = $(this).find('[data-captcha-image-path]');
            var captcha_image_container = $(this).find('#captcha_image');

	        captcha_image_path.click(function(event) {
	            refreshCaptcha(captcha_image_path, captcha_image_container);
	            event.preventDefault();
	        });
        });
    };
})(jQuery);