import { Component } from '@angular/core';
import { RoutecheckService } from './routecheck.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'projectdemo';
  authCheck:boolean = false;
  constructor(private authcheckService:RoutecheckService) {
    authcheckService.checkAuth().subscribe(res=>{
      console.log(res);
    }, err => {
      console.log(err);
    });
  }
}
