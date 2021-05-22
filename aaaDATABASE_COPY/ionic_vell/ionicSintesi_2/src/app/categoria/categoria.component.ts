import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Drink } from '../models/drink.model';
import { DrinkService } from '../services/drink.service';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.scss'],
})
export class CategoriaComponent {

  public elements = [];
  public idRec="";
  

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.idRec= params.get("id");

      console.log(this.idRec);

      // this.apiService.retrieveDrinksFromHttp("?id=" + this.idRec);
      this.apiService.retrieveDrinksFromHttp("");
      
      this.apiService.drinks.subscribe(
        (originalDrinks: Drink[]) => {
          this.elements = originalDrinks;
          console.log(this.elements);
        }
      );
      
    });
  }

  constructor(private route: ActivatedRoute, private apiService: DrinkService) {
  }

}
