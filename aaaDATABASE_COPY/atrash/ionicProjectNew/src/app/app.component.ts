import { Component } from '@angular/core';
import { Perfil } from './models/perfil.model';
import { RecursService } from './services/recurs.service';
@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {
  public appPages = [
    { title: 'Pàgina inicial', url: '/folder/Favoritess', icon: 'mail' },
    { title: 'Outbox', url: '/folder/Outbox', icon: 'paper-plane' },
    { title: 'Favorites', url: '/folder/Favorites', icon: 'heart' },
    { title: 'Archived', url: '/folder/Archived', icon: 'archive' },
    { title: 'Trash', url: '/folder/Trash', icon: 'trash' },
    { title: 'Spam', url: '/folder/Spam', icon: 'warning' },
  ];

  public loggedInLocalstorage= "no";


  constructor(private apiService: RecursService) {

    if(localStorage.getItem('tokenUser') != null){
      this.loggedInLocalstorage= "si";
    }

  }
}
