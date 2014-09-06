'use strict';

/**
 * @ngdoc service
 * @name apiApp.permission
 * @description
 * # permission
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('permission', function () {
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
