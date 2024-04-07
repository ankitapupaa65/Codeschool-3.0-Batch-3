import { HttpClient, HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { SweetAlertServicesService } from '../../common/services/sweet-alert.service';
import { UserAuthService } from '../../common/services/user-auth.service';
import { enviornment } from '../../../enviroment/enviroment';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-employee-details',
  standalone: true,
  imports: [CommonModule, RouterModule, HttpClientModule],
  templateUrl: './employee-details.component.html',
  styleUrl: './employee-details.component.css'
})
export class EmployeeDetailsComponent {
  public apiUrl: string = '';
  public employeeDetails: any = [];
  public employeeId: number = 0;

  constructor(
    private http: HttpClient,
    private router: Router,
    private route: ActivatedRoute,
    private sweetalert: SweetAlertServicesService,
    private userAuth: UserAuthService,


  ) {
    this.apiUrl = enviornment.ApiUrl;
  }


  ngOnInit() {

    this.route.params.subscribe(params => {
      this.employeeId = params['employeeId'];
      console.log(this.employeeId)
      this.getEmployeeDetails(this.employeeId);
    });
  }

  public getEmployeeDetails(empId: number) {
    let employeeId = empId;
    console.log(employeeId)
    this.http.post(this.apiUrl + 'get-employee-details-by-id', { employee_id: employeeId }, { headers: this.userAuth.headers }).subscribe((res: any) => {

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
