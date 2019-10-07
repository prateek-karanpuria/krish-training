define(['ko'], function(ko) {
    "use strict";

    return function(config) {
        var data = ko.observable("Data");
            data.subscribe(function(newValue) {
                console.log("Data value changed to " + newValue);
            });

            data.subscribe(function(oldValue) {
                console.log("Data value changed from " + oldValue);
            }, this, 'beforeChange');

        return {
            'title': ko.observable('Test'),
            getTitle: function() {
                return this.title;
            },
            config: config,
            data: data,
            output: ko.computed(function() {
                console.log('In Computed observable function');
                return 'abc';
            })
        };
    }; 
});
