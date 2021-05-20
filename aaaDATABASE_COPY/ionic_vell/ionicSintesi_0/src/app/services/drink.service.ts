import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { take } from 'rxjs/operators';

import { Drink } from '../models/drink.model';

@Injectable({
  providedIn: 'root'
})
export class DrinkService {

  //1) El BehaviourSubject és una classe que pot ser OBSERVABLE
  private _drinks: BehaviorSubject<Drink[]> = new BehaviorSubject<Drink[]>([]);

  //2) Necessitm el servei HttpClient per tal de poder fer la crida al Servei Web
  constructor(private http: HttpClient) { }

  get drinks(): Observable<Drink[]> {
    return this._drinks.asObservable();
  }

  retrieveDrinksFromHttp(begudaParam) {

    this._drinks.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api?id=' + begudaParam).subscribe(
      (response: any) => {

        response= JSON.parse(response);

        let drinks: Drink = new Drink();
        drinks.id = response.id;
        drinks.titol = response.titol;
        drinks.autor = response.autor;
        drinks.privadesa = response.privadesa;

        console.log(drinks.titol);



        this.drinks.pipe(take(1)).subscribe(
          (originalDrinks: Drink[]) => {
            this._drinks.next(originalDrinks.concat(drinks));
            // console.log(originalDrinks);

          }
        );


        // response.drinks.forEach(
        //   (element: any) => {
        //     let drinks: Drink = new Drink();
        //     drinks.titol = element.titol;
        //     drinks.thumb = element.strDrinkThumb;
        //     drinks.instructions = element.strInstructions;



        //     this.drinks.pipe(take(1)).subscribe(
        //       (originalDrinks: Drink[]) => {
        //         this._drinks.next(originalDrinks.concat(drinks));
        //         // console.log(originalDrinks);

        //       }
        //     );
        //   }
        // )
      }
    );
  }




  
}
