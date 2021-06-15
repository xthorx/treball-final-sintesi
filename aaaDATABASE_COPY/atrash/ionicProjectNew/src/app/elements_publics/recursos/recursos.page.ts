import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';


@Component({
  selector: 'app-recursos',
  templateUrl: './recursos.page.html',
  styleUrls: ['./recursos.page.scss'],
})
export class RecursosPage implements OnInit{

  public elements = [];


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
    
  }


  getResource(id){

    // this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id, "recursos"]);

  }



}
