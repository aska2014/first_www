'use strict';

/**
 * @ngdoc service
 * @name apiApp.user
 * @description
 * # user
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('user', function () {
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
