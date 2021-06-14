import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { Router } from '@angular/router';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';

@Component({
  selector: 'app-recurs',
  templateUrl: './recurs.component.html',
  styleUrls: ['./recurs.component.scss'],
})
export class RecursComponent implements OnInit {

  public element: Recurs = new Recurs();
  public idRec = "";
  public pagAnterior = "";

  ngOnInit() {

    this.route.paramMap.subscribe(params => {
      this.idRec = params.get("id");

      if(params.get("w") != null){
        this.pagAnterior = params.get("w");
      }else{ this.pagAnterior= "recursos";}
      

      this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + this.idRec);

    });

    this.apiService.recurs.subscribe(

      (recursosOriginals: Recurs) => {
        console.log(recursosOriginals);
        this.element = recursosOriginals;
      }
    );
  }
  constructor(private route: ActivatedRoute, private apiService: RecursService, private router: Router) {
  }


  returnBackRecurs(w){

    this.router.navigate([w]);

  }


  
}
