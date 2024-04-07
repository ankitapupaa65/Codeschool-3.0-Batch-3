import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { enviornment } from '../../enviroment/enviroment';
import { SweetAlertServicesService } from '../common/services/sweet-alert.service';



@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, HttpClientModule, FormsModule, ReactiveFormsModule, RouterModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  public showPassword: boolean = false;
  public logInFormStatus: boolean = false;

  public apiUrl: string = ''

  public logInFormDetails = new FormGroup({
    email: new FormControl('', [Validators.required, Validators.email]),
    password: new FormControl('', [Validators.required, Validators.minLength(5), Validators.maxLength(16)])
  })

  constructor(
    private http: HttpClient,
    private router: Router,
    private sweetalert: SweetAlertServicesService
  ) {
    this.apiUrl = enviornment.ApiUrl;
  }
  ngOnInit() {

    let token = localStorage.getItem('token');

    if (token) {

      this.router.navigate(['/home'])
    }
  }
  public showPasswordText() {

    this.showPassword = !this.showPassword;

  }
  public login() {

    this.logInFormStatus = false;
    if (this.logInFormDetails.invalid) {
      this.logInFormStatus = true;
      return;
    }
console.log(this.logInFormStatus)

    this.http.post(this.apiUrl + 'login', this.logInFormDetails.value).subscribe((res: any) => {

      if (res.status) {
        localStorage.setItem('token', res.data.token);
        this.sweetalert.SucessMessage('Success', 'Login Successfully');

        this.router.navigate(['/home'])
      } else {
        this.sweetalert.ErrorMessage('Error', res.message)
      }
    },
      (err: any) => {
        this.sweetalert.ErrorMessage('Error', err.message)
      })

  }


}
