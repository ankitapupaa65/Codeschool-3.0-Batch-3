import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { SweetAlertServicesService } from '../../services/sweet-alert.service';
import { UserAuthService } from '../../services/user-auth.service';
import { enviornment } from '../../../../enviroment/enviroment';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [RouterModule, CommonModule, HttpClientModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.css'
})
export class HeaderComponent {
  public apiUrl: string = " ";
  public users: any = [];
  public userDetails: any = {};
  constructor(
    private http: HttpClient,
    private router: Router,
    private sweetalert: SweetAlertServicesService,
    private userAuth: UserAuthService

  ) {
    this.apiUrl = enviornment.ApiUrl;

  }
  ngOnInit() {
    let token = localStorage.getItem('token');
    if (!token) {
      this.router.navigate(['/login']);

    }
    this.userAuth.getUserInfo();

    this.users = localStorage.getItem('userDetails');
    this.userDetails = JSON.parse(this.users);
    console.log(this.userDetails, 89)
  }

  public logout() {

    console.log('logout');
    localStorage.clear();

    this.router.navigate(['/login']);
  }

}

