<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guid extends Model
{
//    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;

    protected $table = 'guides';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'GuidesID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['GuidesID', 'Productcategory', 'GuidesName', 'GuidesDesc', 'GuidesItinerary', 'Admin_status', 'userstatus', 'GuidesStatus', 'PricePerDay', 'MaxOccupancy', 'GuidesLocation', 'GuidePhoneno', 'guide_startdate', 'guide_enddate', 'guide_deadlinedate', 'HouseRules', 'DisplayOnHomePage', 'SortOrder', 'GuidesCreatedBy', 'Languages'];

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
    
}
