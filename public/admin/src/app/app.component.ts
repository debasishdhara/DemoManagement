import { Component, ViewChild } from '@angular/core';
import { LoginComponent } from './login/login.component';
import { RoutecheckService } from './routecheck.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'projectdemo';
  authCheck:boolean=false;
  @ViewChild(LoginComponent) logcheck;
  constructor(private authcheckService:RoutecheckService) {
    setInterval(() => {
      this.authChekFromStore();
    },1000);
  }

  authChekFromStore(){
    let authdata = JSON.parse(localStorage.getItem('auth'));
    if(authdata && authdata.isSuccess==true){
      this.authCheck=true;
    }
  }

}
