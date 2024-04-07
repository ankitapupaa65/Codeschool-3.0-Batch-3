<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

public static function getDistrictList(){

return District::select('id','district_name')->where('status',true)->get()->toArray();
}
}
