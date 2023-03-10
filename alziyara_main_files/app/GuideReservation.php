<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuideReservation extends Model
{
    protected $table = 'guides_reservations';
	protected $appends = ['donation_detail','insurance_detail'];

    public $primarykey = "ReservationID";

    protected $fillable = [
        "GuidesID",
	    "ReceiptNum",
        "qty",
        "CreatedBy",
        "CreateDate",
        "ReservationForDate",
		"NotesByCustomer",
		"reservation_start_date",
		"reservation_end_date",
        "TotalPrice",
		"Insurance",
		"Donation",
		"donation_shrine_name",
		"Donation_amount",
        "BookingStatus",
		"PaymentStatus",
        "SPComments",
        "SPCommentsDateTime",
		"updated_at",
		"created_at",
		"customer_id",
		"charge_id",
		"reciept_url",
		"reservation_status",
		"transaction_id",
		"TypeofPayment",
		"DepositorName",
		"DepositorEmail",
		"DepositorNumber",
		"ChequeNum",
		"request_refund",
        "request_refund_date",
		"request_refund_reply",
		"request_refund_reply_comments",
    ];

    public function getGuideOrders(){
		
		$userDetail = \Auth::user();
		
		return $this->hasOne(Guide::class,'GuidesID','GuidesID')->where('GuidesCreatedBy',$userDetail->id);
        
    }
	
	public function getGuidebyuser(){
			
        return $this->hasOne(User::class,'id','CreatedBy');
    
    }
	
	public function getGuidebyuserprofile(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	
	public function getGuideOrderssupadmin(){
		
		// $userDetail = \Auth::user();
		
		return $this->hasOne(Guide::class,'GuidesID','GuidesID');
        
    }
	
	public function getGuideOrdersbyusersupadmin(){
			
        return $this->hasOne(User::class,'id','CreatedBy');
    
    }
	
	public function getGuideOrdersbyuserprofilesupadmin(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	public function getGuideOrdersbyVendorsupadmin(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	public function getcustomerorder(){
		
		return $this->hasOne(Guide::class,'GuidesID','GuidesID');
		
	}
	
	public function getGuideDetailsphoto(){

        return $this->hasOne(Guides_photo::class,'GuidesID','GuidesID')->where('DefaultFlag','1');

    }
	public function getDonationDetailAttribute()
	{
		if ($this->Insurance == 1) {
			return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Yes</span>";
		} else {
			return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>No<span>";
		}//end if else.
	}
	public function getInsuranceDetailAttribute()
	{
		if ($this->Donation == 1) {
			return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Yes</span>";
		} else {
			return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>No<span>";
		}//end if else.
	}
    public function getGuidesUserDetail(){
        return $this->hasOne(User::class,'id','CreatedBy');
    }


	public function getGuideDetails(){

		return $this->hasOne(Guide::class,'GuidesID','GuidesID');

	}

}
