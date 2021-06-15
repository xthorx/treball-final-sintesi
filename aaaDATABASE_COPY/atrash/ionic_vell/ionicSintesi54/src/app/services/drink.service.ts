import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { take } from 'rxjs/operators';

import { Drink } from '../models/drink.model';
import { Categoria } from '../models/categoria.model';

@Injectable({
  providedIn: 'root'
})
export class DrinkService {

  //1) El BehaviourSubject és una classe que pot ser OBSERVABLE
  private _drinks: BehaviorSubject<Drink[]> = new BehaviorSubject<Drink[]>([]);
  private _categories: BehaviorSubject<Categoria[]> = new BehaviorSubject<Categoria[]>([]);
  private _drink: BehaviorSubject<Drink> = new BehaviorSubject<Drink>(new Drink);

  //2) Necessitm el servei HttpClient per tal de poder fer la crida al Servei Web
  constructor(private http: HttpClient) { }

  get drinks(): Observable<Drink[]> {
    return this._drinks.asObservable();
  }

  get categories(): Observable<Categoria[]> {
    return this._categories.asObservable();
  }

  get drink(): Observable<Drink> {
    return this._drink.asObservable();
  }


  retrieveDrinksFromHttpALL() {

    this._drinks.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api').subscribe(

      (response: any) => {

        response= JSON.parse(response);

        response.forEach(
          (element: any) => {
            let drinks: Drink = new Drink();
            drinks.id = element.id;
            drinks.titol = element.titol;
            drinks.autor = element.autor;
            drinks.privadesa = element.privadesa;
            drinks.categoria = element.categoria;

            this.drinks.pipe(take(1)).subscribe(
              (originalDrinks: Drink[]) => {
                this._drinks.next(originalDrinks.concat(drinks));
                // console.log(originalDrinks);

              }
            );
          }
        )

      }
    );
  }


  retrieveCategories() {

    this._categories.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api?categories=1').subscribe(

      (response: any) => {

        response= JSON.parse(response);

        response.forEach(
          (element: any) => {
            let categories: Categoria = new Categoria();
            categories.id = element.id;
            categories.nom = element.nom;

            console.log(categories.nom);

            this.categories.pipe(take(1)).subscribe(
              (originalDrinks: Categoria[]) => {
                this._categories.next(originalDrinks.concat(categories));
                // console.log(originalDrinks);

              }
            );
          }
        )

      }
    );
  }





  retrieveDrinksFromHttpUNIQUE(funcParam) {

    this._drinks.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api' + funcParam).subscribe(

      (response: any) => {

        console.log("amb parametre: " + funcParam);


        response= JSON.parse(response);
        
        // console.log("response");
        // console.log(response);
        // console.log(response.id);

        let drink: Drink = new Drink();
        drink.id = response.id;
        drink.titol = response.titol;
        drink.autor = response.autor;
        drink.privadesa = response.privadesa;
        drink.categoria = response.categoria;
        
        
        this._drink.next(drink);

        console.log(drink);


        
        // console.log(drinks);

        // this.drinks.pipe(take(1)).subscribe(
        //   (originalDrinks: Drink[]) => {

        //     //ERROR AQUI
        //     this._drinks.next([drinks]);
        //     // console.log(drinks);
        //     // console.log(originalDrinks);

        //   }
        // );


      }
    );
  }




  
}
