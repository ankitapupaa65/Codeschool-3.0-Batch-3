import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'fiterEmployeePipe',
  standalone: true
})
export class FiterEmployeePipePipe implements PipeTransform {



 transform(employee: any[], searchItem: string): any[] {
    if (!employee || !searchItem) {
      return employee;
    }
    return employee.filter(employee => employee.first_name.includes(searchItem));
 
   
  }
}
