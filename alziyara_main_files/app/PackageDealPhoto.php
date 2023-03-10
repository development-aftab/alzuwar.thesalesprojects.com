<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDealPhoto extends Model
{
    protected $table = 'packagedeals_photos';

    public $primarykey = "PhotoID";

    protected $fillable = [
        "PackageDealsID",
        "PhotoTitle",
        "AltText",
        "PhotoLocation",
        "SortOrder",
        "DefaultFlag",
    ];

    public function getPackageDealsDetails(){
        return $this->belongsTo(PackageDeals::class,'PhotoID','PackageDealsID');
    }

}
