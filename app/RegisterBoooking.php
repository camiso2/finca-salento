<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterBoooking extends Model
{
    protected $table = "register_boookings";
    protected $fillable = [
        "timeEnter",
        "timeGetout",
        "personsQuantity",
        "observations",
        "email",
        "name",
        "phone",
        "advance",
        "user_id",

    ];
}
