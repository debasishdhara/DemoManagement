import { Component, OnInit } from '@angular/core';
import { RoutecheckService } from '../routecheck.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  username:any;
  password:any;
  data:any;
  constructor(private logServ:RoutecheckService) { }

  ngOnInit(): void {
  }

  login(){
    let data = {
      email:this.username,
      password:this.password
    }
    this.logServ.login(data).subscribe(res=>{
      console.log(res);
      this.data = res;
      if(this.data.serverResponse.isSuccess){
        localStorage.setItem('user_details',JSON.stringify(this.data.result.user_details));
        localStorage.setItem('con',JSON.stringify(this.data.result.token_details.original));
      }
    });
  }
}
