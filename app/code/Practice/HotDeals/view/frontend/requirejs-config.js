var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'Practice_HotDeals/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Practice_HotDeals/js/view/shipping-payment-mixin': true
            }
        }
    }
}
