'use strict';

/**
 * @ngdoc service
 * @name apiApp.notification
 * @description
 * # notification
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('notification', function () {
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
