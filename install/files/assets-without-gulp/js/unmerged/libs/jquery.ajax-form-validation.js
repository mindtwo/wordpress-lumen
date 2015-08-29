(function($) {
    $.fn.AjaxFormValidation = function(){
        // this is the id of the form
        $("form[data-ajax='true']").each(function() {
            var form_element = $(this);
            var form_submit_btn = $(this).find("input[type='submit']");
            var captcha_image_path = $(this).find('[data-captcha-image-path]');
            var captcha_image_container = $(this).find('#captcha_image');

            var $hiddenInput = $('<input/>',{type:'hidden',value:'true',name:'ajax'});
            $hiddenInput.appendTo(form_element);

            function doFormAjaxCall(form_element, captcha_image_path, captcha_image_container) {
                form_element.find(".error").removeClass('error');
                $.ajax({
                    type: "POST",
                    url: document.URL,
                    data: form_element.serialize(),
                    success: function(data){
                        try {
                            var json_data = JSON.parse(data);
                            if(json_data.hasOwnProperty("status")) {

                                if(json_data.status == "success"){
                                    setErrosOutput(form_element,false);
                                    form_element.before((json_data.hasOwnProperty("message")) ? json_data.message : '').remove();
                                    clearForm();

                                } else if(json_data.status == "errors"){
                                    setErrosOutput(form_element, getErrorMessages(json_data.errors));

                                    if(json_data.errors.hasOwnProperty("form_captcha_code")) {
                                        refreshCaptcha(captcha_image_path, captcha_image_container);
                                    }
                                }
                            }
                        } catch (e) {
                            return false;
                        }
                    }
                });
            }

            function clearForm(){
                $.ajax({
                    type: "POST",
                    url: document.URL,
                    data: {'ajax':'clear'}
                });
            }

            function getErrorMessages(data){
                var output = "";
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        output += data[key];
                        form_element.find('input[name="'+key+'"]').addClass('error');
                    }
                }
                return output;
            }

            function setErrosOutput(form_element, output) {
                if(output!==false) {
                    if(form_element.prev().hasClass('errors')){
                        form_element.prev().html(output);
                    } else {
                        form_element.before('<ul class="errors">'+output+'</ul>');
                    }
                } else {
                    if(form_element.prev().hasClass('errors')){
                        form_element.prev().remove();
                    }
                }
            }

            function refreshCaptcha(element,captcha_image_container) {
                captcha_image_container.css("background-image", 'url(' + element.attr('data-captcha-image-path') + Math.floor(Math.random()*9999999999)+')');
            }


            $(this).submit(function(event) {
                doFormAjaxCall(form_element, captcha_image_path, captcha_image_container);
                event.preventDefault();
            });

            captcha_image_path.click(function(event) {
                refreshCaptcha(captcha_image_path, captcha_image_container);
                event.preventDefault();
            });

            form_submit_btn.click(function(event) {

                $(this).submit();
                event.preventDefault();
            });
        });
    };
})(jQuery);