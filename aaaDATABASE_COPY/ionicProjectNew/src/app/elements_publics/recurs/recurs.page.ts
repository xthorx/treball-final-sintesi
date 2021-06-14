import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';

@Component({
  selector: 'app-recurs',
  templateUrl: './recurs.page.html',
  styleUrls: ['./recurs.page.scss'],
})
export class RecursPage implements OnInit {

  public element: Recurs = new Recurs();
  public idRec = "";
  public pagAnterior = "";

  public tokenUsable= "";

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

        this.tokenUsable= localStorage.getItem('tokenUser');
      }
    );
  }
  constructor(private route: ActivatedRoute, private apiService: RecursService, private router: Router) {
  }


  returnBackRecurs(w){

    this.router.navigate([w]);

  }

}
