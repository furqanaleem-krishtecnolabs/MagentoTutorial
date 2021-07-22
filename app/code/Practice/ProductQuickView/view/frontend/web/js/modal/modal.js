define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'Magento_Customer/js/customer-data'
], function($, modal, customerData) {

    "use strict";

    $.widget('practice_product_quickview.customModal', $.mage.modal, {
        closeModal: function () {
            var sections = ['cart'];
            customerData.invalidate(sections);
            customerData.reload(sections, true);
            $('[data-block="minicart"]').trigger('contentUpdated');
            $('#practice-quickview-container').find('.quickview-content').html('');
            return this._super();
        },
    });
    return $.practice_product_quickview.customModal;
});