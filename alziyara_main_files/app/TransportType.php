<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportType extends Model
{
//    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;

    protected $table = 'transportationtype';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'TransportationTypeID';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['TransportationTypeID', 'NumOfSeats', 'TransportationTypeDesc', 'LuggageCapacity'];

    
}
