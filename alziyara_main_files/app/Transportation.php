<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportation extends Model
{
//    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transportationtype_routes_price';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'VehicleRouteID';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['VehicleRouteID', 'TransportationOwnerID', 'TransportationTypeID', 'RouteID', 'Price','TwoWayPrice', 'FeatureID',
        'NameofVehicle', 'NumberPlate', 'DriverName', 'DriverContactNum', 'Description','FeaturesAndAmenities', 'Type', 'Status', 'status_from_admin',
        'vendor_status',
        "withdraw",
        "withdraw_super_admin_comment",];
//protected $guarded = ['VehicleRouteID', 'TransportationOwnerID', 'TransportationTypeID', 'RouteID', 'Price', 'FeatureID', 'NameofVehicle', 'NumberPlate', 'DriverName', 'DriverContactNum', 'Description', 'Type', 'Status'];
    public function getTransportPics(){
        return $this->hasMany(Transportationphoto::class,'TransportationID','VehicleRouteID');
    }
    public function getTransportmainroute(){
        return $this->hasOne(TransportMainRoute::class,'RouteID','RouteID');
    }
    public function getTransporttype(){
        return $this->hasOne(Transportationtype::class,'TransportationTypeID','TransportationTypeID');
    }
    public function getTransportDefaultPic(){
        return $this->hasOne(Transportationphoto::class,'TransportationID','VehicleRouteID')->where('DefaultFlag',1);
    }
    public function getTransportServiceProvider(){
        return $this->hasOne(User::class,'id','TransportationOwnerID');
    }
    public function getTransportRoutes(){
        return $this->hasMany(VendorTransportRoute::class,'VehicleRouteID','VehicleRouteID');
    }

}
