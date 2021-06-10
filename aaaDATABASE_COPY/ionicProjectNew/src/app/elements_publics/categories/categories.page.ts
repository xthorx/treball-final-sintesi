import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Categoria } from '../../models/categoria.model';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.page.html',
  styleUrls: ['./categories.page.scss'],
})
export class CategoriesPage {

  public elements = [];
  public categories = [];

  constructor(private apiService: RecursService, private router: Router) {

    this.apiService.retrieveRecursosFromHttpALL();
    this.apiService.recursos.subscribe(
      (RecursosOriginals: Recurs[]) => {
        this.elements = RecursosOriginals;
        
      }
    );


    this.apiService.retrieveCategories();
    this.apiService.categories.subscribe(
      (RecursosOriginals: Categoria[]) => {
        this.categories = RecursosOriginals;
        
      }
    );


    
    
  }

}
