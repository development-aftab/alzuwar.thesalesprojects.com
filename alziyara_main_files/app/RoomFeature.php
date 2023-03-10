<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Storage;
class RoomFeature extends Model
{
//    use SoftDeletes;

    public $table = "rooms_featuresxx";

    public $primarykey = "id";

    protected $fillable = [
        "RoomID",
        "FeatureID"
    ];
    public function getRoomFeature(){
        return $this->hasMany(RoomFeature::class,'RoomID','RoomID');
    }
}
