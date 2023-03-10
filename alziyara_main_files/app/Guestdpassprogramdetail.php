<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guestdpassprogramdetail extends Model
{
    protected $table = 'guestpass_programdetails';

    public $primarykey = "GuestProDetail_id";

    protected $fillable = [
        "GuestPassID",
	    "GuestProDetailTime",
        "GuestProDetailDis",
        "created_at",
        "updated_at",
    ];


    public function getGuestPassprogramDetails(){
        return $this->belongsTo(GuestPass::class,'GuestProDetail_id','GuestPassID');
    }

}
