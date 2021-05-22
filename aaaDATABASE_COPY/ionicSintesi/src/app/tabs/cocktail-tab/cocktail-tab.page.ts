import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Drink } from '../../models/drink.model';
import { DrinkService } from '../../services/drink.service';


@Component({
  selector: 'app-cocktail-tab',
  templateUrl: './cocktail-tab.page.html',
  styleUrls: ['./cocktail-tab.page.scss'],
})
export class CocktailTabPage {

  public elements = [];

  constructor(private apiService: DrinkService, private router: Router) {

    this.apiService.retrieveDrinksFromHttpALL();
    // this.apiService.retrieveDrinksFromHttp("?id=57");
    this.apiService.drinks.subscribe(
      (originalDrinks: Drink[]) => {
        this.elements = originalDrinks;
        
      }
    );
    
  }


  getResource(id){

    this.apiService.retrieveDrinksFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id]);

  }



}
