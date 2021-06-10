import { Injectable } from "@angular/core";
import { Drink } from "../models/drink.model";
import { DrinkService } from "./drink.service";

@Injectable({
  providedIn: "root"
})
export class DataService {
  
  public items: any = [];

  constructor(private apiService: DrinkService) {

    this.apiService.retrieveDrinksFromHttpALL();
    this.apiService.drinks.subscribe(
      (originalDrinks: Drink[]) => {
        this.items = originalDrinks;
        // console.log(this.items);
        
      }
    );

  }


  filterItems(searchTerm) {
    return this.items.filter(item => {
      return item.titol.toLowerCase().indexOf(searchTerm.toLowerCase()) > -1;
    });
  }
}