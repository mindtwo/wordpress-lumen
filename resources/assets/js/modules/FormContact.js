module.exports = {

    template: document.querySelector('#form-contact-template'),

    data: function(){
        return {
            inquery: {
                name: '',
                email: '',
                phone: '',
                message: '',
                subject: '',
                blog_id: window.GlobalVars.blog_id
            },
            submitted: false,
            errors: false
        };
    },

    methods: {
        onSubmitForm: function(e) {
            e.preventDefault();
            var inquery = this.inquery;
            inquery.all_locations = this.locations;
            this.$http.post('/api/form-contact', inquery).then(
                function(response) {
                    this.errors = false;
                    this.submitted = true;
                    $.fancybox.toggle();
                    if (typeof ga == 'function') {
                        ga('send', 'pageview', '/success/form-contact/');
                    }
                }, function (response) {
                    var _errors = [];
                    $.each(response.data, function(key, value) {
                        _errors.push(value);
                    });
                    this.errors = _errors;
                    $.fancybox.toggle();
                }
            );
        }
    }
};