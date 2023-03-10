<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\PackageDealPhoto;

class Search extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'searches';
    protected $appends = ['donation_detail','insurance_detail'];

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'receipt_num',
        'package_deals_id',
        'qty', 'created_by',
        'reservation_for_date',
        'package_insurance',
        'package_donation',
        'donation_shrine_name',
        'package_donation_amount',
        'notes_by_customer',
        'total_price',
        'booking_status',
        'payment_status',
        'sp_comments',
        'sp_comments_date_time',
        'created_at','updated_at',
        'deleted_at',
        'customer_id',
        'charge_id',
        'reciept_url',
        'reservation_status',
        "transaction_id","TypeofPayment",
		"DepositorName",
		"DepositorEmail",
		"DepositorNumber",
		"ChequeNum",
        "request_refund",
        "request_refund_date",
        "request_refund_reply",
        "request_refund_reply_comments",
        "withdraw",
        "withdraw_super_admin_comment",];
    public function getDonationDetailAttribute()
    {
        if ($this->package_donation == 1) {
            return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Yes</span>";
        } else {
            return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>No<span>";
        }//end if else.
    }
    public function getInsuranceDetailAttribute()
    {
        if ($this->package_insurance == 1) {
            return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Yes</span>";
        } else {
            return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>No<span>";
        }//end if else.
    }
    
    public function getProfileDetails(){
        return $this->hasOne(Profile::class,'user_id','user_id');
    }
    public function getPackageDealsOrderDetail(){
        return $this->hasOne(ManageSetting::class,'id','package_deals_id');
    }
    public function getPackageDealsUserDetail(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function getUserDetail(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function getPackagephotos(){
        return $this->hasOne(PackageDealPhoto::class,'packageDealsID','package_deals_id')->where('DefaultFlag','1');
    }
}
