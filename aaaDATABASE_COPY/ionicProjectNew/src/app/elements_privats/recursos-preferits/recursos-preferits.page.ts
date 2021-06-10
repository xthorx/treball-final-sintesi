import { Component } from '@angular/core';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';


@Component({
  selector: 'app-recursos-preferits',
  templateUrl: './recursos-preferits.page.html',
  styleUrls: ['./recursos-preferits.page.scss'],
})
export class RecursosPreferitsPage {

  public elements = [];

  constructor(private apiService: RecursService) {
    this.apiService.recursosPreferits();
    this.apiService.recursos.subscribe(
      (RecursosOriginals: Recurs[]) => {
        this.elements = RecursosOriginals;
        
      }
    );

  }

}
