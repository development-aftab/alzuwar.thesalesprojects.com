<?php

namespace App\Http\Controllers;
use DB;
use App\GuestPass;
use App\GuestPassReview;
use App\GuestPassPhoto;
use App\Guestdpassprogramdetail;
use App\GuestpassReservation;
use App\City;
use App\User;
use App\Transportation;
use App\Roomreservation;
use App\Property;
use App\TransportReservation;
use App\ManageSetting;
use App\Search;
use App\GuideReservation;
use App\PropertyType;
use App\VendorTransportRoute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
class SuperAdminController extends Controller
{
    public function allguestpasses(){

        $guestPass = GuestPass::with('getGuestPassDetails')->orderBy('Price', 'DESC')->get();

        return view('website.allguestpasses',compact('guestPass'));

    }

    public function guestpassstatusupdate($id,$status){

        // dd($id,$status);

        if($status == 'active'){

            $mystatus = 'Active';

        }elseif($status == 'notactive'){

            $mystatus = 'NotActive';

        }elseif($status == 'Draft'){

            $mystatus = 'Draft';

        }else{

            $mystatus = 'NotActive';

        }


        if($mystatus || $mystatus == 0 ){


            // dd($mystatus);

            $match = GuestPass::where('GuestPassID',$id)
                ->update([
                    'Admin_status'=> $mystatus,
                ]);


            // dd($match);


        }


        // return redirect('/allguestpasses');

    }

    public function showguestpass($id){

        $guestPass = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails','guestpassbyuser')->where('GuestPassID',$id)->first();

        // return $guestPass;

        return view('website.guestpassdetail',compact('guestPass'));

    }

    public function allguestpassreservation(){
        $bookings = GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID');
        $bookings = $bookings->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
        $guestpass = GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum');
        $guestpass = $guestpass->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->get();
        $mytotalprice = 0;
        foreach($guestpass as $guestpas) {
            if ($guestpas->Insurance == 1 && $guestpas->Donation == 0){
                $totalprice = $guestpas->TotalPrice - 10;
            }elseif($guestpas->Insurance == 0 && $guestpas->Donation == 1){
                $totalprice = $guestpas->TotalPrice - $guestpas->Donation_amount;
            }elseif(($guestpas->Insurance == 1 && $guestpas->Insurance == 1)){
                $totalprice = $guestpas->TotalPrice - $guestpas->Donation_amount-10;
            }else{
                $totalprice = $guestpas->TotalPrice;
            }
            $mytotalprice +=  $totalprice;
        }
        $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
        $appFee = number_format($mytotalprice/100*20??'0',2, '.', ',');
        $totalDonation =GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('Donation',1);
        $totalDonation =$totalDonation->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->get();
        $totalInsurance =GuestpassReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalInsurance =$totalInsurance->where('Insurance',1)->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
        $guestpassreserves = GuestpassReservation::with('getGuestPassOrderssupadmin','getGuestPassOrdersbyusersupadmin')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
        $guestpassreservesstats = GuestpassReservation::with('getGuestPassOrderssupadmin')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->get();
        // dd($guestpassreserves);
        return view('website.supadminguestpassreservation',compact('guestpassreserves','guestpassreservesstats','bookings','guestpass','totalDonation','mytotalprice','spEarning','appFee','totalDonation','totalInsurance'));
    }


    public function supadguestpassreserveone($id){

        // dd($id);

        $guestpassreserves = GuestpassReservation::with('getGuestPassOrderssupadmin','getGuestPassOrdersbyusersupadmin','getGuestPassOrdersbyuserprofilesupadmin')->where('ReceiptNum',$id)->first();

        // dd($guestpassreserves);

        return view('website.supadminguestpassreservation_detail',compact('guestpassreserves'));

    }

    public function mycity(){

        $city = City::all();

        // dd($city);

        return view('superadminviews.allcity',compact('city'));

    }

    public function createcity(){

        return view('superadminviews.addcity');

    }

    public function citysave(Request $request){

        $validator = $request->validate([
            'cityname'     =>  'required',
        ]);

        DB::beginTransaction();

        try{

            $userDetail = \Auth::user();

            $cityname = str_replace(' ', '', $request->cityname);

            $user = City::create([
                "GuestPassLocation"    => $cityname,
            ]);

            DB::commit();

            return redirect('/allcity')->with('message', 'Created Successfully!');

        }
        catch (\Throwable $e)
        {
            DB::rollback();
        }

        return redirect('/allcity')->with('message', 'Error in Creating!');

    }

    public function city($id){

        $city = City::where('id',$id)->first();

        // dd($city);

        return view('superadminviews.editcity',compact('city'));

    }

    public function updatesave(Request $request){

        // dd($request);

        $ErrorMsg = "";
        $data = [];

        $validator = $request->validate([
            'cityname'		=>  'required',
            'cityid'        =>  'required|Numeric',
        ]);

        DB::beginTransaction();

        $cityname = str_replace(' ', '', $request->cityname);

        // dd($cityname);

        try{

            $guestpassbasic = City::where('id', $request->cityid)
                ->update([
                    'GuestPassLocation'	=>  $cityname,
                ]);


            DB::commit();

            return redirect('/allcity')->with('message', 'Updated Successfully!');

        }
        catch (\Throwable $e)
        {
            DB::rollback();

        }

        return redirect('/allcity')->with('message', 'Error in Update!');

    }

    public function mycitystatus($id,$status){

        // dd($id,$status);

        if($status == 'active'){

            $mystatus = 1;

        }elseif($status == 'notactive'){

            $mystatus = 0;

        }elseif($status == 'Draft'){

            $mystatus = 2;

        }else{

            $mystatus = 0;

        }


        if($mystatus || $mystatus == 0 ){
            $match = City::where('id',$id)->update(['citystatus'=> $mystatus]);
        }
        return redirect('/allcity');
    }

    public function myguestpassbookingsd(){
        $guestpassbooking = GuestpassReservation::with('getGuestPassOrderssupadmin')->get();
        return view('superadminviews.guestpasscalender',compact('guestpassbooking'));
    }

    public function allusers(){
//        return $allusers = User::where('id','>=',4)->where('status', '!=' , 0)->orderBy('id', 'DESC')->get();
        $allusers = User::whereHas(
            'roles', function($q){
            $q->where('id','<=','9');
            $q->where('id','>=','4');
        }
        )->orderBy('id', 'DESC')->get();
        return view('superadminviews.allusers',compact('allusers'));
    }
    public function serviceProviderRequests(){
        if(Auth::user()->hasRole('SuperAdmin')){
//            $allusers = User::where('id','>=',4)->where('status',0)->orderBy('id', 'DESC')->get();
            $allusers = User::whereHas(
                'roles', function($q){
                $q->where('id','<=','9');
                $q->where('id','>=','4');
            }
            )->orderBy('id', 'DESC')->where('status',0)->get();
            return view('superadminviews.allusers',compact('allusers'));
        }
        else {
            return back();
        }
    }
    public function myuserstatus($id,$status){
        if($status == 'active'){
            $mystatus = 1;
            $User 		= 	User::where('id',$id)->first();
//            $all=[
//                'VerifyToken'=>$tokenforverify,
//                'request'=>$request,
//            ];

            $emailcandi = $User->email;
            $checkmymail = Mail::send('mail.activate_account',[
                'datas' =>'Your Account is activated',
            ],
                function ($message) use ($emailcandi) {
                    $message->to($emailcandi);
                    // $message->cc('uzair_khalid@gmail.com');
                    $message->subject('ALZiyara - Account Activated');
                });
        }elseif($status == 'notactive'){
            $mystatus = 2;
        }else{
            $mystatus = 2;
        }
        if($mystatus || $mystatus == 0 ){
            $User 		= 	User::where('id',$id)->update(['status'=> $mystatus]);
            $GuestPass	=	GuestPass::where('GuestPassCreatedBy',$id)->update(['userstatus'	=> $mystatus]);
            $Transportation	=	Transportation::where('TransportationOwnerID',$id)->update(['vendor_status'	=> $mystatus]);
        }
        return redirect('/allusers');
    }


    public function allproperties(){

        $property = Property::with('getHotelPics')->where('Published','=',1)->get();


        return view('superadminviews.allproperty',compact('property'));

    }

    public function mypropertystatus($id,$status){

        // dd($id,$status);

        if($status == 'active'){

            $mystatus = 1;

        }elseif($status == 'notactive'){

            $mystatus = 0;

        }elseif($status == 'Draft'){

            $mystatus = 2;

        }else{

            $mystatus = 0;

        }
        if($mystatus || $mystatus == 0 ){

            $User = Property::where('PropertyID',$id)->update(['Admin_status'=> $mystatus]);

        }
        return redirect('/allusers');

    }

    public function mypropertyshow($id){

        // dd($id);

        $data['property'] = Property::with('getHotelPics','getHotelFeaturesAndAmenities')->where('PropertyID',$id)->first();

        // return $guestPass;

        $data['propertytype'] = PropertyType::all();

        // return $data;

        return view('superadminviews.propertydetailshow',compact('data'));

    }


    public function allroomreservation(){

        $bookings = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $bookings = $bookings->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
        $room = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $room = $room->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
        $mytotalprice = 0;
        foreach($room as $rooms) {
            if ($rooms->Insurance == 1 && $rooms->Donation == 0){
                $totalprice = $rooms->TotalPrice - 10;
            }elseif($rooms->Insurance == 0 && $rooms->Donation == 1){
                $totalprice = $rooms->TotalPrice - $rooms->Donation_amount;
            }elseif(($rooms->Insurance == 1 && $rooms->Insurance == 1)){
                $totalprice = $rooms->TotalPrice - $rooms->Donation_amount-10;
            }else{
                $totalprice = $rooms->TotalPrice;
            }
            $mytotalprice +=  $totalprice;
        }
        $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
        $appFee = number_format($mytotalprice/100*20??'0',2, '.', ',');
        $totalDonation =Roomreservation:: where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalDonation =$totalDonation->where('Donation',1)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
        $totalInsurance =Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalInsurance =$totalInsurance->where('Insurance',1)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
        $roomreserves = Roomreservation::with('getRoomOrderssupadmin','getReservationOrdersroom')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
        $roomreservestatus = Roomreservation::with('getRoomOrderssupadmin','getReservationOrdersroom')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();

        // dd($guestpassreserves);
        return view('superadminviews.allroomreservation',compact('roomreserves','roomreservestatus','mytotalprice','bookings','spEarning','appFee','totalDonation','totalInsurance'));

    }


    public function roomreserveone($id){

        // dd($id);

        $roomreserves = Roomreservation::with('getRoomOrderssupadmin','getReservationOrdersroom','getRoomOrdersbyusersupadmin','getRoomOrdersbyuserprofilesupadmin')->where('ReceiptNum',$id)->first();

        // dd($guestpassreserves);

        return view('superadminviews.roomreservationdetail',compact('roomreserves'));

    }

    public function myroombookingsd(){

        $roombooking = Roomreservation::with('getRoomOrderssupadmin')->groupBy('ReceiptNum')->get();

        return view('superadminviews.roomcalender',compact('roombooking'));
    }


    public function alltransportreservation(){
        $bookings = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $bookings = $bookings->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
        $transport = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $transport = $transport->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
        $mytotalprice = 0;
        foreach($transport as $transports) {
            if ($transports->Insurance == 1 && $transports->Donation == 0){
                $totalprice = $transports->TotalPrice - 10;
            }elseif($transports->Insurance == 0 && $transports->Donation == 1){
                $totalprice = $transports->TotalPrice - $transports->Donation_amount;
            }elseif(($transports->Insurance == 1 && $transports->Insurance == 1)){
                $totalprice = $transports->TotalPrice - $transports->Donation_amount-10;
            }else{
                $totalprice = $transports->TotalPrice;
            }
            $mytotalprice +=  $totalprice;
        }
        $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
        $appFee = number_format($mytotalprice/100*20??'0',2, '.', ',');
        $totalDonation =TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalDonation =$totalDonation->where('Donation',1)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
        $totalInsurance =TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalInsurance =$totalInsurance->where('Insurance',1)->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
        $transportreserves=TransportReservation::with('getTransportOrderssupadmin','getTransportmainrouteforreservation')->orderBy('created_at','DESC')->groupby('ReceiptNum')->get();
        $transportreservesstats = TransportReservation::with('getTransportOrderssupadmin','getTransportmainrouteforreservation')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
        // dd($guestpassreserves);
        return view('superadminviews.alltransportreservation',compact('transportreserves','transportreservesstats','bookings','transport','mytotalprice','spEarning','appFee','totalDonation','totalInsurance'));
    }

    public function transportreserveone($id){

        // dd($id);

        $transportreserves = TransportReservation::with('getTransportOrderssupadmin','getTransportmainrouteforreservation','getTransportOrdersbyusersupadmin','getTransportOrdersbyuserprofilesupadmin')->where('ReceiptNum',$id)->first();

        // dd($guestpassreserves);

        return view('superadminviews.transportreservationdetail',compact('transportreserves'));

    }

    public function mytransportbookingsd(){

        $transportbooking = TransportReservation::with('getTransportOrderssupadmin')->groupBy('ReceiptNum')->get();

        return view('superadminviews.transportcalender',compact('transportbooking'));
    }

    public function mypackagebookingsd(){

        $packagebooking = Search::with('getPackageDealsOrderDetail')->get();
        return view('superadminviews.packagecalender',compact('packagebooking'));

    }

    public function allguidereservation(){
        $bookings = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $bookings = $bookings->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
        $guide = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $guide =$guide->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
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
        $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
        $appFee = number_format($mytotalprice/100*20??'0',2, '.', ',');
        $totalDonation = GuideReservation:: where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalDonation =$totalDonation->where('Donation',1)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
        $totalInsurance = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $totalInsurance =$totalInsurance->where('Insurance',1)->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
        $guidereservesstats = GuideReservation::with('getGuideOrderssupadmin')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
        $guidereserves = GuideReservation::with('getGuideOrderssupadmin')->orderBy('created_at', 'DESC')->groupBy('ReceiptNum')->get();
        // dd($guestpassreserves);
        return view('superadminviews.allguidesreservation',compact('guidereserves','guidereservesstats','mytotalprice','bookings','spEarning','appFee','totalDonation','totalInsurance'));
    }

    public function guidereserveone($id){

        $guidereserves = GuideReservation::with('getGuideOrderssupadmin','getGuideOrdersbyusersupadmin','getGuideOrdersbyuserprofilesupadmin')->where('ReceiptNum',$id)->first();

        // dd($guestpassreserves);

        return view('superadminviews.guidereservationdetail',compact('guidereserves'));
    }

    public function myguidebookingsd(){

        $guidebooking = GuideReservation::with('getGuideOrderssupadmin')->groupBy('ReceiptNum')->get();
        return view('superadminviews.guidecalender',compact('guidebooking'));

    }
    public function getPackageInvoice($invoice_num){
//        $search->getPackageDealsOrderDetail->getPackageUser->profile->phone??'Not Available';
        $package_invoice = Search::with('getPackageDealsOrderDetail','getPackageDealsOrderDetail.getPackageUser.profile','getPackageDealsUserDetail.profile')->where('receipt_num',$invoice_num)->first();
        $start  = new Carbon($package_invoice['getPackageDealsOrderDetail']['package_available_from']??'');
        $end    = new Carbon($package_invoice['getPackageDealsOrderDetail']['package_available_to']??'');
        $diff = $start->diff($end);
        $noOfDays= $diff->d+1;
        if($noOfDays == 1){
            $package_invoice['getPackageDealsOrderDetail']['day'] = $noOfDays.' day('.\Carbon\Carbon::parse( $package_invoice['getPackageDealsOrderDetail']['package_available_from'] )->format('l').')';
        }
        else{
            $package_invoice['getPackageDealsOrderDetail']['day'] = $noOfDays .'days('.\Carbon\Carbon::parse( $package_invoice['getPackageDealsOrderDetail']['package_available_from'] )->format('l').' to '.\Carbon\Carbon::parse( $package_invoice['getPackageDealsOrderDetail']['package_available_to'] )->format('l').')';
        }
        $package_invoice['getPackageDealsOrderDetail']['package_start_date'] = \Carbon\Carbon::parse( $package_invoice['getPackageDealsOrderDetail']['package_available_from'] )->toFormattedDateString();
        $package_invoice['getPackageDealsOrderDetail']['package_end_date'] = \Carbon\Carbon::parse( $package_invoice['getPackageDealsOrderDetail']['package_available_to'] )->toFormattedDateString();
        $package_invoice['getPackageDealsOrderDetail']['tour_description'] = strip_tags($package_invoice['getPackageDealsOrderDetail']['package_deals_desc']);
        $package_invoice['getPackageDealsOrderDetail']['house_rules'] = strip_tags($package_invoice['getPackageDealsOrderDetail']['house_rules']);
        $package_invoice['booked_on'] = \Carbon\Carbon::parse( $package_invoice['created_at'] )->toDayDateTimeString();
        $package_invoice['package_start_date_minus']= new Carbon($package_invoice['reservation_for_date']??'');
        $package_invoice['package_start_date_minus']=  $package_invoice['package_start_date_minus']->subDays(10);
        $package_invoice['package_start_date_minus']= \Carbon\Carbon::parse( $package_invoice['package_start_date_minus'])->toFormattedDateString();
        $package_invoice['total_price']= number_format($package_invoice['total_price']??'',2);
        $package_invoice['getPackageDealsOrderDetail']['price_unformated']= ($package_invoice['getPackageDealsOrderDetail']['price']??'');
        $package_invoice['getPackageDealsOrderDetail']['price']= number_format($package_invoice['getPackageDealsOrderDetail']['price']??'',2);



        return $package_invoice;

    }
    public function getGuestpassInvoice($invoice_num){
      $guestpass_invoice = GuestpassReservation::with('getGuestPassOrderssupadmin','getGuestPassOrderssupadmin.guestpassbyuser','getGuestPassOrdersbyuserprofilesupadmin','getGuestPassOrdersbyuser.profile','getGuestPassOrdersbyuser')->where('ReceiptNum',$invoice_num)->first();
        $guestpass_invoice['day'] = \Carbon\Carbon::parse( $guestpass_invoice['CreatedOn']??'')->format('l');
        $guestpass_invoice['guestpass_date'] = \Carbon\Carbon::parse( $guestpass_invoice['ReservationForDate']??'')->toFormattedDateString();
        $guestpass_invoice['Description'] = str_replace('&nbsp;',' ',strip_tags($guestpass_invoice['getGuestPassOrderssupadmin']['GuestPassDesc']??''));
        $guestpass_invoice['house_rules'] = str_replace('&nbsp;',' ',strip_tags($guestpass_invoice['getGuestPassOrderssupadmin']['HouseRules']??''));
        $guestpass_invoice['booked_on'] = \Carbon\Carbon::parse( $guestpass_invoice['created_at']??'')->toDayDateTimeString();

        $guestpass_invoice['guestpass_start_date_minus']= new Carbon($guestpass_invoice['ReservationForDate']??'');
        $guestpass_invoice['guestpass_start_date_minus']=  $guestpass_invoice['guestpass_start_date_minus']->subDays(10);
        $guestpass_invoice['guestpass_start_date_minus']= \Carbon\Carbon::parse( $guestpass_invoice['guestpass_start_date_minus'])->toFormattedDateString();


        return $guestpass_invoice;
    }
    public function getGuideInvoice($invoice_num){
        $guide_invoice = GuideReservation::with('getGuideOrderssupadmin','getGuidesUserDetail.profile','getGuideDetails.getguideUser','getGuidesUserDetail')->groupBy('ReceiptNum')->where('ReceiptNum',$invoice_num)->first();
//        $guide_invoice['day'] = \Carbon\Carbon::parse( $guide_invoice['reservation_start_date'] )->format('l');
        $newstart  = new Carbon($guide_invoice['reservation_start_date']??'');
        $newend    = new Carbon($guide_invoice['reservation_end_date']??'');
        $guide_invoice['qty'] = \Carbon\Carbon::parse( $newstart )->diffInDays( $newend );
        $start  = new Carbon($guide_invoice['reservation_start_date']??'');
        $end    = new Carbon($guide_invoice['reservation_end_date']??'');
        $diff = $start->diff($end);
        $noOfDays= $diff->d+1;
        if($noOfDays == 1){
            $guide_invoice['day'] = $noOfDays.' day('.\Carbon\Carbon::parse( $guide_invoice['reservation_start_date'] )->format('l').')';
        }

        else{
            $guide_invoice['day'] = $noOfDays .'days('.\Carbon\Carbon::parse( $guide_invoice['reservation_start_date'] )->format('l').' to '.\Carbon\Carbon::parse( $guide_invoice['reservation_end_date'] )->format('l').')';
        }
        $guide_invoice['guide_start_date'] = \Carbon\Carbon::parse( $guide_invoice['reservation_start_date'] )->toFormattedDateString();
        $guide_invoice['guide_end_date'] = \Carbon\Carbon::parse( $guide_invoice['reservation_end_date'] )->toFormattedDateString();
         $guide_invoice['Description'] = str_replace('&nbsp;',' ',strip_tags($guide_invoice['getGuideOrderssupadmin']['GuidesDesc']??''));
        $guide_invoice['house_rules'] = str_replace('&nbsp;',' ',strip_tags($guide_invoice['getGuideDetails']['HouseRules']??''));
        $guide_invoice['booked_on'] = \Carbon\Carbon::parse($guide_invoice['created_at']??'')->toDayDateTimeString();

        $guide_invoice['guide_start_date_minus']= new Carbon($guide_invoice['reservation_start_date']);
        $guide_invoice['guide_start_date_minus'] =  $guide_invoice['guide_start_date_minus']->subDays(10);
        $guide_invoice['guide_start_date_minus']= \Carbon\Carbon::parse( $guide_invoice['guide_start_date_minus'] )->toFormattedDateString();
        return $guide_invoice;
    }
    public function getTransportInvoice($invoice_num){
       $transport_invoice = TransportReservation::with('getTransportOrderssupadmin','getTransportVendorDetail.profile','getTransportOrderssupadmin.getTransporttype','getTransportUserDetail.profile','getTransportUserDetail','getTransportRoutes')->groupBy('ReceiptNum')->where('ReceiptNum',$invoice_num)->first();

        $VehicleRouteID = TransportReservation::where('ReceiptNum',$invoice_num)->pluck('VehicleRouteID');
        $RouteID= TransportReservation::where('ReceiptNum',$invoice_num)->pluck('RouteID');

        if($transport_invoice['triptype'] == 'oneway') {
         $transport_invoice['Price']=VendorTransportRoute::whereIn('VehicleRouteID',$VehicleRouteID)->where('RouteID',$RouteID)->pluck('Price');
        }else {
            $transport_invoice['Price']=VendorTransportRoute::whereIn('VehicleRouteID',$VehicleRouteID)->where('RouteID',$RouteID)->pluck('TwoWayPrice');
        }
//        $transport_invoice = GuideReservation::with('getGuideOrderssupadmin','getGuidesUserDetail')->groupBy('ReceiptNum')->where('ReceiptNum',$invoice_num)->first();
        $start  = new Carbon($transport_invoice['reservation_start_date']??'');
        $end    = new Carbon($transport_invoice['reservation_end_date']??'');
        $diff = $start->diff($end);
        $noOfDays= $diff->d+1;
        if($noOfDays == 1){
            $transport_invoice['day'] = $noOfDays.' day('.\Carbon\Carbon::parse( $transport_invoice['reservation_start_date'] )->format('l').')';
        }
        else{
            $transport_invoice['day'] = $noOfDays .'days('.\Carbon\Carbon::parse( $transport_invoice['reservation_start_date'] )->format('l').' to '.\Carbon\Carbon::parse( $transport_invoice['reservation_end_date'] )->format('l').')';
        }
        $transport_invoice['transport_start_date'] = \Carbon\Carbon::parse( $transport_invoice['reservation_start_date'] )->toFormattedDateString();
        $transport_invoice['transport_end_date'] = \Carbon\Carbon::parse( $transport_invoice['reservation_end_date'] )->toFormattedDateString();
        $transport_invoice['Description'] = strip_tags($transport_invoice['getTransportOrderssupadmin']['Description']);
        $transport_invoice['house_rules'] = strip_tags($transport_invoice['getTransportOrderssupadmin']['Houserules']);
        $transport_invoice['booked_on'] = \Carbon\Carbon::parse( $transport_invoice['created_at'] )->toDayDateTimeString();

        $transport_invoice['transport_start_date_minus']= new Carbon($transport_invoice['reservation_start_date']);
        $transport_invoice['transport_start_date_minus'] =  $transport_invoice['transport_start_date_minus']->subDays(10);
        $transport_invoice['transport_start_date_minus']= \Carbon\Carbon::parse( $transport_invoice['transport_start_date_minus'])->toFormattedDateString();

        return $transport_invoice;
    }
    public function getRoomInvoice($invoice_num){
        $room_invoice = Roomreservation::with('getRoomDetails','getRoomDetails.getBedType','getRoomDetails.getHotelRoomDetails.getUserofProperty','getRoomtUserDetail.profile','getRoomtUserDetail')->groupBy('ReceiptNum')->where('ReceiptNum',$invoice_num)->first();
        $room_invoice['Price'] = ($room_invoice['getRoomDetails']['Price']+$room_invoice['getRoomDetails']['TaxAndCharges']);
        $start  = new Carbon($room_invoice['checkin']??'');
        $end    = new Carbon($room_invoice['checkout']??'');
        $noOfDays = \Carbon\Carbon::parse( $start )->diffInDays( $end );

        $startdate  = new Carbon($room_invoice['checkin']??'');
        $endDate    = new Carbon($room_invoice['checkout']??'');
        $days = \Carbon\Carbon::parse( $start )->diffInDays( $end );
       if($days>1){
        $room_invoice['days'] = $days;
       }else{
        $room_invoice['days'] = 1;
       }

//        $diff = $start->diff($end);
//$noOfDays= $diff->d+1;
        if($noOfDays == 1){
            $room_invoice['day'] = $noOfDays.' day('.\Carbon\Carbon::parse( $room_invoice['checkin'] )->format('l').')';
        }
        else{
            $room_invoice['day'] = $noOfDays .'days('.\Carbon\Carbon::parse( $room_invoice['checkin'] )->format('l').' to '.\Carbon\Carbon::parse( $room_invoice['checkout'] )->format('l').')';
        }
//        $room_invoice['day'] = \Carbon\Carbon::parse( $room_invoice['checkin'] )->format('l');
        $room_invoice['checkin_date'] = \Carbon\Carbon::parse( $room_invoice['checkin'] )->toFormattedDateString();
        $room_invoice['checkout_date'] = \Carbon\Carbon::parse( $room_invoice['checkout'] )->toFormattedDateString();
        $room_invoice['Description'] = strip_tags($room_invoice['getRoomDetails']['RoomDescription']);
        $room_invoice['house_rules'] = strip_tags($room_invoice['getRoomDetails']['getHotelRoomDetails']['HouseRules']);
        $room_invoice['booked_on'] = \Carbon\Carbon::parse( $room_invoice['created_at'] )->toDayDateTimeString();
        $room_invoice['room_start_date_minus']= new Carbon($room_invoice['checkin']);
        $room_invoice['room_start_date_minus'] =  $room_invoice['room_start_date_minus']->subDays(10);
        $room_invoice['room_start_date_minus']= \Carbon\Carbon::parse( $room_invoice['room_start_date_minus'] )->toFormattedDateString();

        return $room_invoice;
    }

    public function packagesPaymentStatus($id,$status,$value){

        // dd($id,$status);

        if($status == 'PAID'){

            $mystatus = 'PAID';
            $paymentstatus = Search::where('id',$id)->update(['payment_status'=> $mystatus,'PaymentStatusComment' =>$value]);
        }elseif($status == 'UNPAID'){

            $mystatus = 'UNPAID';
            $paymentstatus = Search::where('id',$id)->update(['payment_status'=> $mystatus,'PaymentStatusComment' =>$value, 'booking_status'=>'PENDING']);
        }else{

            $mystatus = 'UNPAID';
            $paymentstatus = Search::where('id',$id)->update(['payment_status'=> $mystatus,'PaymentStatusComment' =>$value, 'booking_status'=>'PENDING']);
        }
//        if($mystatus){
//            $paymentstatus = Search::where('id',$id)->update(['payment_status'=> $mystatus,'PaymentStatusComment' =>$value]);
//        }
        // return redirect('/allcity');

    }

    public function roomPaymentStatus($id,$status,$value){

        // dd($id,$status,$value);

        if($status == 'PAID'){

            $mystatus = 'PAID';
            $paymentstatus = Roomreservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
        }elseif($status == 'UNPAID'){

            $mystatus = 'UNPAID';
            $paymentstatus = Roomreservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value,'BookingStatus'=>'PENDING']);
        }else{

            $mystatus = 'UNPAID';
            $paymentstatus = Roomreservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }
//        if($mystatus){
//            $paymentstatus = Roomreservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
//        }
        // return redirect('/allcity');

    }

    public function transportPaymentStatus($id,$status,$value){

        // dd($id,$status);

        if($status == 'PAID'){

            $mystatus = 'PAID';
            $paymentstatus = TransportReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
        }elseif($status == 'UNPAID'){

            $mystatus = 'UNPAID';
            $paymentstatus = TransportReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }else{

            $mystatus = 'UNPAID';
            $paymentstatus = TransportReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }
//        if($mystatus){
//            $paymentstatus = TransportReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
//        }
        // return redirect('/allcity');

    }

    public function guidePaymentStatus($id,$status,$value){

        // dd($id,$status);

        if($status == 'PAID'){

            $mystatus = 'PAID';
            $paymentstatus = GuideReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
        }elseif($status == 'UNPAID'){

            $mystatus = 'UNPAID';
            $paymentstatus = GuideReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }else{

            $mystatus = 'UNPAID';
            $paymentstatus = GuideReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }
//        if($mystatus){
//            $paymentstatus = GuideReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
//        }
        // return redirect('/allcity');

    }

    public function guestpassPaymentStatus($id,$status,$value){

        // dd($id,$status);

        if($status == 'PAID'){

            $mystatus = 'PAID';
            $paymentstatus = GuestpassReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
        }elseif($status == 'UNPAID'){

            $mystatus = 'UNPAID';
            $paymentstatus = GuestpassReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }else{

            $mystatus = 'UNPAID';
            $paymentstatus = GuestpassReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value, 'BookingStatus'=>'PENDING']);
        }
//        if($mystatus){
//            $paymentstatus = GuestpassReservation::where('ReceiptNum',$id)->update(['PaymentStatus'=> $mystatus,'PaymentStatusComment' =>$value]);
//        }
        // return redirect('/allcity');

    }

    public function refundrequests(){

        $customerrefundrequests = array();

        $guestpassreserves = GuestpassReservation::with('getcustomerorder','getGuestPassDetailsphoto')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();

        if(isset($guestpassreserves)){

            foreach($guestpassreserves as $guestresdata){

                array_push($customerrefundrequests,[

                    'reciptno'			=>	$guestresdata->ReceiptNum,
                    'name'				=>	$guestresdata->getcustomerorder->GuestPassName,
                    'image'				=>	$guestresdata->getGuestPassDetailsphoto[0]->PhotoLocation??null,
                    'price'				=>	$guestresdata->TotalPrice,
                    'insurance'			=>	$guestresdata->Insurance,
                    'donation'			=>	$guestresdata->Donation,
                    'donation_amount'	=>	$guestresdata->Donation_amount,
                    'route'				=>	URL('guestpass_invoice/'.$guestresdata->ReservationID),
                    'product_id'		=>	$guestresdata->GuestPassID,
                    'ReservationID'		=>	$guestresdata->ReservationID,
                    'category_id'		=>	$guestresdata->getcustomerorder->Productcategory,
                    'bookingstatus'		=>	$guestresdata->BookingStatus,
                    'paymentstatus'		=>	$guestresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($guestresdata->ReservationForDate),"Y/m/d"),
                    'created_at'		=>	date_format($guestresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$guestresdata->request_refund??'',
                    'request_refund_date'    =>	$guestresdata->request_refund_date??'',
                    'request_refund_reply'   		 	=>	$guestresdata->request_refund_reply,
                    'request_refund_reply_comments' =>	$guestresdata->request_refund_reply_comments??'',
                    'customer' =>	$guestresdata->getGuestPassOrdersbyuser->name??'',
                    'service_provider' =>	$guestresdata->getGuestPass->getGuestPassUser->name??'',
                ]);

            }

        }


        $roompassreserves = Roomreservation::with('getReservationOrderspropertycustomer','getReservationOrdersroom','getPropertyphoto')->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();

        if(isset($roompassreserves)){

            foreach($roompassreserves as $roomresdata){

                array_push($customerrefundrequests,[

                    'reciptno'			=>	$roomresdata->ReceiptNum,
                    'name'				=>	$roomresdata->getReservationOrderspropertycustomer->Name,
                    'image'				=>	$roomresdata->getPropertyphoto->PhotoLocation??null,
                    'price'				=>	$roomresdata->TotalPrice,
                    'insurance'			=>	$roomresdata->Insurance,
                    'donation'			=>	$roomresdata->Donation,
                    'donation_amount'	=>	$roomresdata->Donation_amount,
                    'route'				=>	URL('room_invoice/'.$roomresdata->ReservationID),
                    'product_id'		=>	$roomresdata->PropertyID,
                    'ReservationID'		=>	$roomresdata->ReservationID,
                    'category_id'		=>	$roomresdata->getReservationOrderspropertycustomer->Productcategory,
                    'bookingstatus'		=>	$roomresdata->BookingStatus,
                    'paymentstatus'		=>	$roomresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($roomresdata->checkin),"Y/m/d"),
                    'created_at'		=>	date_format($roomresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$roomresdata->request_refund??'',
                    'request_refund_date'    =>	$roomresdata->request_refund_date??'',
					'request_refund_reply'   		 	=>	$roomresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$roomresdata->request_refund_reply_comments??'',
                    'customer' =>	$roomresdata->getRoomOrdersbyuser->name??'',
                    'service_provider' =>	$roomresdata->getRoomDetails->getHotelRoomDetails->getUserofProperty->name??'',
                ]);
            }
        }


        $guidereserves = GuideReservation::with('getcustomerorder','getGuideDetailsphoto')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();

        if(isset($guidereserves)){

            foreach($guidereserves as $guideresdata){

                array_push($customerrefundrequests,[

                    'reciptno'			=>	$guideresdata->ReceiptNum,
                    'name'				=>	$guideresdata->getcustomerorder->GuidesName,
                    'image'				=>	$guideresdata->getGuideDetailsphoto->PhotoLocation??null,
                    'price'				=>	$guideresdata->TotalPrice,
                    'insurance'			=>	$guideresdata->Insurance,
                    'donation'			=>	$guideresdata->Donation,
                    'donation_amount'	=>	$guideresdata->Donation_amount,
                    'route'				=>	URL('guide_invoice/'.$guideresdata->ReservationID),
                    'product_id'		=>	$guideresdata->PropertyID,
                    'ReservationID'		=>	$guideresdata->ReservationID,
                    'category_id'		=>	$guideresdata->getcustomerorder->Productcategory,
                    'bookingstatus'		=>	$guideresdata->BookingStatus,
                    'paymentstatus'		=>	$guideresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($guideresdata->reservation_start_date),"Y/m/d"),
                    'created_at'		=>	date_format($guideresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$guideresdata->request_refund??'',
                    'request_refund_date'    =>	$guideresdata->request_refund_date??'',
					'request_refund_reply'   		 	=>	$guideresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$guideresdata->request_refund_reply_comments??'',
                    'customer' =>	$guideresdata->getGuidebyuser->name??'',
                    'service_provider' =>	$guideresdata->getGuideOrders->getguideUser->name??'',
                ]);
            }
        }
        $transportreserves = TransportReservation::with('getcustomerorder','getTransportmainrouteforreservation','gettransportDetailsphoto')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();

        if(isset($transportreserves)){

            foreach($transportreserves as $transportresdata){

                array_push($customerrefundrequests,[

                    'reciptno'			=>	$transportresdata->ReceiptNum,
                    'name'				=>	$transportresdata->getcustomerorder->NameofVehicle,
                    'image'				=>	$transportresdata->gettransportDetailsphoto->PhotoLocation??null,
                    'price'				=>	$transportresdata->TotalPrice,
                    'insurance'			=>	$transportresdata->Insurance,
                    'donation'			=>	$transportresdata->Donation,
                    'donation_amount'			=>	$transportresdata->Donation_amount,
                    'route'				=>	URL('transport_invoice/'.$transportresdata->ReservationID),
                    'product_id'		=>	$transportresdata->VehicleRouteID,
                    'ReservationID'		=>	$transportresdata->ReservationID,
                    'category_id'		=>	3,
                    'bookingstatus'		=>	$transportresdata->BookingStatus,
                    'paymentstatus'		=>	$transportresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($transportresdata->PickUpDateTime),"Y/m/d"),
                    'created_at'		=>	date_format($transportresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$transportresdata->request_refund??'',
                    'request_refund_date'    =>	$transportresdata->request_refund_date??'',
					'request_refund_reply'   		 	=>	$transportresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$transportresdata->request_refund_reply_comments??'',
                    'customer' =>	$transportresdata->getTransportOrdersbyuser->name??'',
                    'service_provider' =>	$transportresdata->getTransportVendorDetail->name??'',
                ]);
            }
        }
        $packagereserve = Search::with('getPackageDealsOrderDetail.getPackageUser.profile','getPackageDealsOrderDetail.getPackageDealsDefaultPhoto')->orderBy('id', 'DESC')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->where('request_refund','<>','')->get();
        if(isset($packagereserve)){
            foreach($packagereserve as $packageresdata){
                array_push($customerrefundrequests,[
                    'reciptno'			=>	$packageresdata->receipt_num,
                    'name'				=>	$packageresdata->getPackageDealsOrderDetail->package_deals_name,
                    'image'				=>	$packageresdata->getPackageDealsOrderDetail->getPackageDealsDefaultPhoto->PhotoLocation??null,
                    'price'				=>	$packageresdata->total_price,
                    'insurance'			=>	$packageresdata->package_insurance,
                    'donation'			=>	$packageresdata->package_donation,
                    'donation_amount'	=>	$packageresdata->package_donation_amount,
                    'route'			    =>  URL('package_deals_invoice/'.$packageresdata->id),
                    'product_id'		=>	$packageresdata->getPackageDealsOrderDetail->id,
                    'ReservationID'	    =>	$packageresdata->id,
                    'category_id'		=>	1,
                    'bookingstatus'		=>	$packageresdata->booking_status,
                    'paymentstatus'		=>	$packageresdata->payment_status,
                    'reservationdate'	=>	date_format(date_create($packageresdata->getPackageDealsOrderDetail->package_available_from),"Y/m/d"),
                    'created_at'		=>	date_format($packageresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'   =>	$packageresdata->request_refund??'',
                    'request_refund_date'   =>	$packageresdata->request_refund_date??'',
					'request_refund_reply'   		 	=>	$packageresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$packageresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $price = array_column($customerrefundrequests, 'created_at');
        array_multisort($price, SORT_DESC, $customerrefundrequests);
//        Total Count Work Start
        $totalCustomers = array();
        $guestpassreserves = GuestpassReservation::with('getGuestPass.getGuestPassUser','getGuestPassOrdersbyuser','getcustomerorder','getGuestPassDetailsphoto')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->get();
        if(isset($guestpassreserves)){
            foreach($guestpassreserves as $guestresdata){
                array_push($totalCustomers,[
                    'price'				=>	$guestresdata->TotalPrice??0,
                    'insurance'			=>	$guestresdata->Insurance??'',
                    'donation'			=>	$guestresdata->Donation??'',
                    'donation_amount'	=>	$guestresdata->Donation_amount??0,
                    'bookingstatus'		=>	$guestresdata->BookingStatus??'',
                    'paymentstatus'		=>	$guestresdata->PaymentStatus??'',
                    'request_refund'    =>	$guestresdata->request_refund??'',
                    'request_refund_date'    =>	$guestresdata->request_refund_date??'',
                    'request_refund_reply'  =>	$guestresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$guestresdata->request_refund_reply_comments??'',
                    'customer' =>	$guestresdata->getGuestPassOrdersbyuser->name??'',
                    'service_provider' =>	$guestresdata->getGuestPass->getGuestPassUser->name??'',
                ]);
            }
        }
        $roompassreserves = Roomreservation::with('getReservationOrderspropertycustomer','getReservationOrdersroom','getPropertyphoto')->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->get();
        if(isset($roompassreserves)){
            foreach($roompassreserves as $roomresdata){
                array_push($totalCustomers,[
                    'price'				=>	$roomresdata->TotalPrice??0,
                    'insurance'			=>	$roomresdata->Insurance??'',
                    'donation'			=>	$roomresdata->Donation??'',
                    'donation_amount'	=>	$roomresdata->Donation_amount??0,
                    'bookingstatus'		=>	$roomresdata->BookingStatus??'',
                    'paymentstatus'		=>	$roomresdata->PaymentStatus??'',
                    'request_refund'    =>	$roomresdata->request_refund??'',
                    'request_refund_date'    =>	$roomresdata->request_refund_date??'',
                    'request_refund_reply'  =>	$roomresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$roomresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $guidereserves = GuideReservation::with('getcustomerorder','getGuideDetailsphoto')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->get();
        if(isset($guidereserves)){
            foreach($guidereserves as $guideresdata){
                array_push($totalCustomers,[
                    'price'				=>	$guideresdata->TotalPrice??0,
                    'insurance'			=>	$guideresdata->Insurance??'',
                    'donation'			=>	$guideresdata->Donation??'',
                    'donation_amount'	=>	$guideresdata->Donation_amount??0,
                    'bookingstatus'		=>	$guideresdata->BookingStatus??'',
                    'paymentstatus'		=>	$guideresdata->PaymentStatus??'',
                    'request_refund'    =>	$guideresdata->request_refund??'',
                    'request_refund_date'    =>	$guideresdata->request_refund_date??'',
                    'request_refund_reply'   		 	=>	$guideresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$guideresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $transportreserves = TransportReservation::with('getcustomerorder','getTransportmainrouteforreservation','gettransportDetailsphoto')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->get();
        if(isset($transportreserves)){
            foreach($transportreserves as $transportresdata){
                array_push($totalCustomers,[
                    'price'				=>	$transportresdata->TotalPrice??0,
                    'insurance'			=>	$transportresdata->Insurance??'',
                    'donation'			=>	$transportresdata->Donation??'',
                    'donation_amount'			=>	$transportresdata->Donation_amount??0,
                    'bookingstatus'		=>	$transportresdata->BookingStatus??'',
                    'paymentstatus'		=>	$transportresdata->PaymentStatus??'',
                    'request_refund'    =>	$transportresdata->request_refund??'',
                    'request_refund_date'    =>	$transportresdata->request_refund_date??'',
                    'request_refund_reply'   		 	=>	$transportresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$transportresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $packagereserve = Search::with('getPackageDealsOrderDetail.getPackageUser.profile','getPackageDealsOrderDetail.getPackageDealsDefaultPhoto')->orderBy('id', 'DESC')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->get();
        if(isset($packagereserve)){
            foreach($packagereserve as $packageresdata){
                array_push($totalCustomers,[
                    'price'				=>	$packageresdata->total_price??0,
                    'insurance'			=>	$packageresdata->package_insurance??'',
                    'donation'			=>	$packageresdata->package_donation??'',
                    'donation_amount'	=>	$packageresdata->package_donation_amount??0,
                    'bookingstatus'		=>	$packageresdata->booking_status??'',
                    'paymentstatus'		=>	$packageresdata->payment_status??'',
                    'request_refund'   =>	$packageresdata->request_refund??'',
                    'request_refund_date'   =>	$packageresdata->request_refund_date??'',
                    'request_refund_reply'   		 	=>	$packageresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$packageresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $totalSales= 0;
        foreach($totalCustomers as $sales) {
            $totalSales +=  $sales['price'];
        }
        $mytotalprice = 0;
        foreach($totalCustomers as $sales) {
            if ($sales['insurance'] == 1 && $sales['donation'] == 0){
                $totalprice = $sales['price'] - 10;
            }elseif($sales['insurance'] == 0 && $sales['donation'] == 1){
                $totalprice = $sales['price'] - $sales['donation_amount'];
            }elseif(($sales['insurance'] == 1 && $sales['donation'] == 1)){
                $totalprice = $sales['price'] - $sales['donation_amount']-10;
            }else{
                $totalprice = $sales['price'];
            }
            $mytotalprice +=  $totalprice;
        }
        $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
        $refundRequest = 0;
        foreach($totalCustomers as $request) {
         if($request['request_refund'] != ''){
             $refundRequest +=  $request['price'];
            }
        }
        $issuedRefund= 0;
        foreach($totalCustomers as $issued) {
            if($issued['request_refund'] != '' && $issued['request_refund_reply'] == 'REFUNDED'){
                $issuedRefund +=  $issued['price'];
            }
        }
        $CancelledRefund= 0;
        foreach($totalCustomers as $Cancelled) {
            if($Cancelled['request_refund'] != '' && $Cancelled['request_refund_reply'] == 'CANCELLED'){
                $CancelledRefund +=  $Cancelled['price'];
            }
        }

        //        Total Count Work Ends
        $customerrefundrequests = collect($customerrefundrequests)->sortByDesc('request_refund_date')->values();
        return view('superadminviews.refundrequest',compact('customerrefundrequests','totalSales','spEarning','refundRequest','issuedRefund','CancelledRefund'));
    }
}
