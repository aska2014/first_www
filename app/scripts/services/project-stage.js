'use strict';

/**
 * @ngdoc service
 * @name apiApp.projectStage
 * @description
 * # projectStage
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('projectStage', function () {
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
