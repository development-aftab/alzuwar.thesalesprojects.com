<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportRoute extends Model
{
//    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;

    protected $table = 'transportation_routes';
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'RouteID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['RouteID', 'RouteName', 'RouteFrom', 'RouteTo', 'Distance', 'DrivingTime', 'PickupDateTime'];

    
}
