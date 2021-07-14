define([
    'Magento_Checkout/js/view/payment/default',
    'jquery',
    'mage/validation'
], function (Component, $) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Practice_OfflinePayments/payment/pdqpayment-form',
            assistantId: ''
        },

        /** @inheritdoc */
        initObservable: function () {
            this._super()
                .observe('assistantId');

            return this;
        },

        /**
         * @return {Object}
         */
        getData: function () {
            return {
                method: this.item.method,
                'additional_data': {
                    'assistant_id': this.assistantId()
                }
            };
        },

        /**
         * @return {jQuery}
         */
        validate: function () {
            var form = 'form[data-role=pdqpayment-form]';

            return $(form).validation() && $(form).validation('isValid');
        }
    });
});