<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory;

    protected $fillable=[
        "destination",
        "mission",
        "user_id",
        "vehicle_id",
        "driver_id",
        "authorized_2commander",
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function driver(){
        return $this->belongsTo(Driver::class);
    }


}
