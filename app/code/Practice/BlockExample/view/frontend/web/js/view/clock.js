define([
    'uiComponent',
    'ko'
],function (uiComponent,ko) {
        return uiComponent.extend({
            _currentTime:ko.observable("Loading"),
            initialize:function () {
                this._super();
                setInterval(this.updateTime.bind(this),1000);
            },
            getTime:function () {
                return this._currentTime;
            },
            updateTime:function () {
                this._currentTime(new Date());
            }
        });
    });