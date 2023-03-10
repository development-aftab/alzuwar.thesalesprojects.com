<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestpassReservation extends Model
{
    protected $table = 'guestpass_reservations';
	protected $appends = ['donation_detail','insurance_detail'];

    public $primarykey = "ReservationID";

//    protected $fillable = [
//        "GuestPassID",
//	    "ReceiptNum",
//        "qty",
//        "CreatedBy",
//        "CreatedOn",
//        "ReservationForDate",
//		"NotesByCustomer",
//        "TotalPrice",
//		"Insurance",
//		"Donation",
//		"Donation_amount",
//        "BookingStatus",
//		"PaymentStatus",
//		"PaymentStatusComment",
//        "SPComments",
//        "SPCommentsDateTime",
//		"updated_at",
//		"created_at",
//		"customer_id",
//		"charge_id",
//		"reciept_url",
//		"reservation_status",
//		"transaction_id",
//		"TypeofPayment",
//		"DepositorName",
//		"DepositorEmail",
//		"DepositorNumber",
//		"ChequeNum",
//		"request_refund",
//		"request_refund_reply",
//		"request_refund_reply_comments",
//		"withdraw",
//		"withdraw_super_admin_comment",
//    ];

    protected $guarded= [];

    public function getGuestPassOrders(){
		
		$userDetail = \Auth::user();
		
		return $this->hasOne(GuestPass::class,'GuestPassID','GuestPassID')->where('GuestPassCreatedBy',$userDetail->id);
        
    }
    public function getGuestPass(){
		return $this->hasOne(GuestPass::class,'GuestPassID','GuestPassID');
    }

	public function getGuestPassOrdersbyuser(){
			
        return $this->hasOne(User::class,'id','CreatedBy');
    
    }
	
	public function getGuestPassOrdersbyuserprofile(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	
	public function getGuestPassOrderssupadmin(){
		
		$userDetail = \Auth::user();
		
		return $this->hasOne(GuestPass::class,'GuestPassID','GuestPassID');
        
    }
	
	public function getGuestPassOrdersbyusersupadmin(){
			
        return $this->hasOne(User::class,'id','CreatedBy');
    
    }
	
	public function getGuestPassOrdersbyuserprofilesupadmin(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	public function getGuestPassOrdersbyVendorsupadmin(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	public function getcustomerorder(){
		
		return $this->hasOne(GuestPass::class,'GuestPassID','GuestPassID');
		
	}
	
	public function getGuestPassDetailsphoto(){

        return $this->hasMany(GuestPassPhoto::class,'GuestPassID','GuestPassID')->where('DefaultFlag','1');

    }
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
//	public function getPaymentStatusAttribute()
//	{
//		if ($this->PaymentStatus == 'PAID') {
//			return "<span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>";
//		} else {
//			return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID<span>";
//		}//end if else.
//	}
//	public function getBookingStatusAttribute()
//	{
//
//		if ($this->BookingStatus == 'CONFIRMED' ) {
//			return "<span class='badge badge-success badge-sm' style='cursor:pointer'>CONFIRMED</span>";
//		} else {
//			return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNCONFIRMED<span>";
//		}//end if else.
//	}

}
