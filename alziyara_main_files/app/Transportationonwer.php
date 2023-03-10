<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportationonwer extends Model
{
    public $table = "transportationowners";
    public $primarykey = "TransportationOwnerID";
    

    // public function getTransportDetails(){

    //     return $this->hasMany(Transportationphoto::class,'TransportationOwnerID','TransportationOwnerID');

    // }

    

    public function getGuestPassprogramDetails(){
        return $this->belongsTo(Transportationroute::class,'TransportationOwnerID','TransportationOwnerID');
    }
}
