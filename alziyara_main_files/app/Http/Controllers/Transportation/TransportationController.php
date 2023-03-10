<?php

namespace App\Http\Controllers\Transportation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VendorTransportRouteController;
use App\Http\Requests;

use App\Transportation;
use App\Transportationphoto;
use App\Transportationreview;
use App\Transportationroute;
use App\Transportationtype;
use App\TransportMainRoute;
use App\VehicleFeaturesList;
use App\VendorTransportRoute;
use Illuminate\Http\Request;
use Auth;
use Storage;
use DB;
use App\TransportReservation;

class TransportationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 5000;

            if (!empty($keyword)) {
                $transportation = Transportation::where('VehicleRouteID', 'LIKE', "%$keyword%")
                ->orWhere('TransportationOwnerID', 'LIKE', "%$keyword%")
                ->orWhere('TransportationTypeID', 'LIKE', "%$keyword%")
                ->orWhere('RouteID', 'LIKE', "%$keyword%")
                ->orWhere('Price', 'LIKE', "%$keyword%")
                ->orWhere('FeatureID', 'LIKE', "%$keyword%")
                ->orWhere('NameofVehicle', 'LIKE', "%$keyword%")
                ->orWhere('NumberPlate', 'LIKE', "%$keyword%")
                ->orWhere('DriverName', 'LIKE', "%$keyword%")
                ->orWhere('DriverContactNum', 'LIKE', "%$keyword%")
                ->orWhere('Description', 'LIKE', "%$keyword%")
                ->orWhere('FeaturesAndAmenities', 'LIKE', "%$keyword%")
                ->orWhere('Type', 'LIKE', "%$keyword%")
                ->orWhere('Status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if(Auth::user()->hasrole('admin') || Auth::user()->hasrole('SuperAdmin')){
                    $transportation = Transportation::paginate($perPage);
//                    return $transportation = Transportation::with('getTransporttype')->get();

                }
                else{
                    $transportation = Transportation::with('getTransportRoutes.getTransportmainroute')->where('TransportationOwnerID',Auth::user()->id)->orderBy('VehicleRouteID', 'DESC')->paginate($perPage);
                }
            }
            return view('transportation.transportation.index', compact('transportation'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $transportationTypes = Transportationtype::get();
        $transportationRoutes = TransportMainRoute::get();
        $transportationFeaturesList = VehicleFeaturesList::get();
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('transportation.transportation.create',compact('transportationTypes','transportationRoutes','transportationFeaturesList'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        return $request;
//        $requestData = $request->all();
//        foreach ($requestData as $data){
//            return $data;
//        }
//        return sizeof($requestData['RouteID']);
//        die();
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $ErrorMsg = "";
            $data = [];
            foreach ($request->RouteIDs as $RouteID){
            $validator = $request->validate([
                'TransportationTypeID'   =>  'required',
                'RouteIDs.*'             =>  'required',
                'OneWayRouteprice.*'     =>  'required',
                'TwoWayRouteprice.*'     =>  'required',
                'FeatureID.*'            =>  'required',
                'NameofVehicle'          =>  'required',
                'NumberPlate'            =>  'required|unique:transportationtype_routes_price,NumberPlate,Null,VehicleRouteID,RouteID,'.$RouteID,
                'DriverName'             =>  'required',
                'DriverContactNum'       =>  'required',
                'Description'            =>  'required',
//                'Type'                   =>  'required',
                'Status'                 =>  'required',
//                'status_from_admin'      =>  'required',
                'PhotoTitle.*'           =>  'required',
                'PhotoTitleupload.*'     =>  'required',
                'AltText.*'              =>  'required',
                'AltTextupload.*'        =>  'required',
                'PhotoLocation.*'        =>  'required|mimes:jpeg,bmp,png|max:2000',
                'PhotoLocationupload.*'  =>  'required|mimes:jpeg,bmp,png|max:2000',
            ],
                ['NumberPlate.unique'    => 'This Number plate is already registered for this route...']);
            }
            DB::beginTransaction();
            try{
                $requestData = $request->all();
                    $requestData['FeatureID'] = implode(', ', $request->FeatureID);
                        $transportation = Transportation::create($requestData);
                $routeCount = sizeof($requestData['RouteIDs']);
                for ($i = 0; $i < $routeCount; $i++) {
                    $requestDataVehicleRoutes['VehicleRouteID'] = $transportation->VehicleRouteID;
                    $requestDataVehicleRoutes['RouteID'] = $requestData['RouteIDs'][$i];
                    $requestDataVehicleRoutes['Price'] = $requestData['OneWayRouteprice'][$i];
                    $requestDataVehicleRoutes['TwoWayPrice'] = $requestData['TwoWayRouteprice'][$i];
//                return $requestDataVehicleRoutes;
                    VendorTransportRoute::create($requestDataVehicleRoutes);
                }
                        foreach($request->file('PhotoLocation') as $key => $file){
                            $imageName = Storage::disk('website')->put('Transportations', $file);
                            $selectedimageindex = (int)$request->Showimage[0];
                            if($key == $selectedimageindex ){
                                $flag = 1;
                            }else{
                                $flag = 0;
                            }
                            Transportationphoto::create([
                                "TransportationID"    => $transportation->VehicleRouteID,
                                "PhotoTitle"     => $request->PhotoTitle[$key],
                                "AltText"        => $request->AltText[$key],
                                "PhotoLocation"  => $imageName,
                                "SortOrder"      => 1,
                                "DefaultFlag"    => $flag,
                            ]);
                        }
                        Transportationreview::create([
                            "VehicleRouteID"=>$transportation->VehicleRouteID,
                            "Name"=>Auth::user()->name,
                            "EmailAddress"=>Auth::user()->email,
                            "Rating"=>0, "IPAddress"=>\Request::getClientIp(true),
                            "Flag"=>0
                        ]);

                DB::commit();
            }
            catch (\Throwable $e) {
                DB::rollback();
                return redirect('transportation/transportation')->with('error', 'Error!');
            }
            return redirect('transportation/transportation')->with('message', 'Transportation added!');
//        }
//            return response(view('403'), 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $transportation = Transportation::findOrFail($id);
            $transportationTypes = Transportationtype::get();
            $transportationRoutes = TransportMainRoute::get();
            $transportationFeaturesList = VehicleFeaturesList::get();
            return view('transportation.transportation.show', compact('transportation','transportationTypes','transportationRoutes','transportationFeaturesList'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $transportationTypes = Transportationtype::get();
        $transportationRoutes = TransportMainRoute::get();
        $transportationFeaturesList = VehicleFeaturesList::get();
//        return $transportationFeaturesList;
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $transportation = Transportation::with('getTransportPics','getTransportRoutes')->with('getTransportmainroute')->with('getTransporttype')->findOrFail($id);
//            return $transportation->FeatureID;
//            return $str_arr = preg_split ("/\,/", $transportation->FeatureID);
            return view('transportation.transportation.edit', compact('transportation','transportationTypes','transportationRoutes','transportationFeaturesList'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {

//        return $request;
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $ErrorMsg = "";
            $data = [];
            $validator = $request->validate([
                'TransportationTypeID'         =>  'required',
                'RouteIDs.*'              => 	'required',
                'OneWayRouteprice.*'      =>  'required',
                'TwoWayRouteprice.*'      =>  'required',
                'FeatureID'          =>  'required',
                'NameofVehicle'         =>  'required',
//                'NumberPlate'            =>  'required|unique:transportationtype_routes_price,NumberPlate,'.$request->VehicleRouteID.',VehicleRouteID,RouteID,'.$request->RouteID,
                'DriverName'          =>  'required',
                'DriverContactNum'    =>  'required',
                'Description'      =>  'required',
                'Status'      =>  'required',
                'status_from_admin'      =>  'required',
                'PhotoTitle.*'          =>  'required',
                'PhotoTitleupload.*'    =>  'required',
                'AltText.*'             =>  'required',
                'AltTextupload.*'       =>  'required',
                'PhotoLocation.*'       =>  'required|mimes:jpeg,bmp,png|max:2000',
                'PhotoLocationupload.*' =>  'required|mimes:jpeg,bmp,png|max:2000',
            ],
                ['NumberPlate.unique'    => 'This Number plate is already registered for this route...']

            );
//            DB::beginTransaction();
//            try{
            $requestData = array_except($request->all(), ['_token','RouteIDs','OneWayRouteprice','TwoWayRouteprice','photoidupload','PhotoTitleupload','AltTextupload','photoid','Showimage','PhotoTitle','AltText','PhotoLocation']);
                $requestData['FeatureID'] = implode(', ', $request->FeatureID);
                $transportation = Transportation::findOrFail($request->VehicleRouteID);
                $transportation::where('VehicleRouteID', $request->VehicleRouteID)->update($requestData);
                if ($request->hasfile('PhotoLocationupload')){
                    $uploadimageindex = 0;
                    foreach($request->file('PhotoLocationupload') as $key => $file){
                        $imageNameupload = Storage::disk('website')->put('Transportations', $file);
                        $user = Transportationphoto::where('VehicleRouteID', $request->VehicleRouteID)
                            ->where('PhotoID', $request->photoidupload[$key])
                            ->update([
                                "TransportationID"     => $request->PhotoTitleupload[$key],
                                "AltText"        => $request->AltTextupload[$key],
                                "PhotoLocation"  => $imageNameupload,
                                "SortOrder"      => 1,
                            ]);
                    }
                }
                if ($request->hasfile('PhotoLocation')) {
                    foreach($request->file('PhotoLocation') as $key => $file){
                        $imageName = Storage::disk('website')->put('Transportations', $file);
                        $user = Transportationphoto::create([
                            "TransportationID"    => $request->VehicleRouteID,
                            "PhotoTitle"     => $request->PhotoTitle[$key],
                            "AltText"        => $request->AltText[$key],
                            "PhotoLocation"  => $imageName,
                            "SortOrder"      => 1,
                            "DefaultFlag"    => 0,
                        ]);
                    }
                }
                $propertyallphotos = Transportationphoto::where('TransportationID', $request->VehicleRouteID)->get();
                foreach($propertyallphotos as $key => $propertypassphotosids){
                    $selectedimageindex = (int)$request->Showimage[0];
                    if($key == $selectedimageindex ){
                        $flag = 1;
                    }else{
                        $flag = 0;

                    }
                    $transportationphotos = Transportationphoto::where('TransportationID', $request->VehicleRouteID)
                        ->where('PhotoID', $propertypassphotosids->PhotoID)
                        ->update([
                            "DefaultFlag"      => $flag,
                        ]);
                }
            VendorTransportRoute::where('VehicleRouteID',$request->VehicleRouteID)->delete();
            $routeCount = sizeof($request->RouteIDs);
            for ($i = 0; $i < $routeCount; $i++) {
                $requestDataVehicleRoutes['VehicleRouteID'] = $request->VehicleRouteID;
                $requestDataVehicleRoutes['RouteID'] = $request->RouteIDs[$i];
                $requestDataVehicleRoutes['Price'] = $request->OneWayRouteprice[$i];
                $requestDataVehicleRoutes['TwoWayPrice'] = $request->TwoWayRouteprice[$i];
                VendorTransportRoute::create($requestDataVehicleRoutes);
            }
//                DB::commit();
//                return redirect('transportation/transportation')->with('message', 'Transportation Updated Successfully!');
//            }
//            catch (\Throwable $e) {
//                DB::rollback();
//            }
//            return redirect('transportation/transportation')->with('message', 'Error in Update!');

            return redirect('transportation/transportation')->with('flash_message', 'Transportation updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $photos_arr = [];
        foreach (Transportationphoto::where('TransportationID',$id)->get() as $photo){
            array_push($photos_arr,$photo->PhotoLocation);
        }
        $model = str_slug('transportation','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            DB::beginTransaction();
            try{
                Transportation::destroy($id);
                Transportationphoto::where('TransportationID',$id)->delete();
                Transportationreview::where('VehicleRouteID',$id)->delete();
                VendorTransportRoute::where('VehicleRouteID',$id)->delete();
                DB::commit();
                foreach ($photos_arr as $photo){
                    Storage::disk('website')->delete($photo);
                }
                return redirect('transportation/transportation')->with('flash_message', 'Transportation deleted!');
            }
            catch (\Throwable $e) {
                DB::rollback();
            }
        }
        return response(view('403'), 403);
    }
    public function transportImageRemove($id){
        Transportationphoto::where('PhotoID',$id)->delete();
    }
	
	public function transportreservation(){
//        return Auth::id();
        $transportID = Transportationroute::where('TransportationOwnerID',Auth::id())->pluck('VehicleRouteID');
        $bookings = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $bookings = $bookings->whereIn('VehicleRouteID',$transportID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
        $transport = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $transport = $transport->whereIn('VehicleRouteID',$transportID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->get();
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
        $transportwithdraw = TransportReservation::where('withdraw',NULL);
        $transportwithdraw = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
        $transportwithdraw = $transportwithdraw->whereIn('VehicleRouteID',$transportID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
        $myTotalPrice = 0;
        $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
        foreach ($transportwithdraw as $transport) {
            if ($transport->Insurance == 1 && $transport->Donation == 0) {
                $totalprice = $transport->TotalPrice - 10;
            } elseif ($transport->Insurance == 0 && $transport->Donation == 1) {
                $totalprice = $transport->TotalPrice - $transport->Donation_amount;
            } elseif (($transport->Insurance == 1 && $transport->Insurance == 1)) {
                $totalprice = $transport->TotalPrice - $transport->Donation_amount - 10;
            } else {
                $totalprice = $transport->TotalPrice;
            }
            $myTotalPrice += $totalprice;
        }
        $spEarningWithdraw = number_format($myTotalPrice/ 100 * 80??'0', 2, '.', ',');
        $transportreserves = TransportReservation::whereIn('VehicleRouteID',$transportID)->with('getTransportOrders','getTransportmainrouteforreservation')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
        $transportreservesstats = TransportReservation::whereIn('VehicleRouteID',$transportID)->with('getTransportOrderssupadmin','getTransportmainrouteforreservation')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
        return view('transportation.transportation.transportreservations',compact('transportreserves','bookings','transport','mytotalprice','spEarning','spEarningWithdraw'));
		
	}
	
	public function transportreserveone($id)
    {
            $transportreserves = TransportReservation::with('getTransportOrders', 'getTransportmainrouteforreservation', 'getTransportOrdersbyuser', 'getTransportOrdersbyuserprofile')->where('ReceiptNum', $id)->first();
            return view('transportation.transportation.transportreservation_details', compact('transportreserves'));
        }

	public function mytransportbooking(){
    if (auth()->user()->hasrole('TransportAdmin')) {
        $VehicleRouteID = Transportation::where('TransportationOwnerID',Auth::id())->pluck('VehicleRouteID');
        $transportbooking = TransportReservation::whereIn('VehicleRouteID',$VehicleRouteID)->with('getTransportOrderssupadmin')->groupBy('ReceiptNum')->get();
        return view('superadminviews.transportcalender', compact('transportbooking'));

    }
    }
}
