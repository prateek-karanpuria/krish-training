/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    ['ko'],
    function (ko) {
        'use strict';

        var address_of = ko.observable('');

        return {
            address_of: address_of
        };
    }
);
