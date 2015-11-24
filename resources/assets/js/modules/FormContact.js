module.exports = {

    template: document.querySelector('#form-contact-template'),

    data: function(){
        return {
            inquery: { name: '', email: '', message: '' },
            submitted: false,
            errors: false
        };
    },

    methods: {
        onSubmitForm: function(e) {
            e.preventDefault();
            var _inquery = this.inquery;
            this.$http.post('/', _inquery).success(function(data, status, request) {
                this.errors = false;
                this.submitted = true;
            }).error(function (data, status, request) {
                var _errors = [];
                $.each(JSON.parse(request.response), function(key, value) {
                    _errors.push(value);
                });
                this.errors = _errors;
            });
        }
    }
};