define(function() {
    'use strict';

    return function(config, element) {
        console.log("I am in a function whose url is", config);
        console.log(element);
    }
});
