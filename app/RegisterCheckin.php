<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterCheckin extends Model
{


    protected $table = "register_checkins";
    protected $fillable = [
        "timeEnter",
        "timeGetout",
        "name",
        "personsQuantity",
        "observations",
        "email",
        "typeIdent",
        "identClient",
        "phone",
        "advance",
        "nationalitySelected",
        "selectedBedroom",
        "state",
        "delete",
        "user_id",
        "debroom_id",

    ];

}
