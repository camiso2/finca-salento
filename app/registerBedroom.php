<?php

namespace App;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Model;

class registerBedroom extends Model
{
    protected $table = "register_bedrooms";
    protected $fillable = [
        "airConditioning",
        "bedQuantity",
        "cooling",
        "dayRoomCost",
        "furniture",
        "fileImage",
        "internet",
        "jacuzzi",
        "name",
        "privateBathroom",
        "roomWindow",
        "rradio",
        "telephoneService",
        "tv",
        "typeBedrooms",
        "user_id",
        "delete",
        "state",
        "codeRoom",
        "occupation",
    ];

     /**
     * Get all data bedrooms
     *
     * @param $query
     */
    public function scopeListBedroomsAll($query)
    {
        $query->orderBy('id', 'DESC');
    }
}
