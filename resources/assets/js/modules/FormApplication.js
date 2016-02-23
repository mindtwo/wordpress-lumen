module.exports = {

    template: document.querySelector('#form-application-template'),

    data: function(){
        return {
            inquery: {
                title: '',
                name: '',
                surname: '',
                birth_date: '',
                birth_location: '',
                street: '',
                zip: '',
                city: '',
                email: '',
                phone: '',
                message: '',
                privacy: false,
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
            this.$http.post('/api/form-application', inquery).then(
                function(response) {
                    this.errors = false;
                    this.submitted = true;
                    $.fancybox.toggle();
                    if (typeof ga == 'function') {
                        ga('send', 'pageview', '/success/form-application/');
                    }
                }, function (response) {
                    this.errors = response.data;
                    $.fancybox.toggle();
                }
            );
        }
    }
};