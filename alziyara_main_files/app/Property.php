<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\User;
class Property extends Model
{
//    use SoftDeletes;

    public $table = "property";

    public $primarykey = "PropertyID";

    protected $fillable = [
        "Productcategory",
        "Name",
        "PropertyTypeID",
        "Address",
        "City",
        "Province",
        "PostalCode",
        "Country",
        "Description",
        "Published",
        "HouseRules",
		"PropertyShuttle",
		"PropertyDistance",
		"PropertyCreatedBy",
        "created_at",
		"updated_at"
    ];
//    public function getHotelPic(){
//        return $this->hasOne(PropertyPhoto::class,'PropertyID','PropertyID')->where('DefaultFlag','1');
//    }
    public function getHotelPics(){
        return $this->hasMany(PropertyPhoto::class,'PropertyID','PropertyID');
    }
    public function getHotelDefaultPhoto(){
        return $this->hasOne(PropertyPhoto::class,'PropertyID','PropertyID')->where('DefaultFlag',1);
    }
    public function getRooms(){
        return $this->hasMany(Room::class,'PropertyId','PropertyID');
    }
    public function getMinPriceRooms(){
        return $this->hasOne(Room::class,'PropertyId','PropertyID')->orderBy('price','ASC');
    }
    public function getHotelReview(){
        return $this->hasMany(PropertyReview::class,'PropertyID','PropertyID')->where('Flag',1);
    }
    public function getHotelreviewdetails(){
        return $this->hasMany(PropertyReview::class,'PropertyID','PropertyID');
    }
    public function getHotelReviewAverage(){
        return $this->getHotelreviewdetails()->selectRaw('avg(Rating) as averageRating, PropertyID')->groupBy('PropertyID');
    }
    public function getHotelReviewCount(){
        return $this->getHotelReview()->selectRaw('count(PropertyID) as countReview, PropertyID')->groupBy('PropertyID');
    }
    public function getHotelFeaturesAndAmenities(){
        return $this->hasOne(PropertyFeaturesAndAmenities::class,'propertyID','PropertyID');
    }
    public function getUserFavoriteProperties(){
        return $this->hasOne(PropertyFavorite::class,'property_id','PropertyID')->where('user_id',Auth::id())->where('category_id',2);
    }
//    public function roomFeatureList()
//    {
//        return $this->belongsToMany('App\RoomFeatureList','rooms_featuresxx','RoomID','FeatureID');
//    }

	public function getUserofProperty(){
        return $this->hasOne(User::class,'id','PropertyCreatedBy');
    }
}