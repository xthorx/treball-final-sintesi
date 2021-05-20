import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { Drink } from '../models/drink.model';
import { DrinkService } from '../services/drink.service';

@Component({
  selector: 'app-recurs',
  templateUrl: './recurs.component.html',
  styleUrls: ['./recurs.component.scss'],
})
export class RecursComponent implements OnInit {

  public elements = [];
  public idRec="";
  

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.idRec= params.get("id");

      console.log(this.idRec);

      this.apiService.retrieveDrinksFromHttp("?id=57");
      // this.apiService.retrieveDrinksFromHttp("?id=57");
      
      this.apiService.drinks.subscribe(
        (originalDrinks: Drink[]) => {
          this.elements = originalDrinks;
          // console.log(this.elements);
        }
      );
      
    });
  }

  constructor(private route: ActivatedRoute, private apiService: DrinkService) {
  }



}
