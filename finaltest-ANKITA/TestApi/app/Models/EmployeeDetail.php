<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;

    public function status()
    {

        return $this->hasOne(EmployeeStatus::class, 'id', 'employee_status_id');
    }
    public function designation()
    {

        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }
    // In EmployeeDetail model
    public function salary()
    {
        return $this->hasMany(EmployeeSalaryBreakUp::class ,'employee_id','id');
    }
    public function address()
    {
        return $this->hasMany(AddressDetail::class,'employee_id','id');
    }
}
