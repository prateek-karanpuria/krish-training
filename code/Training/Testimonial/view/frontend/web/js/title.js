define(function() {
   'use strict';

   return function(config, element) {
     console.log("Config: ",config);
     console.log("Element: ",element);
     element.innerText = 'Version 1';
   } 
});
