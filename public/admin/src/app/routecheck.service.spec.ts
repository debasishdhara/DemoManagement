import { TestBed } from '@angular/core/testing';

import { RoutecheckService } from './routecheck.service';

describe('RoutecheckService', () => {
  let service: RoutecheckService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RoutecheckService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
