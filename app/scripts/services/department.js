'use strict';

/**
 * @ngdoc service
 * @name apiApp.department
 * @description
 * # department
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('department', function () {
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
