<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\GuestPass;
use App\GuestPassReview;
use App\GuestPassPhoto;
use App\GuestpassReservation;
use App\Guestdpassprogramdetail;
use Storage;
use Auth;
use App\City;

class guestpasscontroller extends Controller
{
    public function addguests() {
		
		$data['cities'] = City::where('citystatus',1)->get();

        return view('website.addguestspass',compact('data'));
    }

    public function createguests(Request $request) {

        // dd($request);

        $ErrorMsg = "";
    	$data = [];

        $validator = $request->validate([  
            'GuestPassName'     =>  'required',
            'GuestPassLocation' => 	'required',
            'Price'		        =>  'required|numeric',
            'MaxOccupancy'      =>  'required|numeric',
            'GuestPassDesc'     =>  'required',
            'HouseRules'        =>  'required',
            'scheduledays'      =>  'required',
            'GuestPassstartTime'=>  'required',
            'GuestPassendTime'  =>  'required',
            'PhotoTitle.*'      =>  'required',
            'AltText.*'         =>  'required',
            'PhotoLocation.*'   =>  'required|mimes:jpeg,jpg,png|max:2000',
            'programtime.*'     =>  'required',
            'programtimedes.*'  =>  'required',
        ]);

    	DB::beginTransaction();

        try{

            

            // dd($request);

                $userDetail = \Auth::user();

                $scheduledays = implode(",",$request->scheduledays);

                $dteDiff  = date('G:i', strtotime($request->GuestPassstartTime) - strtotime($request->GuestPassendTime));

                // dd($dteDiff);

                $starttime = date("g:iA", strtotime($request->GuestPassstartTime));

                $endtime = date("g:iA", strtotime($request->GuestPassendTime));

                $GuestPassTime = $starttime.' to '.$endtime;

                // dd($GuestPassTime);
                
                $guestpassbasic = new GuestPass;

                $guestpassbasic->GuestPassName         = $request->GuestPassName;
                $guestpassbasic->GuestPassDesc         = $request->GuestPassDesc;
                $guestpassbasic->GuestPassItinerary    = $request->team_description;
                $guestpassbasic->GuestPassStatus       = "Active";
                $guestpassbasic->Price                 = $request->Price;
                $guestpassbasic->MaxOccupancy          = $request->MaxOccupancy;
                $guestpassbasic->GuestPassTime         = $GuestPassTime;
                $guestpassbasic->GuestPassLocation     = $request->GuestPassLocation;
                $guestpassbasic->HouseRules            = $request->HouseRules;
                $guestpassbasic->GuestPassTimeDuration = $dteDiff;
                $guestpassbasic->ScheduleDays          = $scheduledays;
                $guestpassbasic->DisplayOnHomePage     = " ";
                $guestpassbasic->GuestPassCreatedBy    = $userDetail->id;

                $guestpassbasic->save();
                $guestpassbasic->id; 
            

            if ($request->hasfile('PhotoLocation')) {
                
                foreach($request->file('PhotoLocation') as $key => $file){

                    $imageName = Storage::disk('website')->put('GuestPasses', $file);
					
					$selectedimageindex = (int)$request->Showimage[0];
					
					// dd($selectedimageindex);
					
					if($key == $selectedimageindex ){
						
						$flag = 1;
						
						// dd($key);
						
					}else{
						
						$flag = 0;
						
					}

                    $user = GuestPassPhoto::create([
                        "GuestPassID"    => $guestpassbasic->id,
                        "PhotoTitle"     => $request->PhotoTitle[$key],
                        "AltText"        => $request->AltText[$key],
                        "PhotoLocation"  => $imageName,
                        "SortOrder"      => 1,
                        "DefaultFlag"    => $flag,
                    ]);

                }
            }

            foreach($request->programtime as $key => $program){

                $user = Guestdpassprogramdetail::create([
                    "GuestPassID"          => $guestpassbasic->id,
                    "GuestProDetailTime"   => $request->programtime[$key],
                    "GuestProDetailDis"    => $request->programtimedes[$key],
                ]);
                
            }

            $userIpAddress = \Request::getClientIp(true);

            $user = GuestPassReview::create([
                "GuestPassID"   => $guestpassbasic->id,
                "ReviewerName"  => "Admin",
                "EmailAddress"  => "admin@gmail.com",
                "Rating"        => 1,
                "Description"   => "Admin Description",
                "IPAddress"     => $userIpAddress,
                "CreatedOn"     => date("Y/m/d h:i:sa"),
            ]);

            DB::commit();

            return redirect('/myguestspasses')->with('message', 'Created Successfully!');

        }
        catch (\Throwable $e) 
	    {
	    	DB::rollback();
	    }

        return redirect('/addguestspasses')->with('message', 'Error in Creating!');
    }

    public function myallguestspass(){

        $userDetail = \Auth::user();

        $guestPass = GuestPass::with('getGuestPassDetails')->where('GuestPassCreatedBy',$userDetail->id)->get();

        // dd($guestPass);

        return view('website.myguestspass',compact('guestPass'));

    }

    public function myeditguestspass($gpid){


        $data['guestPass'] = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails')->where('GuestPassID',$gpid)->first();

        // return $guestPass;
		
		$data['cities'] = City::where('citystatus',1)->get();

        return view('website.editmyguestspass',compact('data'));

    }

    public function updateguests(Request $request){

        // dd($request);

        $ErrorMsg = "";
    	$data = [];

    	

        $validator = $request->validate([  
            'GuestPassName'         =>  'required',
            'GuestPassLocation'     => 	'required',
            'Price'		            =>  'required|numeric',
            'MaxOccupancy'          =>  'required|numeric',
            'GuestPassDesc'         =>  'required',
            'HouseRules'            =>  'required',
            'scheduledays'          =>  'required',
            'GuestPassstartTime'    =>  'required',
            'GuestPassendTime'      =>  'required',
            'PhotoTitle.*'          =>  'required',
            'PhotoTitleupload.*'    =>  'required',
            'AltText.*'             =>  'required',
            'AltTextupload.*'       =>  'required',
            'PhotoLocation.*'       =>  'required|mimes:jpeg,bmp,png|max:2000',
            'PhotoLocationupload.*' =>  'required|mimes:jpeg,bmp,png|max:2000',
            'programtime.*'         =>  'required',
            'programtimeupload.*'   =>  'required',
            'programtimedes.*'      =>  'required',
            'programtimedesupload.*'=>  'required',
        ]);

        DB::beginTransaction();

        try{

                // dd($request);

                $userDetail = \Auth::user();

                $scheduledays = implode(",",$request->scheduledays);

                $dteDiff  = date('G:i', strtotime($request->GuestPassstartTime) - strtotime($request->GuestPassendTime));

                // dd($dteDiff);

                $starttime = date("g:iA", strtotime($request->GuestPassstartTime));

                $endtime = date("g:iA", strtotime($request->GuestPassendTime));

                $GuestPassTime = $starttime.' to '.$endtime;

                // dd($GuestPassTime);
                
                $guestpassbasic = GuestPass::where('GuestPassID', $request->GuestPassid)
                        ->update([
                                    'GuestPassName'         =>  $request->GuestPassName,
                                    'GuestPassDesc'         =>  $request->GuestPassDesc,
                                    'GuestPassItinerary'    =>  $request->team_description,
                                    'GuestPassStatus'       =>  "Active",
                                    'Price'                 =>  $request->Price,
                                    'MaxOccupancy'          =>  $request->MaxOccupancy,
                                    'GuestPassTime'         =>  $GuestPassTime,
                                    'GuestPassLocation'     =>  $request->GuestPassLocation,
                                    'HouseRules'            =>  $request->HouseRules,
                                    'GuestPassTimeDuration' =>  $dteDiff,
                                    'ScheduleDays'          =>  $scheduledays,
                                    'DisplayOnHomePage'     =>  "",
                                    'GuestPassCreatedBy'    =>  $userDetail->id,
                                ]);
                
                // $guestpassbasic = new GuestPass;

                // $guestpassbasic->GuestPassName         = $request->GuestPassName;
                // $guestpassbasic->GuestPassDesc         = $request->GuestPassDesc;
                // $guestpassbasic->GuestPassItinerary    = $request->team_description;
                // $guestpassbasic->GuestPassStatus       = "NotActive";
                // $guestpassbasic->Price                 = $request->Price;
                // $guestpassbasic->MaxOccupancy          = $request->MaxOccupancy;
                // $guestpassbasic->GuestPassTime         = $GuestPassTime;
                // $guestpassbasic->GuestPassLocation     = $request->GuestPassLocation;
                // $guestpassbasic->HouseRules            = $request->HouseRules;
                // $guestpassbasic->GuestPassTimeDuration = $dteDiff;
                // $guestpassbasic->ScheduleDays          = $scheduledays;
                // $guestpassbasic->DisplayOnHomePage     = " ";
                // $guestpassbasic->GuestPassCreatedBy    = $userDetail->id;

                // $guestpassbasic->save();
                // $guestpassbasic->id; 
            

            if ($request->hasfile('PhotoLocationupload')) {
				
				$uploadimageindex = 0 ;
                
                foreach($request->file('PhotoLocationupload') as $key => $file){

                    // dd($request->PhotoLocationupload);

                    $imageNameupload = Storage::disk('website')->put('GuestPasses', $file);

                    $user = GuestPassPhoto::where('GuestPassID', $request->GuestPassid)
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
					

                    $imageName = Storage::disk('website')->put('GuestPasses', $file);

                    $user = GuestPassPhoto::create([
                        "GuestPassID"    => $request->GuestPassid,
                        "PhotoTitle"     => $request->PhotoTitle[$key],
                        "AltText"        => $request->AltText[$key],
                        "PhotoLocation"  => $imageName,
                        "SortOrder"      => 1,
						"DefaultFlag"    => 0,
                    ]);

                }
            }
			
			$guestspassallphotos = GuestPassPhoto::where('GuestPassID', $request->GuestPassid)->get();
			
			// return $guestspassallphotos;
			
			foreach($guestspassallphotos as $key => $guestspassphotosids){
				
				$selectedimageindex = (int)$request->Showimage[0];
				
				if($key == $selectedimageindex ){
						
						$flag = 1;
						
						// dd($key);
						
					}else{
						
						$flag = 0;
						
					}
				
				$myguestspassphotos = GuestPassPhoto::where('GuestPassID', $request->GuestPassid)
                            ->where('PhotoID', $guestspassphotosids->PhotoID)
                            ->update([
                            "DefaultFlag"      => $flag,
                        ]);
				
			}
			
			
            if ($request->programtimeupload) {

                foreach($request->programtimeupload as $key => $program){

                    $user = Guestdpassprogramdetail::where('GuestPassID', $request->GuestPassid)
                    ->where('GuestProDetail_id', $request->programidupload[$key])
                    ->update([
                        "GuestPassID"          => $request->GuestPassid,
                        "GuestProDetailTime"   => $request->programtimeupload[$key],
                        "GuestProDetailDis"    => $request->programtimedesupload[$key],
                    ]);
                    
                }
            }

            if ($request->programtime) {

                foreach($request->programtime as $key => $program){

                    $user = Guestdpassprogramdetail::create([
                        "GuestPassID"          => $request->GuestPassid,
                        "GuestProDetailTime"   => $request->programtime[$key],
                        "GuestProDetailDis"    => $request->programtimedes[$key],
                    ]);
                    
                }

            }

						// $userIpAddress = \Request::getClientIp(true);

						// $user = GuestPassReview::create([
						//     "GuestPassID"   => $guestpassbasic->id,
						//     "ReviewerName"  => "Admin",
						//     "EmailAddress"  => "admin@gmail.com",
						//     "Rating"        => 1,
						//     "Description"   => "Admin Description",
						//     "IPAddress"     => $userIpAddress,
						//     "CreatedOn"     => date("Y/m/d h:i:sa"),
						// ]);

            DB::commit();

            return redirect('/myguestspasses')->with('message', 'Updated Successfully!');

        }
        catch (\Throwable $e) 
	    {
	    	DB::rollback();
            
	    }

        return redirect('/myguestspasses')->with('message', 'Error in Update!');

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
    
	public function guestpassreservation(){
        $guestID = GuestPass::where('GuestPassCreatedBy',Auth::id())->pluck('GuestPassID');
        $bookings = GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->whereIn('GuestPassID',$guestID);
        $bookings = $bookings->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
        $guestpass = GuestpassReservation::whereIn('GuestPassID',$guestID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID');
        $guestpass = $guestpass->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->get();
        $mytotalprice = 0;
        foreach ($guestpass as $guestpas) {
            if ($guestpas->Insurance == 1 && $guestpas->Donation == 0) {
                $totalprice = $guestpas->TotalPrice - 10;
            } elseif ($guestpas->Insurance == 0 && $guestpas->Donation == 1) {
                $totalprice = $guestpas->TotalPrice - $guestpas->Donation_amount;
            } elseif (($guestpas->Insurance == 1 && $guestpas->Insurance == 1)) {
                $totalprice = $guestpas->TotalPrice - $guestpas->Donation_amount - 10;
            } else {
                $totalprice = $guestpas->TotalPrice;
            }
            $mytotalprice += $totalprice;
        }
        $guestwithdraw = GuestpassReservation::whereIn('GuestPassID',$guestID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID');
        $guestwithdraw = $guestwithdraw->where('withdraw',NULL);
        $guestwithdraw = $guestwithdraw->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->get();
        $myTotalPrice = 0;
        foreach ($guestwithdraw as $guest) {
            if ($guest->Insurance == 1 && $guest->Donation == 0) {
                $totalprice = $guest->TotalPrice - 10;
            } elseif ($guest->Insurance == 0 && $guest->Donation == 1) {
                $totalprice = $guest->TotalPrice - $guest->Donation_amount;
            } elseif (($guest->Insurance == 1 && $guest->Insurance == 1)) {
                $totalprice = $guest->TotalPrice - $guest->Donation_amount - 10;
            } else {
                $totalprice = $guest->TotalPrice;
            }
            $myTotalPrice += $totalprice;
        }
        $spEarningWithdraw = number_format($myTotalPrice/ 100 * 80??'0', 2, '.', ',');
        $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
        $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
        $guestpassreserves = GuestpassReservation::with('getGuestPassOrders')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
		return view('website.guestspassreservations',compact('guestpassreserves','mytotalprice','bookings','spEarning','appFee','spEarningWithdraw'));
		
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
                                    'GuestPassStatus'=> $mystatus,
                                ]);


            // dd($data['allmatches']);

        
        }


        return redirect('/allguestpasses');

    }
	
	
	public function guestpassreserveone($id){
		
		// dd($id);
		
		 $guestpassreserves = GuestpassReservation::with('getGuestPassOrders','getGuestPassOrdersbyuser','getGuestPassOrdersbyuserprofile')->where('ReceiptNum',$id)->first();
		
		// dd($guestpassreserves);
		
		return view('website.guestpassreservation_detail',compact('guestpassreserves'));
	
	}
	
	public function myguestpassbooking(){
        if(auth()->user()->hasrole('GuestsPassAdmin')) {
            $GuestPassID= GuestPass::where('GuestPassCreatedBy',Auth::id())->pluck('GuestPassID');
            $guestpassbooking = GuestpassReservation::whereIn('GuestPassID',$GuestPassID)->with('getGuestPassOrderssupadmin')->get();
            return view('superadminviews.guestpasscalender', compact('guestpassbooking'));
        }
	}
}
