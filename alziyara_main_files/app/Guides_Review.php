<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guides_Review extends Model
{
    
    public $table = "guides_reviews";

    public $primarykey = "ReviewID";

    public $timestamps = false;

    protected $fillable = [
        "ReviewID",
        "GuidesID",
        "Name",
        "EmailAddress",
        "Rating",
        "Description",
        "IPAddress",
        "CreatedOn",
        "Flag"
    ];
}
