<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Storage;
class PropertyPhoto extends Model
{
//    use SoftDeletes;

    public $table = "property_photos";

    public $primarykey = "PhotoID";

    protected $fillable = [
        "PropertyID",
        "PhotoTitle",
        "AltText",
        "PhotoLocation",
        "UploadedOn",
        "SortOrder",
        "DefaultFlag",
    ];

}
