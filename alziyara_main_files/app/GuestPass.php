<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class GuestPass extends Model
{
    public $table = "guestpass";
    public $primarykey = "GuestPassID";

    protected $fillable = [
        "GuestPassName",
	    "GuestPassDesc",
        "GuestPassItinerary",
        "GuestPassStatus",
        "Price",
        "MaxOccupancy",
        "GuestPassTime",
		"Admin_status",
        "GuestPassLocation",
        "HouseRules",
	    "created_at",
	    "updated_at",
        "ScheduleDays",
        "DisplayOnHomePage",
        "SortOrder",
        "GuestPassCreatedBy",
    ];
//    public static function guestspassdata() {
//        // $allguestdata =  DB::table('guestpass as g')
//        // ->join('guestpass_photos as gp','g.GuestPassID','=','gp.GuestPassID')
//        // ->join('guestpass_reviews as gr','g.GuestPassID','=','gr.GuestPassID')
//        // ->select(DB::raw('(SUM(gr.Rating)/COUNT(gr.GuestPassID)) as ratingavg'),'gp.PhotoTitle','gp.AltText','gp.PhotoLocation','g.*')
//        // ->groupby('gr.GuestPassID')
//        // ->get();
//        $allguestdata =  DB::table('guestpass as g')
//        ->join('guestpass_photos as gp','g.GuestPassID','=','gp.GuestPassID')
//        ->select('gp.PhotoTitle','gp.AltText','gp.PhotoLocation','g.*')
//        ->groupby('g.GuestPassID')
//        ->get();
//        // dd($allguestdata);
//        return $allguestdata;
//    }
//    public static function singleguestspass($id){
//        $guestpassdata =  DB::table('guestpass as g')
//        ->join('guestpass_photos as gp','g.GuestPassID','=','gp.GuestPassID')
//        ->select('gp.PhotoTitle','gp.AltText','gp.PhotoLocation','g.*')
//        ->where('g.GuestPassID','=',$id)
//        ->get();
//        return $guestpassdata;
//    }

    public function getGuestPassDetails(){
        return $this->hasMany(GuestPassPhoto::class,'GuestPassID','GuestPassID');
    }
    public function getGuestPassDefaultPic(){
        return $this->hasOne(GuestPassPhoto::class,'GuestPassID','GuestPassID')->where('DefaultFlag',1);
    }
    public function getGuestPassprogramDetails(){
        return $this->hasMany(Guestdpassprogramdetail::class,'GuestPassID','GuestPassID');
    }

    public function getGuestPassreviewdetails(){
        return $this->hasMany(GuestPassReview::class,'GuestPassID','GuestPassID');
    }

    public function getGuestPassReviewCount(){
        return $this->getGuestPassreviewdetails()->selectRaw('count(GuestPassID) as countReview, GuestPassID')->groupBy('GuestPassID');
    }

    public function getGuestPassreviewAverage(){
        return $this->getGuestPassreviewdetails()->selectRaw('avg(rating) as averageRating, GuestPassID')->groupBy('GuestPassID');
    }

    public function guestpassbyuser(){
        return $this->hasOne(User::class,'id','GuestPassCreatedBy');
    }

    public function getGuestPassUser(){
        return $this->hasOne(User::class,'id','GuestPassCreatedBy');
    }

	public function getGuestPassReserveOrder(){

        return $this->hasOne(GuestpassReservation::class,'GuestPassID','GuestPassID');
    }

    public function getUserFavoriteProperties(){
        return $this->hasOne(PropertyFavorite::class,'property_id','GuestPassID')->where('user_id',Auth::id())->where('category_id',4);
    }


}
