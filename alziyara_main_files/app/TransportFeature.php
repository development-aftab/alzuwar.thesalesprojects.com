<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportFeature extends Model
{
//    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;

    protected $table = 'vehiclesfeatureslist';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'FeatureID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['FeatureID', 'Title', 'ImageIcon', 'Description', 'SortOrder'];

    
}
