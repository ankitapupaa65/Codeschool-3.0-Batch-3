import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { Router, RouterModule } from '@angular/router';
import { SweetAlertServicesService } from '../../common/services/sweet-alert.service';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { UserAuthService } from '../../common/services/user-auth.service';
import { FormBuilder, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { enviornment } from '../../../enviroment/enviroment';

@Component({
  selector: 'app-add-employee-details',
  standalone: true,
  imports: [CommonModule, RouterModule, HttpClientModule, ReactiveFormsModule, FormsModule],
  templateUrl: './add-employee-details.component.html',
  styleUrl: './add-employee-details.component.css'
})
export class AddEmployeeDetailsComponent {
  public apiUrl: string = '';

  public designations: any = [];
  public countries: any = [];
  public states: any = [];
  public districts: any = []
  public employeeDetailsStatus: boolean = false;
  public employeeDetails: FormGroup = this.formBuilder.group({

    employee_details: this.formBuilder.group({

      first_name: ['', Validators.compose([Validators.required])],
      last_name: ['', Validators.compose([Validators.required])],
      phone_no: ['', Validators.compose([Validators.required, Validators.pattern('^[1-9][0-9]{9}$')])],
      designation_id: [null, Validators.compose([Validators.required])],
      email: ['', Validators.compose([Validators.required, Validators.email])],
    }),
    address_details: this.formBuilder.group({

      permanent_address: this.formBuilder.group({
        country_id: [null, Validators.compose([Validators.required])],
        state_id: [null, Validators.compose([Validators.required])],
        district_id: [null, Validators.compose([Validators.required])],
        land_mark: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9A-Za-z]+$')])],
        house_name: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9A-Za-z]+$')])]
      }),
      current_address: this.formBuilder.group({

        country_id: [null, Validators.compose([Validators.required])],
        state_id: [null, Validators.compose([Validators.required])],
        district_id: [null, Validators.compose([Validators.required])],
        land_mark: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9A-Za-z]+$')])],
        house_name: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9A-Za-z]+$')])]
      })
    }),
    salary_details: this.formBuilder.group({
      earning: this.formBuilder.group({
        basic_pay: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9]+$')])],
        hra: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9]+$')])],
        cca: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9]+$')])],
      }),
      deduction: this.formBuilder.group({
        pt: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9]+$')])],
        it: ['', Validators.compose([Validators.required, Validators.pattern('^[0-9]+$')])],
      })
    })
  })






  constructor(
    private http: HttpClient,
    private router: Router,
    private sweetalert: SweetAlertServicesService,
    private userAuth: UserAuthService,
    private formBuilder: FormBuilder

  ) {
    this.apiUrl = enviornment.ApiUrl;
  }


  ngOnInit() {

    this.getMasterData();
  }

  public getMasterData() {

    this.http.get(this.apiUrl + 'get-master-data', { headers: this.userAuth.headers }).subscribe((res: any) => {

      if (res.status) {

        this.designations = res.data.designations
        this.countries = res.data.countries
        this.states = res.data.states;
        this.districts = res.data.districts;

      } else {
        this.sweetalert.ErrorMessage('Error', res.message)
      }
    },
      (err: any) => {
        this.sweetalert.ErrorMessage('Error', err.message)
      })
  }

  public addEmployee() {
    this.employeeDetailsStatus = false;
    if (this.employeeDetails.invalid) {
      this.employeeDetailsStatus = true;
      console.log(this.employeeDetailsStatus);
      console.log(this.employeeDetails.invalid)
      return;
    } else {
      this.employeeDetailsStatus = false;

    }

    console.log(this.employeeDetails.value);
    this.http.post(this.apiUrl + 'add-employee', this.employeeDetails.value, { headers: this.userAuth.headers }).subscribe((res: any) => {

      if (res.status) {
        this.sweetalert.SucessMessage('Sucess', res.message)
        this.router.navigate(['/home/all-employees-deatils']);
      } else {
        this.sweetalert.ErrorMessage('Error', res.message)
      }
    },
      (err: any) => {
        this.sweetalert.ErrorMessage('Error', err.message)
      })


  }


}
