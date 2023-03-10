<?php

namespace App\Http\Controllers;

use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use App\GuideReservation;
use Auth;
use App\Guid;
class GuideController extends Controller
{
    public function guidereservation(){
		$guidID = Guid::where('GuidesCreatedBy',Auth::id())->pluck('GuidesID');
		$bookings = GuideReservation::where('request_refund_reply','!=','Refunded')->orWhereNull('request_refund_reply');
		$bookings = $bookings->whereIn('GuidesID',$guidID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
		$guide = GuideReservation::where('request_refund_reply','!=','Refunded')->orWhereNull('request_refund_reply');
		$guide = $guide->whereIn('GuidesID',$guidID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();

		$mytotalprice = 0;
		foreach($guide as $guides) {
			if ($guides->Insurance == 1 && $guides->Donation == 0){
				$totalprice = $guides->TotalPrice - 10;
			}elseif($guides->Insurance == 0 && $guides->Donation == 1){
				$totalprice = $guides->TotalPrice - $guides->Donation_amount;
			}elseif(($guides->Insurance == 1 && $guides->Insurance == 1)){
				$totalprice = $guides->TotalPrice - $guides->Donation_amount-10;
			}else{
				$totalprice = $guides->TotalPrice;
			}
			$mytotalprice +=  $totalprice;
		}
		$guidewithdraw = GuideReservation::where('request_refund_reply','!=','Refunded');
		$guidewithdraw = $guidewithdraw->where('withdraw','!=',1)->orWhereNull('request_refund_reply');
		$guidewithdraw = $guidewithdraw->whereIn('GuidesID',$guidID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
		$myTotalPrice = 0;
		foreach ($guidewithdraw as $guides) {
			if ($guides->Insurance == 1 && $guides->Donation == 0) {
				$totalprice = $guides->TotalPrice - 10;
			} elseif ($guides->Insurance == 0 && $guides->Donation == 1) {
				$totalprice = $guides->TotalPrice - $guides->Donation_amount;
			} elseif (($guides->Insurance == 1 && $guides->Insurance == 1)) {
				$totalprice = $guides->TotalPrice - $guides->Donation_amount - 10;
			} else {
				$totalprice = $guides->TotalPrice;
			}
			$myTotalPrice += $totalprice;
		}
		$spEarningWithdraw = number_format($myTotalPrice/ 100 * 80??'0', 2, '.', ',');
		$spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
		$guidereservesstats = GuideReservation::with('getGuideOrderssupadmin')->whereIn('GuidesID',$guidID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
		$guidereserves = GuideReservation::with('getGuideOrderssupadmin')->whereIn('GuidesID',$guidID)->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
		return view('guid.guid.guidereservation',compact('guidereserves','guidereservesstats','mytotalprice','bookings','spEarning','spEarningWithdraw'));


	}
	
	public function guidereserveone($id){
		
		// dd($id);
		
		$guidereserves = GuideReservation::with('getGuideOrders','getGuidebyuser','getGuidebyuserprofile')->where('ReceiptNum',$id)->first();
		
		// dd($guestpassreserves);
		
		return view('guid.guid.guidereservation_detail',compact('guidereserves'));
		
	}

	public function myguidebooking()
	{
		if (auth()->user()->hasrole('GuideAdmin')) {
			$GuidesID = Guid::where('GuidesCreatedBy',Auth::id())->pluck('GuidesID');
			$guidebooking = GuideReservation::whereIn('GuidesID',$GuidesID)->with('getGuideOrderssupadmin')->groupBy('ReceiptNum')->get();
			return view('superadminviews.guidecalender', compact('guidebooking'));
		}
	}
}
