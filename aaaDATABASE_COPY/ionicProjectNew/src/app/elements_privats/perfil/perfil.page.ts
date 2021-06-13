import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { RecursService } from '../../services/recurs.service';

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.page.html',
  styleUrls: ['./perfil.page.scss'],
})
export class PerfilPage {

  public elements = [];


  constructor(private apiService: RecursService, private router: Router, private route: ActivatedRoute) {
    this.apiService.infoPerfil();
    this.apiService.recursos.subscribe(
      (RecursosOriginals: any) => {
        this.elements = RecursosOriginals;

        console.log(this.elements);
        
      }
    );

  }



  getResource(id){

    this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id, "recursos-preferits"]);

  }

}
