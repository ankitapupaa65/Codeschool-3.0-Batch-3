<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

public static function getStateList(){

 return State::select('id','state_name')->where('status',true)->get()->toArray();
}
}
