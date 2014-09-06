'use strict';

/**
 * @ngdoc service
 * @name apiApp.project
 * @description
 * # project
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('project', function () {
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
