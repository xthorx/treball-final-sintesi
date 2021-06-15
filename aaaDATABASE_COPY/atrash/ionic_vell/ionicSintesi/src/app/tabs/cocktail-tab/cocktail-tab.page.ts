import { Component, OnInit } from '@angular/core';
import { Drink } from '../../models/drink.model';
import { DrinkService } from '../../services/drink.service';


@Component({
  selector: 'app-cocktail-tab',
  templateUrl: './cocktail-tab.page.html',
  styleUrls: ['./cocktail-tab.page.scss'],
})
export class CocktailTabPage {

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
