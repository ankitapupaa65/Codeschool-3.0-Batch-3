<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryComponentType extends Model
{
    use HasFactory;

const BASIC_PAY = 1;
const HRA=2;
const CCA = 3;
const PT = 4;
const IT = 5;
}
