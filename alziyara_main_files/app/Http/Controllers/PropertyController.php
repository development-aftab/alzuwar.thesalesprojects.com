<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use DB;
use App\Property;
use App\PropertyReview;
use App\PropertyPhoto;
use App\PropertyFeaturesAndAmenities;
use App\PropertyType;
use App\BedType;
use App\Room;
use App\City;
use App\RoomFeatureList;
use App\RoomFeature;
use App\Roomreservation;
use App\WithdrawRequest;
use App\RoomType;
use Storage;
use Auth;

class PropertyController extends Controller
{
    public function addproperty() {
		
		$data['propertytype'] = PropertyType::get();
		
		// dd($data);
		$data['cities'] = City::where('citystatus',1)->orderBy('id', 'DESC')->get();
		
        return view('hotelsviews.addhotels',compact('data'));
    }

    public function saveproperty(Request $request) {

        // dd($request);

        $ErrorMsg = "";
    	$data = [];

        $validator = $request->validate([  
            'HotelName'     	=>  'required',
            'propertytype'		=>  'required|numeric',
            'HotelCountry'      =>  'required',
            'HotelCity'     	=>  'required',
            'HotelPostalCode'   =>  'required',
            'HotelAddress'		=>  'required',
            'HotelDesc'  		=>  'required',
			'HotelHouseRules'	=>	'required',
            'AltText.*'         =>  'required',
            'PhotoLocation.*'   =>  'required|mimes:jpeg,bmp,png|max:2000',
            'programtime.*'     =>  'required',
            'programtimedes.*'  =>  'required',
        ]);

    	DB::beginTransaction();

        try{
                $userDetail = \Auth::user();
                $Propertybasic = new Property;
                $Propertybasic->Name         		= $request->HotelName;
                $Propertybasic->PropertyTypeID  	= $request->propertytype;
                $Propertybasic->Address    			= $request->HotelAddress;
                $Propertybasic->City       			= $request->HotelCity;
                $Propertybasic->PostalCode      	= $request->HotelPostalCode;
                $Propertybasic->Country         	= $request->HotelCountry;
                $Propertybasic->Description     	= $request->HotelDesc;
                $Propertybasic->Published       	= 1;
				$Propertybasic->Admin_status       	= 1;
                $Propertybasic->HouseRules 			= $request->HotelHouseRules;
                $Propertybasic->PropertyShuttle 	= $request->HotelShuttleService;
                $Propertybasic->PropertyDistance    = $request->HotelDistance;
                $Propertybasic->PropertyCreatedBy   = $userDetail->id;
                $Propertybasic->save();
				$prop_id = $Propertybasic->id;
				$PropertyFeature = new PropertyFeaturesAndAmenities;
                $PropertyFeature->propertyID         					= $prop_id;
                $PropertyFeature->generl  								= $request->HotelItenaryGeneral;
                $PropertyFeature->food_and_drink    					= $request->HotelItenaryfood_and_drink;
                $PropertyFeature->front_desk_services       			= $request->HotelItenaryfront_desk_services;
                $PropertyFeature->entertainment_and_family_services     = $request->HotelItenaryentertainment_and_family_services;
                $PropertyFeature->living_area         					= $request->HotelItenaryliving_area;
                $PropertyFeature->health_facility     					= $request->HotelItenaryhealth_facility;
                $PropertyFeature->safety_and_security       			= $request->HotelItenarysafety_and_security;
                $PropertyFeature->bussiness_facility 					= $request->HotelItenarybussiness_facility;
                $PropertyFeature->accessibility 						= $request->HotelItenaryaccessibility;
                $PropertyFeature->languages_spoken    					= $request->HotelItenarylanguages_spoken;
                $PropertyFeature->cleaning_service   					= $request->HotelItenarycleaning_service;
                $PropertyFeature->save();
            

            if ($request->hasfile('PhotoLocation')) {
                
                foreach($request->file('PhotoLocation') as $key => $file){

                    $imageName = Storage::disk('website')->put('Hotels-Property', $file);
					
					$selectedimageindex = (int)$request->Showimage[0];
					
					// dd($selectedimageindex);
					
					if($key == $selectedimageindex ){
						
						$flag = 1;
						
						// dd($key);
						
					}else{
						
						$flag = 0;
						
					}

                    $user = PropertyPhoto::create([
                        "PropertyID"    	=> $prop_id,
                        "PhotoTitle"     	=> $request->PhotoTitle[$key],
                        "AltText"        	=> $request->AltText[$key],
                        "PhotoLocation"  	=> $imageName,
                        "SortOrder"      	=> 1,
                        "DefaultFlag"    	=> $flag,
                    ]);

                }
            }
			
			$myroom = Room::create([
                "PropertyId"   	=> $prop_id,
                "RoomName"  	=> "Room No 1",
                "RoomStatus"  	=> "Not Ready",
                "updated_at"    => date("Y/m/d h:i:sa"),
                "created_at"    => date("Y/m/d h:i:sa"),
            ]);

            // foreach($request->programtime as $key => $program){

                // $user = Guestdpassprogramdetail::create([
                    // "GuestPassID"          => $guestpassbasic->id,
                    // "GuestProDetailTime"   => $request->programtime[$key],
                    // "GuestProDetailDis"    => $request->programtimedes[$key],
                // ]);
                
            // }

            $userIpAddress = \Request::getClientIp(true);

            $user = PropertyReview::create([
                "PropertyID"   	=> $prop_id,
                "Name"  		=> "Admin",
                "EmailAddress"  => "admin@gmail.com",
                "Rating"        => 1,
                "Description"   => "Admin Description",
                "IPAddress"     => $userIpAddress,
                "ReviewOn"     	=> date("Y/m/d h:i:sa"),
				'Flag'			=>	1,
            ]);

            DB::commit();

            return redirect('/myhotels')->with('message', 'Created Successfully!');

        }
        catch (\Throwable $e) 
	    {
	    	DB::rollback();
	    }

        return redirect('/addhotel')->with('message', 'Error in Creating!');
    }

    public function edithotel($id){
        $data['property'] = Property::where('PropertyID',$id)->with('getHotelPics','getHotelFeaturesAndAmenities')->first();
        $data['propertytype'] = PropertyType::get();
        $data['cities'] = City::where('citystatus',1)->get();
        return view('hotelsviews.edithotel',compact('data'));
    }
    public function updateHotel(Request $request){
        $ErrorMsg = "";
        $data = [];
        $validator = $request->validate([
            'PropertyID'        =>  'required',
            'HotelName'     	=>  'required',
            'propertytype'		=>  'required|numeric',
            'HotelCountry'      =>  'required',
            'HotelCity'     	=>  'required',
            'HotelPostalCode'   =>  'required',
            'HotelAddress'		=>  'required',
            'HotelDesc'  		=>  'required',
            'HotelHouseRules'	=>	'required',
            'AltText.*'         =>  'required',
            'PhotoLocation.*'   =>  'required|mimes:jpeg,bmp,png|max:2000',
        ]);
        DB::beginTransaction();
        try{
        $Propertybasic = Property::where('PropertyID', $request->PropertyID)
            ->update([
                'Name'         		 => $request->HotelName,
                'PropertyTypeID'  	 => $request->propertytype,
                'Address'    		 => $request->HotelAddress,
                'City'       		 => $request->HotelCity,
                'PostalCode'      	 => $request->HotelPostalCode,
                'Country'         	 => $request->HotelCountry,
                'Description'     	 => $request->HotelDesc,
                'Published'       	 => 1,
                'Admin_status'       => 1,
                'HouseRules' 		 => $request->HotelHouseRules,
                'PropertyShuttle' 	 => $request->HotelShuttleService,
                'PropertyDistance'   => $request->HotelDistance,
        ]);
        $PropertyFeature = PropertyFeaturesAndAmenities::where('propertyID',$request->PropertyID)
            ->update([
                'generl'							    => $request->HotelItenaryGeneral,
                'food_and_drink'    					=> $request->HotelItenaryfood_and_drink,
                'front_desk_services'       			=> $request->HotelItenaryfront_desk_services,
                'entertainment_and_family_services'     => $request->HotelItenaryentertainment_and_family_services,
                'living_area'         					=> $request->HotelItenaryliving_area,
                'health_facility'     					=> $request->HotelItenaryhealth_facility,
                'safety_and_security'       			=> $request->HotelItenarysafety_and_security,
                'bussiness_facility' 					=> $request->HotelItenarybussiness_facility,
                'accessibility' 						=> $request->HotelItenaryaccessibility,
                'languages_spoken'    					=> $request->HotelItenarylanguages_spoken,
                'cleaning_service'   					=> $request->HotelItenarycleaning_service,
                ]);
        if ($request->hasfile('PhotoLocationupload')){
            $uploadimageindex = 0;
            foreach($request->file('PhotoLocationupload') as $key => $file){
                $imageNameupload = Storage::disk('website')->put('Hotels-Property', $file);
                $user = PropertyPhoto::where('PropertyID', $request->PropertyID)
                    ->where('PhotoID', $request->photoidupload[$key])
                    ->update([
                        "PhotoTitle"     => $request->PhotoTitleupload[$key],
                        "AltText"        => $request->AltTextupload[$key],
                        "PhotoLocation"  => $imageNameupload,
                        "SortOrder"      => 1,
                    ]);
            }
        }
        if ($request->hasfile('PhotoLocation')) {
            foreach($request->file('PhotoLocation') as $key => $file){
                $imageName = Storage::disk('website')->put('Hotels-Property', $file);
                $user = PropertyPhoto::create([
                    "PropertyID"    => $request->PropertyID,
                    "PhotoTitle"     => $request->PhotoTitle[$key],
                    "AltText"        => $request->AltText[$key],
                    "PhotoLocation"  => $imageName,
                    "SortOrder"      => 1,
                    "DefaultFlag"    => 0,
                ]);
            }
        }
        $propertyallphotos = PropertyPhoto::where('PropertyID', $request->PropertyID)->get();
        foreach($propertyallphotos as $key => $propertypassphotosids){
            $selectedimageindex = (int)$request->Showimage[0];
            if($key == $selectedimageindex ){
                $flag = 1;
            }else{
                $flag = 0;

            }
            PropertyPhoto::where('PropertyID', $request->PropertyID)
                ->where('PhotoID', $propertypassphotosids->PhotoID)
                ->update([
                    "DefaultFlag"      => $flag,
                ]);
        }
            DB::commit();
            return redirect('/myhotels')->with('message', 'Successfully Updated!');
        }
        catch (\Throwable $e)
        {
            DB::rollback();
        }
        return redirect('/myhotels')->with('message', 'Error in Update!');
    }
    public function hotelImageRemove($id){
        PropertyPhoto::where('PhotoID',$id)->delete();
    }
	
	public function createroom($id){
        $hotel_id =$id;
		$userDetail = \Auth::user();
		$data['property'] = Property::where('PropertyCreatedBy',$userDetail->id)->get();
		// dd($data['property']);
		$data['bedtype'] = BedType::get();
		$data['RoomFeatureList'] = RoomFeatureList::all();
		$data['room_types'] = RoomType::get();
		return view('hotelsviews.addrooms',compact('data','hotel_id'));
		
	}
	
	public function saveroom(Request $request){
		
		// dd($request);

        $ErrorMsg = "";
    	$data = [];

        $validator = $request->validate([
            'RoomName'      	=>  'required',
            'roomproperty'     	=>  'required',
			'RoomPrice'			=>  'required|numeric',
            'qtyofbed'   		=>  'required|numeric',
            'bedtype'			=>  'required',
            'roomoccupancy'  	=>  'required|numeric',
			'RoomType'			=>	'required',
			'roomdescription'	=>  'required',
			'roomphoto'   		=>  'required|mimes:jpeg,bmp,png|max:2000',
			'roomfeature.*'     =>  'required|numeric',
			'qtyofroom'         =>  'required|numeric',
            'roomoftax'    		=>  'required|numeric',
        ]);

    	DB::beginTransaction();

        try{

                $userDetail = \Auth::user();

                
				
				$imageName = Storage::disk('website')->put('Room',$request->file('roomphoto'));
                
                $room = new Room;

                $room->RoomName       	= 	$request->RoomName;
                $room->RoomStatus  		= 	$request->propertytype;
                $room->PropertyId    	= 	$request->roomproperty;
                $room->Price       		= 	$request->RoomPrice;
                $room->RoomType      	= 	$request->RoomType;
                $room->QtyOfBed         = 	$request->qtyofbed;
				$room->AvailableQty 	=	$request->qtyofroom;
				$room->RoomDescription 	=	$request->roomdescription;
				$room->TaxAndCharges 	=	$request->roomoftax;
                $room->BedTypeID     	= 	$request->bedtype;
                $room->MaxOccupancy    	= 	$request->roomoccupancy;
                $room->RoomImage 		= 	$imageName;
				$room->RoomStatus      	= 	'Ready';

                $room->save();
				$room_id = $room->id;
				
				// dd($room_id);
				
				if(isset($request->roomfeature)){
					
					foreach($request->roomfeature as $myfeatures){
						
						$allmyroomfeatures = new RoomFeature;
						
						$allmyroomfeatures->RoomID       	= $room_id;
						$allmyroomfeatures->FeatureID  		= $myfeatures;
						
						$allmyroomfeatures->save();
						
					}
					
				}
				
            DB::commit();

            return redirect('/myhotels')->with('message', 'Created Successfully!');

        }
        catch (\Throwable $e) 
	    {
	    	DB::rollback();
	    }

        return redirect('/addroom')->with('message', 'Error in Creating!');
		
	}

    public function myallproperty(){

        $userDetail = \Auth::user();
		$property = Property::with('getHotelPics')->where('PropertyCreatedBy',$userDetail->id)->orderBy('PropertyId', 'DESC')->get();
        // dd($property);

        return view('hotelsviews.myallproperty',compact('property'));

    }
	
	
	public function mypropertystatus($id,$status){
		
		
		if($status == 'active'){

            $mystatus = 1;
			
			$roomstatus = "Ready";

        }elseif($status == 'notactive'){

            $mystatus = 2;
			
			$roomstatus = "NotReady";

        }elseif($status == 'Draft'){

            $mystatus = 0;
			
			$roomstatus = "NotReady";

        }else{

            $mystatus = 0;
			
			$roomstatus = "NotReady";

        }
		
		// dd($id,$mystatus);

        if($mystatus || $mystatus == 0 ){
         

            // dd($mystatus);
            $property 	= 	Property::where('PropertyID',$id)
						->update([
                                    'Published'=> $mystatus,
									'Admin_status'=> $mystatus,
                        ]);
						
						
			$room	=	Room::where('PropertyId',$id)
							->update([
									'RoomStatus' 	=>	$roomstatus,
                                ]);
								
            // dd($data['allmatches']);
        }


        return redirect('/myhotels');
		
		
	}
	
	public function myallroom($id){
		$room = Room::with('gethotelrooms')->where('PropertyID',$id)->get();
		
        // dd($property);

        return view('hotelsviews.myallrooms',compact('room'));
	}
	
	public function myroomstatus($id,$status){
		
		
		if($status == 'active'){

            $mystatus = 1;
			
			$roomstatus = "Ready";

        }elseif($status == 'notactive'){
			
			$mystatus = 0;
			
			$roomstatus = "NotReady";

        }else{

            $mystatus = 0;
			
			$roomstatus = "NotReady";

        }
		
		// dd($id,$mystatus);

        if($mystatus || $mystatus == 0 ){
         

            // dd($mystatus);

            $room 	= 	Room::where('id',$id)
						->update([
                                    'RoomStatus'=> $roomstatus,
                        ]);
								
            // dd($data['allmatches']);
        }
//        return redirect('/myrooms');
	}

    public function editroom($id){
		
         $userDetail = \Auth::user();

         $data['room'] = Room::with('roomFeatureList')->where('id',$id)->first();
		 
		 $data['RoomFeatureList'] = RoomFeatureList::all();
		 
		 $data['property'] = Property::where('PropertyCreatedBy',$userDetail->id)->get();
		 
		 $data['bedtype'] = BedType::get();
        $data['room_types'] = RoomType::get();
        // return $data;

        return view('hotelsviews.editmyroom',compact('data'));

    }

    public function myupdaterooms(Request $request){

        // dd($request);

        $ErrorMsg = "";
    	$data = [];
		
        $validator = $request->validate([  
            'roomid'         	=>  'required|numeric',
            'RoomName'     		=> 	'required',
            'RoomPrice'         =>  'required|numeric',
            'roomproperty'      =>  'required|numeric',
            'RoomType'          =>  'required',
            'qtyofbed'          =>  'required|numeric',
            'bedtype'    		=>  'required|numeric',
            'roomoccupancy'     =>  'required|numeric',
            'qtyofroom'         =>  'required|numeric',
            'roomoftax'    		=>  'required|numeric',
            'roomdescription'	=>  'required',
            'roomfeature.*'     =>  'required|numeric',
			'roomphoto'   		=>  'required|mimes:jpeg,bmp,png|max:2000',
			
        ]);

        DB::beginTransaction();

        try{

                // dd($request);

                $userDetail = \Auth::user();
				$imageName = Storage::disk('website')->put('Room',$request->file('roomphoto'));
                $roombasicupdate = Room::where('id', $request->roomid)
                        ->update([
                                    'RoomName'         	=>  $request->RoomName,
                                    'PropertyId'        =>  $request->roomproperty,
                                    'Price'    			=>  $request->RoomPrice,
                                    'RoomType'      	=>  $request->RoomType,
                                    'QtyOfBed'          =>  $request->qtyofbed,
                                    'BedTypeID'         =>  $request->bedtype,
                                    'MaxOccupancy'      =>  $request->roomoccupancy,
                                    'RoomFeatures'     	=>  "",
                                    'RoomImage'         =>  $imageName,
                                    'RoomDescription' 	=>  $request->roomdescription,
                                    'TaxAndCharges'     =>  $request->roomoftax,
                                    'AvailableQty'     	=>  $request->qtyofroom,
                                ]);
								
								
			if(isset($request->roomfeature)){
				
					RoomFeature::where('RoomID',$request->roomid)->delete();
					
					foreach($request->roomfeature as $myfeatures){
						
						$allmyroomfeatures = new RoomFeature;
						
						$allmyroomfeatures->RoomID       	= $request->roomid;
						$allmyroomfeatures->FeatureID  		= $myfeatures;
						
						$allmyroomfeatures->save();
						
					}
					
				}
                
                

            DB::commit();

            return redirect('/myrooms/'.$request->roomproperty)->with('message', 'Updated Successfully!');

        }
        catch (\Throwable $e) 
	    {
	    	DB::rollback();
            
	    }

        return redirect('/myrooms/'.$request->roomproperty)->with('message', 'Error in Update!');

    }

    public function removeguestpassphoto($id){

        // dd($id);

            // dd($mystatus);

            GuestPassPhoto::where('PhotoID',$id)->delete();

            // dd($data['allmatches']);



    }

    public function removeguestpassprogramdetail($id){

        // dd($id);

            // dd($mystatus);

            Guestdpassprogramdetail::where('GuestProDetail_id',$id)->delete();

            // dd($data['allmatches']);
    }
	
	public function roomreservation(){
        $roomID = Property::where('PropertyCreatedBy',Auth::id())->pluck('PropertyID');
        $bookings = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $bookings = $bookings->whereIn('PropertyID',$roomID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
        $room = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $room =  $room->whereIn('PropertyID',$roomID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
        $mytotalprice = 0;
        foreach($room as $rooms){
            if ($rooms->Insurance == 1 && $rooms->Donation == 0) {
                $totalprice = $rooms->TotalPrice - 10;
            } elseif ($rooms->Insurance == 0 && $rooms->Donation == 1) {
                $totalprice = $rooms->TotalPrice - $rooms->Donation_amount;
            } elseif (($rooms->Insurance == 1 && $rooms->Insurance == 1)) {
                $totalprice = $rooms->TotalPrice - $rooms->Donation_amount - 10;
            } else {
                $totalprice = $rooms->TotalPrice;
            }
            $mytotalprice += $totalprice;
        }
        $roomswithdraw = Roomreservation::where('withdraw',NULL);
        $roomswithdraw = $roomswithdraw->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $roomswithdraw = $roomswithdraw->whereIn('PropertyID',$roomID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
        $myTotalPrice = 0;
        foreach ($roomswithdraw as $roomswithdraws) {
            if ($roomswithdraws->Insurance == 1 && $roomswithdraws->Donation == 0) {
                $totalprice = $roomswithdraws->TotalPrice - 10;
            } elseif ($roomswithdraws->Insurance == 0 && $roomswithdraws->Donation == 1) {
                $totalprice = $roomswithdraws->TotalPrice - $roomswithdraws->Donation_amount;
            } elseif (($roomswithdraws->Insurance == 1 && $roomswithdraws->Insurance == 1)) {
                $totalprice = $roomswithdraws->TotalPrice - $roomswithdraws->Donation_amount - 10;
            } else {
                $totalprice = $roomswithdraws->TotalPrice;
            }
            $myTotalPrice += $totalprice;
        }
        $spEarningWithdraw = number_format($myTotalPrice/ 100 * 80??'0', 2, '.', ',');
        $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
        $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
		$roompassreserves = Roomreservation::whereIn('PropertyID',$roomID)->with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
		$wthdrawed_amount = WithdrawRequest::where('vendor_id',Auth::id())->where('category','2')->where('is_request_accepted','1')->pluck('requested_amount')->sum();
        return view('hotelsviews.hotelreservations',compact('roompassreserves','wthdrawed_amount','mytotalprice', 'bookings', 'spEarning', 'appFee','spEarningWithdraw'));
		
	}
	
	public function roomreserveone($id){
		$roomreserves = Roomreservation::with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrdersbyuser','getRoomOrdersbyuserprofile')->where('ReceiptNum',$id)->groupBy('ReceiptNum')->first();
		return view('hotelsviews.roomreservation_detail',compact('roomreserves'));
		
		
	}
	
	
	public function myroombooking(){
        if(auth()->user()->hasrole('HotelsAdmin')) {
         $PropertyID= Property::where('PropertyCreatedBy',Auth()->user()->id)->pluck('PropertyID');
        $roombooking = Roomreservation::whereIn('PropertyID',$PropertyID)->with('getRoomOrderssupadmin')->groupBy('ReceiptNum')->get();
            return view('superadminviews.roomcalender', compact('roombooking'));
        }

	}
    
}
