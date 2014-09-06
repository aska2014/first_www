'use strict';

/**
 * @ngdoc service
 * @name apiApp.webservice
 * @description
 * # webservice
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('webservice', function () {
    // Service logic
    // ...

    var meaningOfLife = 42;

    // Public API here
    return {
      someMethod: function () {
        return meaningOfLife;
      }
    };
  });
