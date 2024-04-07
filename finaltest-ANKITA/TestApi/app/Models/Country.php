<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

public static function getCountryList(){
return Country::select('id','country_name')->where('status',true)->get()->toArray();
}
}
