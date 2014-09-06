'use strict';

/**
 * @ngdoc service
 * @name apiApp.drive
 * @description
 * # drive
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('drive', function () {
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
