<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressDetail extends Model
{
    use HasFactory;
    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }
    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function state()
    {
        return $this->hasOne(State::class,'id','state_id');
    }
    public function district()
    {
        return $this->hasOne(District::class,'id','district_id');
    }
    public function employee()
    {
        return $this->belongsTo(District::class,'id','employee_id');
    }
}
