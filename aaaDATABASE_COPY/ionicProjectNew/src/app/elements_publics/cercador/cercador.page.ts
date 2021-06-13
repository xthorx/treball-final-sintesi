import { Component, OnInit } from "@angular/core";
import { ActivatedRoute, Params, Router } from "@angular/router";
import { Recurs } from "../../models/recurs.model";
import { RecursService } from "../../services/recurs.service";

@Component({
  selector: 'app-cercador',
  templateUrl: './cercador.page.html',
  styleUrls: ['./cercador.page.scss'],
})
export class CercadorPage implements OnInit{

  public elements = [];
  public motCerca = "";



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

    this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id, "cercador"]);

  }

}
