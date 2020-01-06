/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    ['ko'],
    function (ko) {
        'use strict';

        var isLoading = ko.observable(false);

        return {
            isLoading: isLoading
        };
    }
);
