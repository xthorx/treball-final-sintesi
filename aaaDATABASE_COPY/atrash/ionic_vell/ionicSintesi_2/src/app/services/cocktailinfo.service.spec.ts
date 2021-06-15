import { TestBed } from '@angular/core/testing';

import { CocktailinfoService } from './cocktailinfo.service';

describe('CocktailinfoService', () => {
  let service: CocktailinfoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CocktailinfoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
