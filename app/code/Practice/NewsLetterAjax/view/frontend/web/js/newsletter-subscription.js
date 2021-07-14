define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'mage/mage'
], function ($, $t) {
    'use strict';

    $.widget('phpcuong.Newsletter', {

        /** @inheritdoc */
        _create: function () {
            this._bindSubmit();
        },

        /**
         * @private
         */
        _bindSubmit: function () {
            var self = this;

            this.element.on('submit', function (e) {
                e.preventDefault();
                if ($(this).validation('isValid')) {
                    self.submitForm($(this));
                }
            });
        },

        /**
         * Handler for the form 'submit' event
         *
         * @param {Object} form
         */
        submitForm: function (form) {
            var self = this;
            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                type: 'post',
                dataType: 'json',
                showLoader: true,
                /** @inheritdoc */
                beforeSend: function () {
                    self.element.parent().find('.messages').remove();
                },
                success: function (response) {
                    if (response.error) {
                        self.element.after('<div class="messages"><div class="message message-error error"><div>'+response.message+'</div></div></div>');
                    } else {
                        self.element.find('input').val('');
                        self.element.after('<div class="messages"><div class="message message-success success"><div>'+response.message+'</div></div></div>');
                    }
                },
                error: function() {
                    self.element.after('<div class="messages"><div class="message message-error error"><div>'+$t('An error occurred, please try again later.')+'</div></div></div>');
                }
            });
        }
    });

    return $.phpcuong.Newsletter;
});