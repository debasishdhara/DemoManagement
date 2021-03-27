import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot } from '@angular/router';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { catchError, retry, map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class RoutecheckService implements CanActivate {
  protected baseURL = environment.base_url;
  authdata:any;
  constructor(private http: HttpClient) { }


  canActivate(next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot):Observable<any> {
    return this.checkAuthenticated(next);
  }

  checkAuthenticated(next):Observable<any> {
    let data = JSON.parse(localStorage.getItem('con'));
    let head = new HttpHeaders({
      'Content-Type':'application/json',
      'Authorization':'Bearer '+(data?data.access_token:"")
    });
    return this.http.post(this.baseURL+"auth/refresh",{},{headers:head}).pipe(map(res=>{
      console.log(res);
      this.authdata = res;
      if(this.authdata.serverResponse.isSuccess){
        localStorage.setItem('con',JSON.stringify(this.authdata.result.original));
      }
    }));
  }

  checkAuth(){
    let data = JSON.parse(localStorage.getItem('con'));
    let head = new HttpHeaders({
      'Content-Type':'application/json',
      'Authorization':'Bearer '+(data?data.access_token:"")
    });
    return this.http.post(this.baseURL+"auth/me",{},{headers:head});
  }

  login(data){
    return this.http.post(this.baseURL+"v1/login",data);
  }
}
