import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { Observable, of } from 'rxjs';
import { environment } from 'src/environments/environment';
import { catchError, retry, map } from 'rxjs/operators';
@Injectable({
  providedIn: 'root'
})
export class RoutecheckService implements CanActivate {
  protected baseURL = environment.base_url;
  authdata:any;
  constructor(private http: HttpClient,private router:Router) { }


  canActivate(next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot):Observable<boolean> {
    return this.checkAuthenticated(next);
  }

  checkAuthenticated(next):Observable<boolean> {
    let data = JSON.parse(localStorage.getItem('con'));
    if(!data){
      this.router.navigateByUrl('/login');
      return of(false);
    }
    let head = new HttpHeaders({
      'Content-Type':'application/json',
      'Authorization':'Bearer '+(data?data.access_token:"")
    });
    return this.http.post(this.baseURL+"auth/refresh",{},{headers:head}).pipe(map(res=>{
      this.authdata = res;
      if(this.authdata.serverResponse.isSuccess){
        localStorage.setItem('con',JSON.stringify(this.authdata.result.original));
        return true;
      }else{
        this.signOut();
        return false;
      }
    }));
  }
  signOut(){
    localStorage.removeItem('user_details');
    localStorage.removeItem('con');
    localStorage.removeItem('auth');
    const headerDict = {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Access-Control-Allow-Headers': 'Content-Type'
    }
    // return userjson.result.token_type;
    const headers = headerDict;
    return this.http.post(this.baseURL+'v1/logout',{},{ headers }).pipe(map(res=>{
      return true;
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
