'use strict';

describe('Service: projectStage', function () {

  // load the service's module
  beforeEach(module('apiApp'));

  // instantiate service
  var projectStage;
  beforeEach(inject(function (_projectStage_) {
    projectStage = _projectStage_;
  }));

  it('should do something', function () {
    expect(!!projectStage).toBe(true);
  });

});
