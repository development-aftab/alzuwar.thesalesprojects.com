<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guides_photo extends Model
{
    public $table = "guides_photos";

    public $primarykey = "PhotoID";

    public $timestamps = false;

    protected $fillable = [
        "GuidesID",
	    "PhotoTitle",
        "AltText",
        "PhotoLocation",
        "updated_at",
        "SortOrder",
        "DefaultFlag",
    ];

    public function getGuideDetails(){

        return $this->belongsTo(Guide::class,'PhotoID','GuidesID');
        
    }

}
