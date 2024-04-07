import { Injectable } from '@angular/core';
import Swal from 'sweetalert2';
@Injectable({
  providedIn: 'root'
})
export class SweetAlertServicesService {

  constructor() { }
  public SucessMessage(title: any = "Sucess", text: string = "") {
    Swal.fire({
      title: title,
      text: text,
      icon: "success"
    });

  }
  public ErrorMessage(title: any = "Error", text: string = "") {
    Swal.fire({
      title: title,
      text: text,
      icon: "error"
    });

  }

  public confirmDelete(deletefunction?: () => void) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed && deletefunction) {
       deletefunction()
      }
    });
  }
}
