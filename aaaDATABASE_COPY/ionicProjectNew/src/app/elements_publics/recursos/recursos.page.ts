import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';


@Component({
  selector: 'app-recursos',
  templateUrl: './recursos.page.html',
  styleUrls: ['./recursos.page.scss'],
})
export class RecursosPage {

  public elements = [];

  constructor(private apiService: RecursService, private router: Router) {

    this.apiService.retrieveRecursosFromHttpALL();
    this.apiService.recursos.subscribe(
      (RecursosOriginals: Recurs[]) => {
        this.elements = RecursosOriginals;
        
      }
    );
    
  }


  getResource(id){

    this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id]);

  }



}
