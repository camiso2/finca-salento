<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterInvoice extends Model
{
    protected $table = "register_invoices";
    protected $fillable = [
        "clientOutput",
        "dayStay",
        "hourStay",
        "disscountClient",
        "observations",
        "numberInvoice",
        "state",
        "delete",
        "user_id",
        "debroom_id",

    ];
}
