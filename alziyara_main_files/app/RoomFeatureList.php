<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use Illuminate\Http\Request;
use Storage;
class RoomFeatureList extends Model
{
//    use SoftDeletes;

    public $table = "roomsfeatureslist";

    public $primarykey = "id";

    protected $fillable = [
        "Title",
        "ImageIcon",
        "Description",
        "SortOrder"
    ];

    public function getFeatureIDAttribute(): int{
        return $this->id;
    }
    public function rooms()
    {
        return $this->belongsToMany('App\Room');
    }
}
