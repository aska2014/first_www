'use strict';

describe('Service: projectComment', function () {

  // load the service's module
  beforeEach(module('apiApp'));

  // instantiate service
  var projectComment;
  beforeEach(inject(function (_projectComment_) {
    projectComment = _projectComment_;
  }));

  it('should do something', function () {
    expect(!!projectComment).toBe(true);
  });

});
