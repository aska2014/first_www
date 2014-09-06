'use strict';

/**
 * @ngdoc service
 * @name apiApp.file
 * @description
 * # file
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('file', function () {
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
