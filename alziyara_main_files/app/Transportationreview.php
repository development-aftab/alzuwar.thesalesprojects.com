<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportationreview extends Model
{
    public $timestamps = false;
    public $table = "transportation_reviews";
    public $primarykey = "ReviewID";

    protected $fillable = [
        "VehicleRouteID",
        "Name",
        "EmailAddress",
        "Rating",
        "Description",
        "ReviewOn",
        "IPAddress",
        "Flag"
    ];

}
