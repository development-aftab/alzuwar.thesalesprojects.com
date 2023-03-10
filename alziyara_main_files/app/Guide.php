<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Guide extends Model
{
    public $table = "guides";

    public $primarykey = "GuidesID";

    protected $fillable = [
        "GuidesName",
	    "GuidesDesc",
        "GuidesItinerary",
        "GuidesStatus",
        "PricePerDay",
        "MaxOccupancy",
        "GuidesLocation",
        "HouseRules",
        "created_at",
	    "updated_at",
	    "DisplayOnHomePage",
        "SortOrder",
        "GuidesCreatedBy",
        "Languages",
    ];

    public function getGuideReview(){
        return $this->hasMany(Guides_Review::class,'GuidesID','GuidesID');
    }
    public function getGuideReviewForView(){
        return $this->hasMany(Guides_Review::class,'GuidesID','GuidesID')->where('Flag','1');
    }
    public function getGuideReviewAverage(){
        return $this->getGuideReview()->selectRaw('avg(Rating) as averageRating, GuidesID')->groupBy('GuidesID');
    }
    public function getGuideReviewAverageForView(){
        return $this->getGuideReview()->selectRaw('avg(Rating) as averageRating, GuidesID')->groupBy('GuidesID')->where('Flag','1');
    }
    public function getGuideReviewCount(){
        return $this->getGuideReview()->selectRaw('count(GuidesID) as countReview, GuidesID')->groupBy('GuidesID');
    }
    public function getGuideReviewCountForView(){
        return $this->getGuideReview()->selectRaw('count(GuidesID) as countReview, GuidesID')->groupBy('GuidesID')->where('Flag','1');
    }
    public function getGuideOwner(){
        return $this->hasOne(User::class,'id','GuidesCreatedBy');
    }
    public function getGuideDefaultPic(){
        return $this->hasOne(Guides_photo::class,'GuidesID','GuidesID')->where('DefaultFlag',1);
    }
    public function getGuidePics(){
        return $this->hasMany(Guides_photo::class,'GuidesID','GuidesID');
    }
	
	public function getguideUser(){
        return $this->hasOne(User::class,'id','GuidesCreatedBy');
    }
    public function getUserFavoriteProperties(){
        return $this->hasOne(PropertyFavorite::class,'property_id','GuidesID')->where('user_id',Auth::id())->where('category_id',5);
    }
}
