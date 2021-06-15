import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { RecursService } from '../../services/recurs.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage {

  public elements = [];
  public elementString= "aa";

  public username= "";
  public password= "";

  constructor(private apiService: RecursService, private router: Router) {}

  loginFunction(){

    this.apiService.loginPostJWT(this.username,this.password);
    
    // this.apiService.loginPostJWT(this.username,this.password).subscribe(
    //   (response: any) => {
    //     console.log(response);
    //   }
    // );

  }

}
