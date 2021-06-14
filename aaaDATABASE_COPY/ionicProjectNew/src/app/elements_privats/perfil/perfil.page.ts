import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Perfil } from '../../models/perfil.model';
import { RecursService } from '../../services/recurs.service';

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.page.html',
  styleUrls: ['./perfil.page.scss'],
})
export class PerfilPage {


  public element= [];


  
  constructor(private apiService: RecursService, private router: Router) {


    if(localStorage.getItem('tokenUser') == null){
      // this.router.navigate(["login"]);
      window.location.href = "login";
    }


    this.apiService.infoPerfil();
    this.apiService.perfil.subscribe(
      (perfilOriginal: Perfil[]) => {
        this.element= perfilOriginal;
        console.log(perfilOriginal);
      }
    );

    
    
  }


  logForm(){
    this.apiService.actualitzarPerfil(this.element[0].id, this.element[0].usuari, this.element[0].nom, this.element[0].cognom, this.element[0].correu);
    
  }

}
