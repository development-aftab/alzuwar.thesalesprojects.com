<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Storage;
class PropertyReview extends Model
{
//    use SoftDeletes;
    public $timestamps = false;
    public $table = "property_reviews";

    public $primarykey = "ReviewID";

    protected $fillable = [
        "PropertyID",
        "Name",
        "EmailAddress",
        "Rating",
        "Description",
        "ReviewOn",
        "IPAddress",
        "Flag",
    ];

}
