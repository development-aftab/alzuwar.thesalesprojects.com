<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Http\Request;
use Storage;
use App\BedType;use App\Property;
class Room extends Model
{
//    use SoftDeletes;

    public $table = "rooms";

    public $primarykey = "id";

    protected $fillable = [
        "RoomName",
        "RoomStatus",
        "PropertyId",
        "Price",
        "RoomType",
        "QtyOfBed",
        "BedTypeID",
        "MaxOccupancy",
        "RoomFeatures",
        "RoomImage"
    ];
    public function getBedType(){
        return $this->hasOne(BedType::class,'BedTypeID','BedTypeID');
    }
//    public function getRoomFeature(){
////        return $this->hasMany('App\RoomFeatureList', 'RoomID','FeatureID');
////        return $this->belongsToMany('App\RoomFeature','id','id','');
//        return $this->hasMany(RoomFeature::class,'RoomID','id');
////        return $this->belongsToMany(RoomFeatureList::class,'roomsfeatureslist')->withPivot('last_read');
//    }

   public function gethotelrooms()
   {		$userDetail = \Auth::user();
		return $this->hasOne(Property::class,'PropertyID','PropertyId');
   }
    public function roomFeatureList()
    {
        return $this->belongsToMany('App\RoomFeatureList','rooms_featuresxx','RoomID','FeatureID');
    }		// public function myroomfeature(){				// return this->belongsToMany('','',''); 	// }

    public function getHotelRoomDetails()
    {
        return $this->hasOne(Property::class,'PropertyID','PropertyId');
    }

}
