'use strict';

describe('Service: drive', function () {

  // load the service's module
  beforeEach(module('apiApp'));

  // instantiate service
  var drive;
  beforeEach(inject(function (_drive_) {
    drive = _drive_;
  }));

  it('should do something', function () {
    expect(!!drive).toBe(true);
  });

});
