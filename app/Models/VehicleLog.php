<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLog extends Model
{
    use HasFactory;

    protected $fillable=[
        "departure_time",
        "entry_time",
        "departure_km",
        "entry_km",
        "observation",
        "userOut_id",
        "userIn_id",
        "pass_id",
    ];


    public function userOut(){
        return $this->belongsTo(User::class, 'userOut_id');
    }

    public function userIn(){
        return $this->belongsTo(User::class, 'userIn_id');
    }

    public function pass(){
        return $this->belongsTo(Pass::class);
    }


}
