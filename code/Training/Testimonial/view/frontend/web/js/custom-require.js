console.log("I am in custom requireJS file");
//alert('in');
define(function() {
    'use strict';

    return function() {
        console.log("I am in custom require JS AMD module function");
    }
});
