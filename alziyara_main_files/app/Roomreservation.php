<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roomreservation extends Model
{
    protected $table = 'rooms_reservations';

    public $primarykey = "ReservationID";

    protected $fillable = [
        "PropertyID",
	    "ReceiptNum",
		"RoomID",
        "qty",
        "CreatedBy",
		"CreateDate",
		"checkin",
        "CreatedOn",
		"checkout",
        "ReservationForDate",
		"NotesByCustomer",
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

    public function getReservationOrdersproperty(){
		
		$userDetail = \Auth::user();
		
		return $this->hasOne(Property::class,'PropertyID','PropertyID')->where('PropertyCreatedBy',$userDetail->id);
        
    }
	
	public function getReservationOrdersroom(){
			
        return $this->hasOne(Room::class,'id','RoomID');
    
    }
	
	public function getRoomOrdersbyuser(){
			
        return $this->hasOne(User::class,'id','CreatedBy');
    
    }
	
	public function getRoomOrdersbyuserprofile(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	
	public function getRoomOrderssupadmin(){
		
		$userDetail = \Auth::user();
		
		return $this->hasMany(Property::class,'PropertyID','PropertyID');
        
    }
	
	public function getRoomOrdersbyusersupadmin(){
			
        return $this->hasOne(User::class,'id','CreatedBy');
    
    }
	
	public function getRoomOrdersbyuserprofilesupadmin(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	public function getRoomOrdersbyVendorsupadmin(){
			
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    
    }
	
	public function getcustomerorder(){
		
		return $this->hasOne(Room::class,'GuestPassID','GuestPassID');
		
	}
	
	public function getPropertyphoto(){

        return $this->hasOne(PropertyPhoto::class,'PropertyID','PropertyID')->where('DefaultFlag','1');

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

	public function getReservationOrderspropertycustomer(){

		// $userDetail = \Auth::user();

		return $this->hasOne(Property::class,'PropertyID','PropertyID');

    }
    public function getRoomDetails(){
        return $this->hasOne(Room::class,'id','RoomID');
    }

    public function getRoomtUserDetail(){
        return $this->hasOne(User::class,'id','CreatedBy');
    }
    public function getHotel(){
		return $this->hasOne(Property::class,'PropertyID','PropertyID');
    }
}
