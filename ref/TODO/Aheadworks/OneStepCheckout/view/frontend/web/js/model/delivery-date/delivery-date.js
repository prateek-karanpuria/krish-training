/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    ['ko'],
    function (ko) {
        'use strict';

        var date = ko.observable(''),
            timeSlot = ko.observable('');

        return {
            date: date,
            timeSlot: timeSlot
        };
    }
);
