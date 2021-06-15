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

  retrieveDrinksFromHttp(funcParam) {

    this._drinks.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api' + funcParam).subscribe(

      (response: any) => {


        if(funcParam == ""){
          response= JSON.parse(response);

          response.forEach(
            (element: any) => {
              let drinks: Drink = new Drink();
              drinks.id = element.id;
              drinks.titol = element.titol;
              drinks.autor = element.autor;
              drinks.privadesa = element.privadesa;

              this.drinks.pipe(take(1)).subscribe(
                (originalDrinks: Drink[]) => {
                  this._drinks.next(originalDrinks.concat(drinks));
                  // console.log(originalDrinks);

                }
              );
            }
          )
        }else{

          

          console.log("amb parametre: " + funcParam);

          response= JSON.parse(response);

          let drinks: Drink = new Drink();
          drinks.id = response.id;
          drinks.titol = response.titol;
          drinks.autor = response.autor;
          drinks.privadesa = response.privadesa;
  
  
  
          this.drinks.pipe(take(1)).subscribe(
            (originalDrinks: Drink[]) => {
              this._drinks.next(originalDrinks.concat(drinks));
              // console.log(originalDrinks);
  
            }
          );

        }


        

        


        
      }
    );
  }




  
}
