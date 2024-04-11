<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable=[
        "id",
        "description",
        "plate",
        "in_barracks",
        "military_unit_id",
        "is_active",

    ];



    function vehicle_log() {
        return $this->hasMany(VehicleLog::class);
    }

    public function military_unit(){
        return $this->belongsTo(MilitaryUnit::class);
    }
}
