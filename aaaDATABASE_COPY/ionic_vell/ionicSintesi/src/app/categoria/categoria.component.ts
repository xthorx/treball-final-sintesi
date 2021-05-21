import { Component, OnInit } from '@angular/core';
import { Drink } from '../models/drink.model';
import { DrinkService } from '../services/drink.service';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.scss'],
})
export class CategoriaComponent {

  public elements = [];

  constructor(private apiService: DrinkService) {

    this.apiService.retrieveDrinksFromHttp("");
    // this.apiService.retrieveDrinksFromHttp("?id=57");
    this.apiService.drinks.subscribe(
      (originalDrinks: Drink[]) => {
        this.elements = originalDrinks;
        
      }
    );
  }

}
