<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilianLog extends Model
{
    use HasFactory;

    protected $fillable=[
        "hour_in",
        "hour_out",
        "names",
        "last_names",
        "activity",
        "userIn_id",
        "userOut_id",
        "transport"
    ];

    function userIn() {
        return $this->belongsTo(User::class);
    }

    function userOut() {
        return $this->belongsTo(User::class);
    }

}
