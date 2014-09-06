'use strict';

/**
 * @ngdoc service
 * @name apiApp.projectComment
 * @description
 * # projectComment
 * Factory in the apiApp.
 */
angular.module('apiApp')
  .factory('projectComment', function () {
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
