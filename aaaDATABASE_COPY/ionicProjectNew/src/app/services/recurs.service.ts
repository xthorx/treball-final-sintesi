import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { take } from 'rxjs/operators';

import { Recurs } from '../models/recurs.model';
import { Categoria } from '../models/categoria.model';
import { hostViewClassName } from '@angular/compiler';

@Injectable({
  providedIn: 'root'
})

export class RecursService {

  //1) El BehaviourSubject és una classe que pot ser OBSERVABLE
  private _recursos: BehaviorSubject<Recurs[]> = new BehaviorSubject<Recurs[]>([]);
  private _categories: BehaviorSubject<Categoria[]> = new BehaviorSubject<Categoria[]>([]);
  private _recurs: BehaviorSubject<Recurs> = new BehaviorSubject<Recurs>(new Recurs);

  public multipleTimesError= "si";

  //2) Necessitm el servei HttpClient per tal de poder fer la crida al Servei Web
  constructor(private http: HttpClient) { }

  get recursos(): Observable<Recurs[]> {
    return this._recursos.asObservable();
  }

  get categories(): Observable<Categoria[]> {
    return this._categories.asObservable();
  }

  get recurs(): Observable<Recurs> {
    return this._recurs.asObservable();
  }


  


  retrieveRecursosFromHttpALL() {

    this._recursos.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api').subscribe(

      (response: any) => {
        

        response = JSON.parse(response);

        // console.log(response);

        response.forEach(
          (element: any) => {
            let recursos: Recurs = new Recurs();
            
            recursos.id = element.id;
            recursos.titol = element.titol;

            this.http.get('http://localhost/treball-final-sintesi/api?autor=' + element.autor).subscribe(
              (response: any) => {JSON.parse(response).forEach(
                  (element_autor: any) => {
                    recursos.autor = element_autor.username;
            })});
            
            

            if(!isNaN(element.privadesa)){
              this.http.get('http://localhost/treball-final-sintesi/api?privadesa=' + element.privadesa).subscribe(
                (response: any) => {JSON.parse(response).forEach(
                    (privadesa_rec: any) => {
                      recursos.privadesa = privadesa_rec.nom;
              })});
            }else{
              recursos.privadesa = element.privadesa;
            }

            recursos.categoria_id = element.categoria;
            this.http.get('http://localhost/treball-final-sintesi/api?categoria_name=' + element.autor).subscribe(
              (response: any) => {JSON.parse(response).forEach(
                  (categoria_rec: any) => {
                    recursos.categoria = categoria_rec.nom;
            })});

            recursos.tipus = element.tipus_recurs;


            this.recursos.pipe(take(1)).subscribe(
              (recursosOriginals: Recurs[]) => {
                this._recursos.next(recursosOriginals.concat(recursos));

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

        

        response = JSON.parse(response);

        // console.log(response);

        response.forEach(
          (element: any) => {
            let categories: Categoria = new Categoria();
            categories.id = element.id;
            categories.nom = element.nom;

            this.categories.pipe(take(1)).subscribe(
              (recursosOriginals: Categoria[]) => {
                this._categories.next(recursosOriginals.concat(categories));

              }
            );
          }
        )

      }
    );
  }



  retrieveAutor(idAutor) {

    this._categories.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api?autor=' + idAutor).subscribe(

      (response: any) => {

        response = JSON.parse(response);

        response.forEach(
          (element: any) => {
            let categories: Categoria = new Categoria();
            categories.id = element.id;
            categories.nom = element.nom;

            console.log(categories.nom);

            this.categories.pipe(take(1)).subscribe(
              (recursosOriginals: Categoria[]) => {
                this._categories.next(recursosOriginals.concat(categories));

              }
            );
          }
        )

      }
    );
  }





  retrieveRecursosFromHttpUNIQUE(funcParam: String) {

    this._recursos.next([]);

    this.http.get('http://localhost/treball-final-sintesi/api' + funcParam).subscribe(

      (response: any) => {

        console.log("amb parametre: " + funcParam);

        response = JSON.parse(response);

        console.log("response id : " + response.id);

        let recurs: Recurs = new Recurs();
        recurs.id = response.id;
        recurs.titol = response.titol;
        recurs.autor = response.autor;
        recurs.privadesa = response.privadesa;
        recurs.categoria = response.categoria;


        this._recurs.next(recurs);

        console.log(recurs);


        this.recursos.pipe(take(1)).subscribe(
          (recursosOriginals: Recurs[]) => {
            this._recursos.next([recurs]);

          }
        );


      }
    );
  }




  loginPostJWT(user_username: String, user_pass: String) {

    this.http.post<any>('http://localhost/treball-final-sintesi/api2', { username: user_username, password: user_pass }).subscribe(data => {
        console.log("login: " + data.token);

        localStorage.setItem('tokenUser', data.token);


        return data;


    })

  }


  recursosPreferits(){

    this._recursos.next([]);

    let options = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('tokenUser')
      }),
      observe: 'response' as 'response'
    };

    this.http.get('http://localhost/treball-final-sintesi/api2', options).subscribe(
      (response: any) => {

        let recursosResponse = JSON.parse(response.body.recursos);

        recursosResponse.forEach(
          (element: any) => {

            let recursos: Recurs = new Recurs();

            recursos.id = element.id;
            recursos.titol = element.titol;

            this.http.get('http://localhost/treball-final-sintesi/api?autor=' + element.autor).subscribe(
              (response: any) => {JSON.parse(response).forEach(
                  (element_autor: any) => {
                    recursos.autor = element_autor.username;
            })});

            if(!isNaN(element.privadesa)){
              this.http.get('http://localhost/treball-final-sintesi/api?privadesa=' + element.privadesa).subscribe(
                (response: any) => {JSON.parse(response).forEach(
                    (privadesa_rec: any) => {
                      recursos.privadesa = privadesa_rec.nom;
              })});
            }else{
              recursos.privadesa = element.privadesa;
            }

            this.http.get('http://localhost/treball-final-sintesi/api?categoria_name=' + element.autor).subscribe(
              (response: any) => {JSON.parse(response).forEach(
                  (categoria_rec: any) => {
                    recursos.categoria = categoria_rec.nom;
            })});

            recursos.tipus = element.tipus_recurs;

            this._recursos.pipe(take(1)).subscribe(
              (recursosOriginals: Recurs[]) => {
                this._recursos.next(recursosOriginals.concat(recursos));
                // console.log(recursosOriginals);
              }
            );
          }
        )

        localStorage.setItem('tokenUser', response.body.token);
        
      }
    );



  }





  infoPerfil(){

    this._recursos.next([]);

    let options = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('tokenUser')
      }),
      observe: 'response' as 'response'
    };

    this.http.get('http://localhost/treball-final-sintesi/api2?perfil=1', options).subscribe(
      (response: any) => {

        console.log(JSON.parse(response));

        let usuariInfoResponse = JSON.parse(response.body.infousuari);

        usuariInfoResponse.forEach(
          (element: any) => {

            console.log(element);

            // let recursos: Recurs = new Recurs();

            // recursos.id = element.id;
            // recursos.titol = element.titol;
          }
        )

        localStorage.setItem('tokenUser', response.body.token);
        
      }
    );



  }




  








}
