define(
    [
        'ko'
    ], function (ko) {
        'use strict';

        var mixin = {

            initialize: function () {
                // for the review & payment step
                this.isVisible = ko.observable(false);
                // for the shipping step
                this.visible = ko.observable(false);

                this._super();
                return this;
            }
        };

        return function (target) {
            return target.extend(mixin);
        };
    }
);