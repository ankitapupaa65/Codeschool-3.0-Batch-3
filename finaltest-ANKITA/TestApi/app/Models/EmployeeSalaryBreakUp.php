<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryBreakUp extends Model
{
    use HasFactory;
public function employee()
    {
        return $this->belongsTo(EmployeeDetail::class,'id','employee_id');
    }
public function salaryType()
    {
        return $this->belongsTo(SalaryType::class);
    }
public function salaryComponetType()
    {
        return $this->belongsTo(SalaryComponentType::class,'salary_component_id','id');
    }

}
