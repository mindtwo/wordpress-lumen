module.exports = {

    template: document.querySelector('#form-callback-template'),

    data: function(){
        return {
            inquery: { name: '', phone: '' },
            submitted: false,
            errors: false
        };
    },

    methods: {
        onSubmitForm: function(e) {
            e.preventDefault();
            var inquery = this.inquery;
            inquery.all_locations = this.locations;
            this.$http.post('/api/form-callback', inquery).then(
                function(response) {
                    this.errors = false;
                    this.submitted = true;
                    $.fancybox.toggle();
                    if (typeof ga == 'function') {
                        ga('send', 'pageview', '/success/form-callback/');
                    }
                }, function (response) {
                    this.errors = response.data;
                    $.fancybox.toggle();
                }
            );
        }
    }
};