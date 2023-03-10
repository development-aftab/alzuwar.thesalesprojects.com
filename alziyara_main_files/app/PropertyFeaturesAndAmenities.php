<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Storage;
class PropertyFeaturesAndAmenities extends Model
{
//    use SoftDeletes;

    public $table = "property_features_and_amenities";

    public $primarykey = "id";

    protected $fillable = [
        "propertyID",
        "generl",
        "food_and_drink",
        "front_desk_services",
        "entertainment_and_family_services",
        "living_area",
        "health_facility",
        "safety_and_security",
        "bussiness_facility",
        "accessibility",
        "languages_spoken",
        "cleaning_service"
    ];

}
