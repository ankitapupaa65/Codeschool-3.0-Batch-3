<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
CONST MANAGER=1;
CONST TECHLEAD=2;
CONST DEVEOLPER=3;

public static function getDesignation(){

return Designation::select('id','designation_name')->where('status',true)->get()->toArray();
}

}
