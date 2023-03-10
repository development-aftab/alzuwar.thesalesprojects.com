<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class ManageSetting extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manage_settings';
    protected $appends = ['status_detail'];
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
    protected $fillable = ['user_id','product_category', 'package_deals_type_id', 'package_deals_name', 'package_deals_desc', 'package_deals_itinerary', 'package_deals_status', 'status_from_admin', 'price', 'max_occupancy', 'package_deals_time', 'package_deals_location', 'house_rules', 'display_on_home_page', 'sort_order', 'package_deals_create_by','package_available_from','package_available_to','accomodation','meal','transportation','location','airfare','total_stay','departure_place','guide','deadline'];

    public function getStatusDetailAttribute()
    {
        if ($this->package_deals_status == 1) {
            return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Active</span>";
        } else {
            return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>Inactive<span>";
        }//end if else.
    }
    public function getPackageDealsPhoto(){
        return $this->hasMany(PackageDealPhoto::class,'PackageDealsID','id')->where('DefaultFlag',0);
    }
    public function getPackageDealsDefaultPhoto(){
        return $this->hasOne(PackageDealPhoto::class,'PackageDealsID','id')->where('DefaultFlag',1);
    }
    public function getPackageDealsAllPhotos(){
        return $this->hasMany(PackageDealPhoto::class,'PackageDealsID','id');
    }
        public function getPackageDealsType(){
        return $this->hasOne(PackageDealType::class,'id','package_deals_type_id');
    }
    public function getPackageDealReviewDetails(){
        return $this->hasMany(PackageDealReview::class,'PackageDealsID','id');
    }

    public function getPackageReviewCount(){
        return $this->getPackageDealReviewDetails()->selectRaw('count(PackageDealsID) as countReview, PackageDealsID')->groupBy('PackageDealsID');
    }
    public function getPackageReviewAverage(){
        return $this->getPackageDealReviewDetails()->selectRaw('avg(Rating) as averageRating, PackageDealsID')->groupBy('PackageDealsID');
    }

    public function getPackageReviewForView(){
        return $this->hasMany(PackageDealReview::class,'PackageDealsID','id')->where('flag','1');
    }
    public function getPackageReviewAverageForView(){
        return $this->getPackageDealReviewDetails()->selectRaw('avg(Rating) as averageRating, PackageDealsID')->groupBy('PackageDealsID')->where('flag','1');
    }
    public function getPackageReviewCountForView(){
        return $this->getPackageDealReviewDetails()->selectRaw('count(PackageDealsID) as countReview, PackageDealsID')->groupBy('PackageDealsID')->where('flag','1');
    }
	
	public function getPackageUser(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function getUserFavoriteProperties(){
        return $this->hasOne(PropertyFavorite::class,'property_id','id')->where('user_id',Auth::id())->where('category_id',1);
    }

}
