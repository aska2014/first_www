'use strict';

describe('Service: webservice', function () {

  // load the service's module
  beforeEach(module('apiApp'));

  // instantiate service
  var webservice;
  beforeEach(inject(function (_webservice_) {
    webservice = _webservice_;
  }));

  it('should do something', function () {
    expect(!!webservice).toBe(true);
  });

});
