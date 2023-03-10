<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorTransportRoute extends Model
{
//    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendor_transport_routes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['VehicleRouteID', 'RouteID', 'Price', 'TwoWayPrice'];

    public function getTransportmainroute(){
        return $this->hasOne(TransportMainRoute::class,'RouteID','RouteID');
    }

}
