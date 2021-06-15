import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Categoria } from '../../models/categoria.model';
import { Drink } from '../../models/drink.model';
import { DrinkService } from '../../services/drink.service';


@Component({
  selector: 'app-categories-tab',
  templateUrl: './categories-tab.page.html',
  styleUrls: ['./categories-tab.page.scss'],
})
export class CategoriesTabPage {

  public elements = [];
  public categories = [];

  constructor(private apiService: DrinkService, private router: Router) {

    this.apiService.retrieveDrinksFromHttpALL();
    // this.apiService.retrieveDrinksFromHttp("?id=57");
    this.apiService.drinks.subscribe(
      (originalDrinks: Drink[]) => {
        this.elements = originalDrinks;
        
      }
    );


    this.apiService.retrieveCategories();
    // this.apiService.retrieveDrinksFromHttp("?id=57");
    this.apiService.categories.subscribe(
      (originalDrinks: Categoria[]) => {
        this.categories = originalDrinks;
        
      }
    );


    
    
  }



}
