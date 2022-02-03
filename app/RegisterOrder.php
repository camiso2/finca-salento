<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterOrder extends Model
{
    protected $table = "register_orders";
    protected $fillable = [
        "selectedBedroom",
        "order",
        "valueOrder",
        "state",
        "delete",
        "user_id",
        "debroom_id",

    ];
}
