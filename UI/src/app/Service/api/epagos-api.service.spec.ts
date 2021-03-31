import { TestBed } from '@angular/core/testing';

import { EpagosApiService } from './epagos-api.service';

describe('EpagosApiService', () => {
  let service: EpagosApiService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(EpagosApiService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
