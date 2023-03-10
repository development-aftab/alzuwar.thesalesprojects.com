<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDealReview extends Model
{
    protected $table = 'packagedeals_reviews';

    public $primarykey = "ReviewID";

    protected $fillable = [
        "PackageDealsID",
        "ReviewerName",
        "EmailAddress",
        "Rating",
        "Description",
        "IPAddress",
        "flag",
    ];

    public function getPackageDealReview(){

        return $this->belongsTo(PackageDealReview::class,'ReviewID','PackageDealsID');

    }


}
