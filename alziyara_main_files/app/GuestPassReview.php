<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestPassReview extends Model
{
    protected $table = 'guestpass_reviews';

    public $primarykey = "ReviewID";

    protected $fillable = [
        "GuestPassID",
	    "ReviewerName",
        "EmailAddress",
        "Rating",
        "Description",
        "IPAddress",
    ];

    public function getGuestPassReview(){

        return $this->belongsTo(GuestPass::class,'ReviewID','GuestPassID');
        
    }


}
