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

  public element: Drink= new Drink();
  public idRec="";
  

  ngOnInit() {
    // this.route.paramMap.subscribe(params => {
    //   this.idRec= params.get("id");

    //   // console.log(this.idRec);

    //   this.apiService.retrieveDrinksFromHttp("?id=" + this.idRec);
    //   // this.apiService.retrieveDrinksFromHttp("?id=57");
      
      
      
    // });
    
    this.apiService.drink.subscribe(
      
      (originalDrinks: Drink) => {
        
        console.log(originalDrinks);
        this.element.id = originalDrinks[0].id;
        console.log(originalDrinks);
        // console.log(this.element);

      }
    );

  }




  constructor(private route: ActivatedRoute, private apiService: DrinkService) {
  }



}
