import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { SweetAlertServicesService } from '../../common/services/sweet-alert.service';
import { UserAuthService } from '../../common/services/user-auth.service';
import { enviornment } from '../../../enviroment/enviroment';
import { FiterEmployeePipePipe } from '../../common/pipe/fiter-employee-pipe.pipe';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-all-employee-details',
  standalone: true,
  imports: [CommonModule,HttpClientModule,RouterModule,FiterEmployeePipePipe,FormsModule],
  templateUrl: './all-employee-details.component.html',
  styleUrl: './all-employee-details.component.css'
})
export class AllEmployeeDetailsComponent {
public apiUrl:string='';
public searchItem: string ="";
public employeeDetails:any=[];


 constructor(
    private http: HttpClient,
    private router: Router,
    private sweetalert: SweetAlertServicesService,
    private userAuth: UserAuthService,
   

  ) {
    this.apiUrl = enviornment.ApiUrl;
  }


  ngOnInit(){
this.getEmployeeDetails();

}
public getEmployeeDetails(){
 this.http.get(this.apiUrl + 'get-all-employee-details', { headers: this.userAuth.headers }).subscribe((res: any) => {

      if (res.status) {
        this.employeeDetails = res.data;
        console.log(this.employeeDetails)
      } else {
        this.sweetalert.ErrorMessage('Error', res.message)
      }
    },
      (err: any) => {
        this.sweetalert.ErrorMessage('Error', err.message)
      })
  }

}


