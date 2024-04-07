import { Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';
import { HomeContentComponent } from './home/home-content/home-content.component';
import { AddEmployeeDetailsComponent } from './home/add-employee-details/add-employee-details.component';
import { EmployeeDetailsComponent } from './home/employee-details/employee-details.component';
import { AllEmployeeDetailsComponent } from './home/all-employee-details/all-employee-details.component';

export const routes: Routes = [

    { path: '', redirectTo: '/login', pathMatch: 'full' },
    { path: 'login', component: LoginComponent }
    , {
        path: 'home', component: HomeComponent, children:
            [{ path: '', component: HomeContentComponent }
                , { path: 'add-employee', component: AddEmployeeDetailsComponent }
                , { path: 'all-employees-deatils', component: AllEmployeeDetailsComponent }
                , { path: ':employeeId', component: EmployeeDetailsComponent }]
    }

];
