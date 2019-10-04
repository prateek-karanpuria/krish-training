define([], function() {
    "use strict";

    return function(config, data) {
        return {
            'title': 'Test',
            getTitle: function() {
                return this.title;
            },
            config: config,
            'data': data
        };
    };
});
