<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Transportationroute extends Model
{
    public $table = "transportationtype_routes_price";
    public $primarykey = "VehicleRouteID";
    protected $fillable = [
        'VehicleRouteID',
        'TransportationOwnerID',
        'TransportationTypeID',
        'RouteID',
        'Price',
        'FeatureID',
        'NameofVehicle',
        'NumberPlate',
        'DriverName',
        'DriverContactNum',
        'Description',
        'FeaturesAndAmenities',
        'Type',
        'Status',
        'status_from_admin',
        'vendor_status'

    ];
    public function getTransportReview(){
        return $this->hasMany(Transportationreview::class,'VehicleRouteID','VehicleRouteID');
    }

    public function getTransportReviewForView(){
        return $this->hasMany(Transportationreview::class,'VehicleRouteID','VehicleRouteID')->where('Flag','1');
    }
    public function getTransportReviewAverage(){
        return $this->getTransportReview()->selectRaw('avg(Rating) as averageRating, VehicleRouteID')->groupBy('VehicleRouteID');
    }
    public function getTransportReviewAverageForView(){
        return $this->getTransportReview()->selectRaw('avg(Rating) as averageRating, VehicleRouteID')->groupBy('VehicleRouteID')->where('Flag','1');
    }
    public function getTransportReviewCount(){
        return $this->getTransportReview()->selectRaw('count(VehicleRouteID) as countReview, VehicleRouteID')->groupBy('VehicleRouteID');
    }
    public function getTransportReviewCountForView(){
        return $this->getTransportReview()->selectRaw('count(VehicleRouteID) as countReview, VehicleRouteID')->groupBy('VehicleRouteID')->where('Flag','1');
    }
    public function getTransporttype(){
        return $this->hasOne(Transportationtype::class,'TransportationTypeID','TransportationTypeID');
    }
    public function getTransportmainroute(){
        return $this->hasOne(TransportMainRoute::class,'RouteID','RouteID');
    }
    public function getTransportowner(){
        return $this->hasOne(Transportationonwer::class,'TransportationOwnerID','TransportationOwnerID');
    }
    public function getTransportDefaultPic(){
        return $this->hasOne(Transportationphoto::class,'TransportationID','VehicleRouteID')->where('DefaultFlag',1);
    }
    public function getTransportPics(){
        return $this->hasMany(Transportationphoto::class,'TransportationID','VehicleRouteID');
    }
	
	public function getTransportuser(){
        return $this->hasOne(User::class,'id','TransportationOwnerID');
    }
	
	public function getTransportuserprofile(){
        return $this->hasOne(Profile::class,'user_id','TransportationOwnerID');
    }
    public function getUserFavoriteProperties(){
        return $this->hasOne(PropertyFavorite::class,'property_id','VehicleRouteID')->where('user_id',Auth::id())->where('category_id',3);
    }
    public function getTransportRoutes(){
        return $this->hasMany(VendorTransportRoute::class,'VehicleRouteID','VehicleRouteID');
    }
}
