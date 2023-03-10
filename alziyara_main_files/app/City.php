<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	
	public $table = "city";
    public $primarykey = "id";
	
	protected $fillable = [
	    "GuestPassLocation",
        "citystatus",
        "created_at",
        "updated_at",
    ];
	
	
    
}