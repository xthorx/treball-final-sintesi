import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { Categoria } from '../../models/categoria.model';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.page.html',
  styleUrls: ['./categories.page.scss'],
})
export class CategoriesPage implements OnInit{

  public elements = [];
  public categories = [];


  ngOnInit() {
    this.route.params.subscribe(
      (params: Params) => {
        this.apiService.retrieveRecursosFromHttpALL();
      }
    );
  }

  constructor(private apiService: RecursService, private router: Router, private route: ActivatedRoute) {

    // this.apiService.retrieveRecursosFromHttpALL();
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


  getResource(id){

    this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id, "categories"]);

  }



}
