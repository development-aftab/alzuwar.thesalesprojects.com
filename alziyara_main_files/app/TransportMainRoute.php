<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportMainRoute extends Model
{
    public $table = "transportation_routes";
    public $primarykey = "RouteID";

    protected $fillable = [
        "RouteID",
	    "RouteName",
        "RouteFrom",
        "RouteTo",
        "Distance",
        "DrivingTime",
    ];

//    public function gettransportroute(){
//
//        return $this->belongsTo(Transportationroute::class,'RouteID','VehicleRouteID');
//
//    }
}
