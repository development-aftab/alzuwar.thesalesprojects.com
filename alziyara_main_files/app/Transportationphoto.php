<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportationphoto extends Model
{
    public $timestamps = false;
    public $table = "transportation_photos";
    public $primarykey = "PhotoID";
    protected $fillable = [
        "TransportationID",
        "PhotoTitle",
        "AltText",
        "PhotoLocation",
        "UploadedOn",
        "SortOrder",
        "DefaultFlag",
    ];
}
