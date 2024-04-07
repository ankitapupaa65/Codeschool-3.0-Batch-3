import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { enviornment } from '../../../enviroment/enviroment';
import { SweetAlertServicesService } from './sweet-alert.service';



@Injectable({
  providedIn: 'root'
})
export class UserAuthService {

  public apiUrl: string = '';
  public userInfo: any = [];
  public authToken: any = '';
  public headers: any = new HttpHeaders();

  constructor(
    private http: HttpClient,
    private router: Router,
private sweetalert:SweetAlertServicesService
  ) {
    this.apiUrl = enviornment.ApiUrl;
    this.authToken = localStorage.getItem('token');
    this.headers = new HttpHeaders({
      'Authorization': `Bearer ${this.authToken}`,
      // 'Content-Type': 'application/json'
    });
  }

  public getUserInfo() {
    this.http.get(this.apiUrl+'user-info', { headers:  this.headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem('token')}`,
      'Content-Type': 'application/json'
    }) })
      .subscribe(
        (data:any) => {
          if (data.status) {
            this.userInfo = data.data
localStorage.setItem('userDetails',JSON.stringify(this.userInfo));
console.log(this.userInfo,98)
          } else {
            this.sweetalert.ErrorMessage('Error', data.message);
            localStorage.clear();
            this.router.navigate(['/login'])
          }

        },
        (error) => {

          this.sweetalert.ErrorMessage('Error', error.message);
          localStorage.clear();
          this.router.navigate(['/login'])
        }
      );
  } 





}

