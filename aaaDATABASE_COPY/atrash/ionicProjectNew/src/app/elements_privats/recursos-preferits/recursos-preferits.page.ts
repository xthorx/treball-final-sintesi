import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { Recurs } from '../../models/recurs.model';
import { RecursService } from '../../services/recurs.service';


@Component({
  selector: 'app-recursos-preferits',
  templateUrl: './recursos-preferits.page.html',
  styleUrls: ['./recursos-preferits.page.scss'],
})
export class RecursosPreferitsPage implements OnInit{

  public elements = [];


  ngOnInit() {

    if(localStorage.getItem('tokenUser') == null){
      // this.router.navigate(["login"]);
      window.location.href = "login";
    }

    this.route.params.subscribe(
      (params: Params) => {
        this.apiService.recursosPreferits();
      }
    );
  }


  constructor(private apiService: RecursService, private router: Router, private route: ActivatedRoute) {
    // this.apiService.recursosPreferits();
    this.apiService.recursos.subscribe(
      (RecursosOriginals: Recurs[]) => {
        this.elements = RecursosOriginals;
        
      }
    );

  }



  getResource(id){

    // this.apiService.retrieveRecursosFromHttpUNIQUE("?id=" + id);
    this.router.navigate(["recurs", id, "recursos-preferits"]);

  }

}
