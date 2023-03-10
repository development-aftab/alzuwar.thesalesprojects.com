<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportationtype extends Model
{
    
    protected $table = 'transportationtype';

    public $primarykey = "TransportationTypeID";

    protected $fillable = [
        "TransportationTypeID",
	    "NumOfSeats",
        "TransportationTypeDesc",
        "LuggageCapacity",
    ];


}
