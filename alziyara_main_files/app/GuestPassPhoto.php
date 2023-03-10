<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestPassPhoto extends Model
{
    protected $table = 'guestpass_photos';

    public $primarykey = "PhotoID";

    protected $fillable = [
        "GuestPassID",
	    "PhotoTitle",
        "AltText",
        "PhotoLocation",
        "updated_at",
        "SortOrder",
        "DefaultFlag",
    ];
    
    public function getGuestPassDetails(){
        return $this->belongsTo(GuestPass::class,'PhotoID','GuestPassID');
    }

}
