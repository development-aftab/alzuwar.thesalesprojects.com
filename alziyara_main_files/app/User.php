<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\HasRoles;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

//class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','emailtoken','email_verify_status','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function permissionsList(){
        $roles = $this->roles;
        $permissions = [];
        foreach ($roles as $role){
            $permissions[] = $role->permissions()->pluck('name')->implode(',');
        }
       return collect($permissions);
    }

    public function permissions(){
        $permissions = [];
        $role = $this->roles->first();
        $permissions = $role->permissions()->get();
        return $permissions;
    }

    public function isAdmin(){
       $is_admin =$this->roles()->where('name','admin')->first();
       if($is_admin != null){
           $is_admin = true;
       }else{
           $is_admin = false;
       }
       return $is_admin;
    }

    public function guestpassuser(){
        
        return $this->belongsTo(GuestPass::class,'id','GuestPassCreatedBy');
    }

//    public function getVendorRoomReservations(){
//        return $this->hasMany(Roomreservation::class,'VehicleRouteID','VehicleRouteID');
//    }
//
//    public function getVendorRoomTotalSales(){
//        return Auth::user()->products->sum('price');
//    }
}
