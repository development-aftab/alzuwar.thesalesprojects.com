<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Storage;
class BedType extends Model
{
//    use SoftDeletes;


    public $table = "bedtype";

    public $primarykey = "BedTypeID";

    protected $fillable = [
        "BedTypeDesc"
    ];
}
