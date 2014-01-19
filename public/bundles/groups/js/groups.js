var ContactFormWidget = {
    settings: {
        errors: [],
        lst_groups: $('#lst-groups'),
        /*
        form: $('#frm-contact'),
        submitButton: $('#btn-submit'),
        container: $('#cntr-contact-form'),
        */
    },

    init: function() {
        obj = this.settings;
        if (obj.lst_groups.length) {
            this.bindListClicks();
        }
        this.bindUIActions();
    },

    bindListClicks: function() {
        obj = this.settings;

        obj.lst_groups.children('.group-study').each(function() {
            $(this).bind('click', function() {
                document.location.href += '/' + $(this).data('id')
            });
        });
    },

    bindUIActions: function() {
        obj = this.settings;

        $('#mdl-join .btn-primary').bind('click', function() {

        });
    },
};



$(document).ready(function() {
    ContactFormWidget.init();
});