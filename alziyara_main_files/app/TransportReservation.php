<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportReservation extends Model
{
    protected $table = 'vehicles_reservations';
    protected $appends = ['donation_detail','insurance_detail'];

    public $primarykey = "ReservationID";

    protected $fillable = [
        "ReceiptNum",
        "RouteID",
        "TransportationOwnerID",
        "TransportationTypeID",
        "VehicleRouteID",
        "noofdaysqty",
        "CreatedBy",
        "CreateDate",
        "PickUpDateTime",
        "DropOffDateTime",
        "ReservationStatus",
        "triptype",
        "PickupLocation",
        "DropOffLocation",
        "NotesByCustomer",
        "TotalPrice",
        "NumberPlate",
        "Insurance",
        "Donation",
        'donation_shrine_name',
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

    public function getTransportOrders(){
        $userDetail = \Auth::user();
        return $this->hasOne(Transportationroute::class,'VehicleRouteID','VehicleRouteID')->where('TransportationOwnerID',$userDetail->id);
    }

    public function getTransportOrdersbyuser(){
        return $this->hasOne(User::class,'id','CreatedBy');
    }

    public function getTransportVendorDetail(){
        return $this->hasOne(User::class,'id','TransportationOwnerID');
    }

    public function gettransportroute(){
        return $this->hasOne(User::class,'RouteID','CreatedBy');
    }

    public function getTransportOrdersbyuserprofile(){
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    }

    public function getTransportmainrouteforreservation(){
        return $this->hasOne(TransportMainRoute::class,'RouteID','RouteID');
    }

    public function getTransportOrderssupadmin(){
        $userDetail = \Auth::user();
        return $this->hasOne(Transportationroute::class,'VehicleRouteID','VehicleRouteID');
    }
    public function getTransportOrdersbyusersupadmin(){
        return $this->hasOne(User::class,'id','CreatedBy');
    }

    public function getTransportOrdersbyuserprofilesupadmin(){
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    }

    public function getTransportOrdersbyVendorsupadmin(){
        return $this->hasOne(Profile::class,'user_id','CreatedBy');
    }

    public function getcustomerorder(){

		return $this->hasOne(Transportationroute::class,'VehicleRouteID','VehicleRouteID');

    }

    public function gettransportDetailsphoto(){
        return $this->hasOne(Transportationphoto::class,'TransportationID','VehicleRouteID')->where('DefaultFlag','1');
    }

    public function getDonationDetailAttribute()
    {
        if ($this->Donation == 1) {
            return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Yes</span>";
        } else {
            return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>No<span>";
        }//end if else.
    }

    public function getInsuranceDetailAttribute()
    {
        if ($this->Insurance == 1) {
            return "<span class='badge badge-success badge-sm' style='cursor:pointer'>Yes</span>";
        } else {
            return "<span class='badge badge-danger badge-sm' style='cursor:pointer'>No<span>";
        }//end if else.
    }

    public function getTransportUserDetail(){
        return $this->hasOne(User::class,'id','CreatedBy');
    }
    public function getTransportRoutes(){
        return $this->hasOne(VendorTransportRoute::class,'VehicleRouteID','VehicleRouteID');
    }

}
