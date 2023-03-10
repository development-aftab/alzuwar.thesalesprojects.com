<?php

namespace App\Http\Controllers;

use App\City;
use App\PackageDealReview;
use App\GuideCity;
use App\Guides_Review;
use App\PackageDealType;
use App\PropertyReview;
use App\Transportationreview;
use App\Transportationtype;
use function Couchbase\basicEncoderV1;
use function GuzzleHttp\Promise\all;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use DB;
use App\GuestPass;
use App\Room;
use App\Guide;
use App\GuideLanguage;
use App\GuestPassReview;
use App\Transportationroute;
use App\Property;
use App\PropertyPhoto;
use App\User;
use App\Profile;
use App\GuestpassReservation;
use App\PropertyFavorite;
use App\ManageSetting;
use App\PackageDealPhoto;
use App\TransportMainRoute;
use App\TransportationPhoto;
use Illuminate\Support\Str;
Use Redirect;
use View;
use Session;
use Auth;
use Storage;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Roomreservation;
use App\TransportReservation;
use App\Search;
use App\GuideReservation;
//stripe

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Price;
use Stripe\StripeClient;
use App\Subscription;
use Laravel\Cashier\Cashier;


class WebsiteController extends Controller
{
    public function __construct()
    {
    //its just a dummy data object.
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
        header('Access-Control-Allow-Origin: *');
        $cityNames = GuestPass::where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->groupBy('GuestPassLocation')->get('GuestPassLocation');
    // Sharing is caring
    View::share('cityNames', $cityNames);
    }
    public function index(){
        $packageType = PackageDealType::get();
        $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
        $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
    	return view('website.index',compact('transportation_routes_from','transportation_routes_to','packageType'));
    }//end index.
    public function myhotels(Request $request){
        $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewAverage');
        $data = $hotelsdata->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getHotelReviewAverage)==0)continue;
            array_push($arr,$val->getHotelReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $propertyIdArray=[];
        foreach ($arr as $ar){
            array_push($propertyIdArray, $ar->PropertyID);
        }
        $ids = implode(',', $propertyIdArray);
        $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview','getUserFavoriteProperties')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        $route_name = $request->path();
        return view('website.myhotels',compact('hotelsData','route_name'));
    }
    public function hotelsSorting(Request $request, $sort_type){
        if ($sort_type == 'price_high_to_low'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getMinPriceRooms');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                array_push($arr,$val->getMinPriceRooms);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->Price < $arr[$j + 1]->Price){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyId);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getMinPriceRooms');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                array_push($arr,$val->getMinPriceRooms);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->Price > $arr[$j + 1]->Price){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyId);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewCount');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewCount)==0)continue;
                array_push($arr,$val->getHotelReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);

        }
        elseif ($sort_type == 'min_reviews'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewCount');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewCount)==0)continue;
                array_push($arr,$val->getHotelReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewAverage');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewAverage)==0)continue;
                array_push($arr,$val->getHotelReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewAverage');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewAverage)==0)continue;
                array_push($arr,$val->getHotelReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        return view('website.hotel_card_section',compact('hotelsData','route_name'));
    }
    public function hotelsSortingWithCity(Request $request, $sort_type, $city_name){
        if ($sort_type == 'price_high_to_low'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getMinPriceRooms');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                array_push($arr,$val->getMinPriceRooms);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->Price < $arr[$j + 1]->Price){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyId);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getMinPriceRooms');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                array_push($arr,$val->getMinPriceRooms);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->Price > $arr[$j + 1]->Price){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyId);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelReviewCount');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewCount)==0)continue;
                array_push($arr,$val->getHotelReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);

        }
        elseif ($sort_type == 'min_reviews'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelReviewCount');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewCount)==0)continue;
                array_push($arr,$val->getHotelReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelReviewAverage');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewAverage)==0)continue;
                array_push($arr,$val->getHotelReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelReviewAverage');
            $data = $hotelsdata->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getHotelReviewAverage)==0)continue;
                array_push($arr,$val->getHotelReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $propertyIdArray=[];
            foreach ($arr as $ar){
                array_push($propertyIdArray, $ar->PropertyID);
            }
            $ids = implode(',', $propertyIdArray);
            $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$city_name)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        return view('website.hotel_card_section',compact('hotelsData','route_name'));
    }
    public function myhotelsdetails(Request $request, $id){
        $hotelData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->with('getHotelPics','getRooms','getHotelReviewAverage','getHotelFeaturesAndAmenities','getHotelReview')->where('PropertyID',$id)->first();
    	return view('website.hoteldetails',compact('hotelData'));
    }
    public function addFavoriteProperty(Request $request, $PropertyID){
        if(Auth::id()){
            PropertyFavorite::updateorCreate(['user_id' => Auth::id(),'property_id' => $PropertyID],['user_id' => Auth::id(),'property_id' => $PropertyID]);
            return 'add in favorite success';
        }
        return 'add in favorite fail';
    }
    public function removeFavoriteProperty(Request $request, $PropertyID){
        if(Auth::id()){
            PropertyFavorite::where('user_id', '=', Auth::id())->where('property_id', '=', $PropertyID)->delete();
            return 'remove from favorite success';
        }
        return 'remove from favorite fail';
    }
    public function viewFavoriteProperties(Request $request){
        $favoriteProperties = PropertyFavorite::where('user_id',Auth::id())->get();
        $propertyIdArray = [];
        foreach($favoriteProperties as $key=>$val){
            array_push($propertyIdArray,$val->property_id);
        }
        $ids = implode(',', $propertyIdArray);
        $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview','getUserFavoriteProperties')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(''.DB::raw("FIELD(PropertyID, $ids)"). 'DESC')->paginate(12);
        $route_name = $request->path();
        return view('website.myhotels',compact('hotelsData','route_name'));
    }
    public function checkout(){


             $data['cart'] = session()->get("cart");

            // dd($data['cart']);

            if (isset($data['cart']["id"])) {

                if ($data['cart']["category"] == "4") {

                    // dd($data['cart']["category"]);

                    // $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassID',$data['cart']["id"]);

                    $data['categoryitem'] = GuestPass::with('getGuestPassDetails', 'getGuestPassprogramDetails', 'getGuestPassreviewdetails', 'guestpassbyuser')->where('GuestPassID', $data['cart']["id"])->first();

                    // return $data;


                } elseif ($data['cart']["category"] == "1") {

                    $data['categoryitem'] = ManageSetting::where('id', $data['cart']["id"])->with('getPackageDealReviewDetails','getPackageReviewCountForView', 'getPackageDealsphoto', 'getPackageDealsType', 'getPackageDealsDefaultPhoto', 'getPackageReviewAverageForView', 'getPackageUser')->first();

                    // dd($data['categoryitem']);

                } elseif ($data['cart']["category"] == "2") {

                    // dd($data['cart']["id"]);

                    $data['roomid'] = Room::where('id', $data['cart']["id"])->first();

                    // dd($data['roomid']->PropertyId);

                    $data['categoryitem'] = Property::with('getHotelReviewAverage', 'getUserofProperty', 'getHotelReview')->where('PropertyId', $data['roomid']->PropertyId)->first();

                    // dd($data['categoryitem']);

                } elseif ($data['cart']["category"] == "3") {


                    $data['categoryitem'] = Transportationroute::with('getTransporttype', 'getTransportmainroute', 'getTransportReviewForView', 'getTransportDefaultPic', 'getTransportPics', 'getTransportuser', 'getTransportuserprofile')->where('Status', 1)->where('status_from_admin', 1)->where('vendor_status', 1)->where('VehicleRouteID', $data['cart']["id"])->first();

                } elseif ($data['cart']["category"] == "5") {

                    $data['categoryitem'] = Guide::with('getGuideReviewForView', 'getGuideReviewAverageForView', 'getGuideReviewCountForView', 'getGuideDefaultPic', 'getguideUser')->where('GuidesStatus', 1)->where('Admin_status', 1)->where('userstatus', 1)->where('GuidesID', $data['cart']["id"])->first();

                }

            }


        // dd($data['cart']["category"]);

			// return $data;


    	return view('website.checkout',$data);

    }
	
    public function mypackages(Request $request){

        $packages = ManageSetting::with('getPackageDealsDefaultPhoto','getPackageReviewForView')->orderBy('id', 'DESC')->where('Package_deals_status', 1)->paginate(12);
        $packageType = PackageDealType::get();
        $route_name = $request->path();
        $cityNames = ManageSetting::where('package_deals_status','1')->groupBy('package_deals_location')->get();
    	return view('website.packages',compact('packages','packageType','route_name','cityNames'));

    }
    public function mypackagedetail($id,$name){
        $packageType = PackageDealType::get();
//        $review = PackageDealReview::where('PackageDealsID',$id)->where('flag',1)->get();
          $packages = ManageSetting::where('id',$id)->with('getPackageReviewCountForView','getPackageDealsphoto','getPackageDealsType','getPackageDealsDefaultPhoto','getPackageReviewAverageForView','getPackageUser')->first();
    	return view('website.packagedetail',compact('packages','packageType'));

    }
    public function myvisa(){

    	return view('website.visa');

    }
    public function myflight(){

    	return view('website.flights');

    }
    public function myguestspasses(Request $request){
        // $data = $guestPass = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails')->get();
        // return $guestpass = DB::select('call All_GuestPass_Active()');
        //$guestpass = GuestPass::with('getGuestPassreviewAverage')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->get();
        $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
        $avgs = $guestpassdata->get();
        $arr = [];
        foreach($avgs as $key=>$val){
            if(sizeof($val->getGuestPassreviewAverage)==0)continue;
            array_push($arr,$val->getGuestPassreviewAverage[0]);
        }
        $gustPasses = [];
        foreach($arr as $ar){
            array_push($gustPasses, $ar->GuestPassID);
        }
//        return $gustPasses;
        $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->whereIn('GuestPassID',$gustPasses)->paginate(12);
        //DIE;
        //return $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->get();
        // dd($data);
//        $cityNames = GuestPass::where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->groupBy('GuestPassLocation')->get('GuestPassLocation');
//        return $cityNames;
        $route_name = $request->path();
        return view('website.guestspass',compact('guestpass','route_name'));
    	// return view('website.guestspass',compact('data'));
    }
    public function guestsPassesByCity(Request $request,$cityName){
        $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
        $avgs = $guestpassdata->get();;
        $arr = [];
        foreach($avgs as $key=>$val){
            if(sizeof($val->getGuestPassreviewAverage)==0)continue;
            array_push($arr,$val->getGuestPassreviewAverage[0]);
        }
        $gustPasses = [];
        foreach($arr as $ar){
            array_push($gustPasses, $ar->GuestPassID);
        }
        $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->whereIn('GuestPassID',$gustPasses)->where('GuestPassLocation',$cityName)->paginate(12);
//        $cityNames = GuestPass::where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->groupBy('GuestPassLocation')->get('GuestPassLocation');
        $route_name = $request->path();
        return view('website.guestspass',compact('guestpass','route_name'));
//        return $cityName;
    }

    public function packgaeDealsByCity(Request $request,$cityName){
        $packageDealsData = ManageSetting::with('getPackageReviewAverage','getPackageDealReviewDetails')->where('package_deals_status','1');
        $avgs = $packageDealsData->get();;
        $arr = [];
        foreach($avgs as $key=>$val){
            if(sizeof($val->getPackageReviewAverage)==0)continue;
             array_push($arr,$val->getPackageReviewAverage[0]);
        }
        $packageDeals = [];
        foreach($arr as $ar){
           array_push($packageDeals, $ar->PackageDealsID);
        }
        $packages = ManageSetting::with('getPackageReviewAverage','getPackageDealReviewDetails')->whereIn('id',$packageDeals)->where('package_deals_location',$cityName)->where('package_deals_status',1)->OrderBy('id','DESC')->paginate(12);
        $cityNames = ManageSetting::where('package_deals_status','1')->groupBy('package_deals_location')->get();
        $packageType = PackageDealType::get();
        $route_name = $request->path();
        return view('website.packages',compact('packages','route_name','packageType','cityNames'));
//        return $cityName;
    }

    public function myguestsdetails($id){

        // return  GuestPassReview::groupBy('GuestPassID')->avg('Rating');

         $guestPass = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails','getGuestPassUser')->where('GuestPassID',$id)->first();

        // $data['guestpassdetail'] = DB::select('call GuestPass_Detail(?)',[$id]);


        // $data['guestpassdetail'] = DB::select('call sampleProcedure()');

        // dd($guestPass);

    	return view('website.guest-details',compact('guestPass'));

    }

    public function mytranspotation(Request $request){
        $transports = Transportationroute::with('getTransportReviewAverageForView')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
        $data = $transports->get();
        if(sizeof($data) > 0){
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getTransportReviewAverage)==0)continue;
                array_push($arr,$val->getTransportReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $transportationIdArray=[];
            foreach ($arr as $ar){
                array_push($transportationIdArray, $ar->VehicleRouteID);
            }
            $ids = implode(',', $transportationIdArray);
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverageForView')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            $transportation_types = Transportationtype::groupBy('TransportationTypeDesc')->get();
            $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
            $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
            $route_name = $request->path();
            return view('website.transport',compact('transports','transportation_types','route_name','transportation_routes_from','transportation_routes_to'));
        }
        else{
            return back()->with('no_transportation_found', 'No Transportation Found');
        }
    }

    public function mytranspotationdetails(Request $request, $id){
        $transport = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportReviewForView','getTransportDefaultPic','getTransportPics')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('VehicleRouteID',$id)->first();
        $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
        $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
        $route_name = $request->path();
        return view('website.tranportationdetails',compact('transport','transportation_routes_from','transportation_routes_to','route_name'));
    }

    public function transportationByType(Request $request,$TransportationTypeID){
        $transports = Transportationroute::with('getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('TransportationTypeID',$TransportationTypeID);
        $data = $transports->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getTransportReviewAverage)==0)continue;
            array_push($arr,$val->getTransportReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $transportationIdArray=[];
        foreach ($arr as $ar){
            array_push($transportationIdArray, $ar->VehicleRouteID);
        }
        $ids = implode(',', $transportationIdArray);
        $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('TransportationTypeID',$TransportationTypeID)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
        $transportation_types = Transportationtype::groupBy('TransportationTypeDesc')->get();
        $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
        $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
        $route_name = $request->path();
        return view('website.transport',compact('transports','transportation_types','route_name','transportation_routes_from','transportation_routes_to','TransportationTypeID'));
    }

    public function addTransportationReview (Request $request){
//        return $requestData = $request->all();
            $data = Transportationreview::create($request->all());
        return back();
    }
	
    public function getTransportationRouteTo(Request $request,$name){
        $transportation_routes_from = TransportMainRoute::groupBy('RouteTo')->where('RouteFrom',$name)->get();
        return $transportation_routes_from;
    }
	
    public function searchTransportation(Request $request){
//        return $request;
//        extract($request->all());
//        $search_city = $city;
//        $route_name = $request->path();
        $type = $request->type;
        $transportation_route_ids = TransportMainRoute::where('RouteFrom',$request->route_from)->where('RouteTo',$request->route_to)->first('RouteID');
        $searched_transportation_id = $transportation_route_ids->RouteID;
        $transports = Transportationroute::with('getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('RouteID',$transportation_route_ids)->where('Type',$request->type);
        $data = $transports->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getTransportReviewAverage)==0)continue;
            array_push($arr,$val->getTransportReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $transportationIdArray=[];
        foreach ($arr as $ar){
            array_push($transportationIdArray, $ar->VehicleRouteID);
        }
        $ids = implode(',', $transportationIdArray);
        $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->whereIn('RouteID',$transportation_route_ids)->where('Type',$request->type)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
        $transportation_types = Transportationtype::groupBy('TransportationTypeDesc')->get();
        $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
        $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
        $transportation_routes_from_name = $request->route_from;
        $transportation_routes_to_name = $request->route_to;
        $route_name = $request->path();
        return view('website.transport',compact('transports','transportation_types','route_name','transportation_routes_from','transportation_routes_to','searched_transportation_id','type','transportation_routes_from_name','transportation_routes_to_name'));
    }
    public function searchedTransportationSorting(Request $request,$sort_type,$searched_transportation_id,$type){
//        return $sort_type.''.$searched_transportation_id;
        if ($sort_type == 'price_high_to_low'){
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('Type',$type)->where('RouteID',$searched_transportation_id)->orderBy('Price','desc')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('Type',$type)->where('RouteID',$searched_transportation_id)->orderBy('Price','asc')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $transports = Transportationroute::with('getTransportReviewCount')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewCount)==0)continue;
                    array_push($arr,$val->getTransportReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'min_reviews'){
            $transports = Transportationroute::with('getTransportReviewCount')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewCount)==0)continue;
                    array_push($arr,$val->getTransportReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $transports = Transportationroute::with('getTransportReviewAverage')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewAverage)==0)continue;
                    array_push($arr,$val->getTransportReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $transports = Transportationroute::with('getTransportReviewAverage')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewAverage)==0)continue;
                    array_push($arr,$val->getTransportReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Type',$type)->where('RouteID',$searched_transportation_id)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        $route_name = $request->path();
        return view('website.transportation_card_section',compact('transports','route_name'));
    }

    public function transportationSorting(Request $request, $sort_type){

        if ($sort_type == 'price_high_to_low'){
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->orderBy('Price','desc')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->orderBy('Price','asc')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $transports = Transportationroute::with('getTransportReviewCount')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewCount)==0)continue;
                    array_push($arr,$val->getTransportReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'min_reviews'){
            $transports = Transportationroute::with('getTransportReviewCount')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewCount)==0)continue;
                    array_push($arr,$val->getTransportReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $transports = Transportationroute::with('getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewAverage)==0)continue;
                    array_push($arr,$val->getTransportReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $transports = Transportationroute::with('getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewAverage)==0)continue;
                    array_push($arr,$val->getTransportReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        $route_name = $request->path();
        return view('website.transportation_card_section',compact('transports','route_name'));
    }

    public function transportationSortingWithType(Request $request, $sort_type, $TransportationTypeID){
//        return $sort_type.''.$TransportationTypeID;\
        if ($sort_type == 'price_high_to_low'){
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->orderBy('Price','desc')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->orderBy('Price','asc')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $transports = Transportationroute::with('getTransportReviewCount')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewCount)==0)continue;
                    array_push($arr,$val->getTransportReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'min_reviews'){
            $transports = Transportationroute::with('getTransportReviewCount')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewCount)==0)continue;
                    array_push($arr,$val->getTransportReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $transports = Transportationroute::with('getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewAverage)==0)continue;
                    array_push($arr,$val->getTransportReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $transports = Transportationroute::with('getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1);
            $data = $transports->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getTransportReviewAverage)==0)continue;
                    array_push($arr,$val->getTransportReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $transportationIdArray=[];
                foreach ($arr as $ar){
                    array_push($transportationIdArray, $ar->VehicleRouteID);
                }
                $ids = implode(',', $transportationIdArray);
                $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('TransportationTypeID',$TransportationTypeID)->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        $route_name = $request->path();
        return view('website.transportation_card_section',compact('transports','route_name'));

    }

    public function transportationSortingWithTypre(Request $request, $sort_type, $city_name){}

    public function myguide(Request $request){
        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1);
        $data = $guides->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getGuideReviewAverage)==0)continue;
            array_push($arr,$val->getGuideReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $guideIdArray=[];
        foreach ($arr as $ar){
            array_push($guideIdArray, $ar->GuidesID);
        }
        $ids = implode(',', $guideIdArray);
        $guides = Guide::where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
        $guide_cities = GuideCity::where('status',1)->get();
        $guide_languages = GuideLanguage::where('status',1)->get();
        $route_name = $request->path();
        return view('website.myguide',compact('guides','guide_cities','guide_languages','route_name'));
    }

    public function guideDetails(Request $request, $id){
		
        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic','getguideUser')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('GuidesID',$id)->first();
        $guide_cities = GuideCity::where('status',1)->get();
        $guide_languages = GuideLanguage::where('status',1)->get();
        return view('website.guidedetails',compact('guides','guide_cities','guide_languages'));
		
    }

    public function addGuideReview (Request $request){
//        return $request;
        $data = Guides_Review::create($request->all());
        return back();
    }

    public function searchGuide(Request $request){
//        return $request;
        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$request->language.'%')->where('GuidesLocation','like','%'.$request->city.'%')->where('MaxOccupancy','>=',$request->total_guests_guide);
        $data = $guides->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getGuideReviewAverage)==0)continue;
            array_push($arr,$val->getGuideReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $guideIdArray=[];
        foreach ($arr as $ar){
            array_push($guideIdArray, $ar->GuidesID);
        }
        $ids = implode(',', $guideIdArray);
        $guides = Guide::where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('Languages','like','%'.$request->language.'%')->where('GuidesLocation','like','%'.$request->city.'%')->where('MaxOccupancy','>=',$request->total_guests_guide)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
        $guide_cities = GuideCity::where('status',1)->get();
        $guide_languages = GuideLanguage::where('status',1)->get();
        $route_name = $request->path();
        $searched_city = $request->city;
        $searched_language = $request->language;
        $total_guests = $request->total_guests_guide;
        return view('website.myguide',compact('guides','guide_cities','guide_languages','route_name','searched_city', 'searched_language','total_guests'));
    }

    public function guideByLanguage(Request $request, $language){
        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%');
        $data = $guides->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getGuideReviewAverage)==0)continue;
            array_push($arr,$val->getGuideReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $guideIdArray=[];
        foreach ($arr as $ar){
            array_push($guideIdArray, $ar->GuidesID);
        }
        $ids = implode(',', $guideIdArray);
        $guides = Guide::where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
        $guide_cities = GuideCity::where('status',1)->get();
        $guide_languages = GuideLanguage::where('status',1)->get();
        $route_name = $request->path();
        return view('website.myguide',compact('guides','guide_cities','guide_languages','route_name'));
    }

    public function guideSorting(Request $request, $sort_type){

        if ($sort_type == 'price_high_to_low'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->orderBy('PricePerDay','desc')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->orderBy('PricePerDay','asc')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewCount)==0)continue;
                    array_push($arr,$val->getGuideReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'min_reviews'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewCount)==0)continue;
                    array_push($arr,$val->getGuideReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewAverage)==0)continue;
                    array_push($arr,$val->getGuideReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewAverage)==0)continue;
                    array_push($arr,$val->getGuideReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        $route_name = $request->path();
        return view('website.guide_card_section',compact('guides','route_name'));
    }

    public function searchedGuideSorting(Request $request, $sort_type, $language, $city, $total_guests){
        if ($sort_type == 'price_high_to_low'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests)->orderBy('PricePerDay','desc')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests)->orderBy('PricePerDay','asc')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewCount)==0)continue;
                    array_push($arr,$val->getGuideReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'min_reviews'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewCount)==0)continue;
                    array_push($arr,$val->getGuideReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewAverage)==0)continue;
                    array_push($arr,$val->getGuideReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests);
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewAverage)==0)continue;
                    array_push($arr,$val->getGuideReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->where('GuidesLocation','like','%'.$city.'%')->where('MaxOccupancy','>=',$total_guests)->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Guide Found');
            }
        }
        $route_name = $request->path();
        return view('website.guide_card_section',compact('guides','route_name'));
    }

    public function guideSortingWithLanguage(Request $request, $sort_type, $language){

        if ($sort_type == 'price_high_to_low'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->orderBy('PricePerDay','desc')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->orderBy('PricePerDay','asc')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%');
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewCount)==0)continue;
                    array_push($arr,$val->getGuideReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'min_reviews'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%');
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewCount)==0)continue;
                    array_push($arr,$val->getGuideReviewCount[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%');
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewAverage)==0)continue;
                    array_push($arr,$val->getGuideReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%');
            $data = $guides->get();
            if(sizeof($data) > 0){
                $arr = [];
                foreach($data as $key=>$val){
                    if(sizeof($val->getGuideReviewAverage)==0)continue;
                    array_push($arr,$val->getGuideReviewAverage[0]);
                }
                for ($j = 0; $j < count($arr) - 1; $j++){
                    if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j + 1];
                        $arr[$j + 1] = $temp;
                        $j = -1;
                    }
                }
                $guideIdArray=[];
                foreach ($arr as $ar){
                    array_push($guideIdArray, $ar->GuidesID);
                }
                $ids = implode(',', $guideIdArray);
                $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('Languages','like','%'.$language.'%')->whereIn('GuidesID',$guideIdArray)->orderByRaw(DB::raw("FIELD(GuidesID, $ids)"))->paginate(12);
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        $route_name = $request->path();
        return view('website.guide_card_section',compact('guides','route_name'));
    }
    public function myguidedetails(){
        return $data = Guide::with('getGuideDetails','getGuidereviewdetails')->where('GuestPassID',$id)->first();

    	return view('website.myguide');

    }
    public function addToCart(Request $request){

        // dd($request);
		
		$validator = $request->validate([  
            'category'  	=>  'required|numeric',
        ]);
		
		if($request->category == 3){
			
			$validator = $request->validate([  
            'id'     			=>  'required|numeric',
            'quantity' 			=> 	'required|numeric',
			'todaydate' 		=> 	'required',
            'date'				=>  'required|date|after:todaydate',
            'category'  		=>  'required|numeric',
            'image'     		=>  'required',
            'title'     		=>  'required',
			'price'				=>	'required',
			'pickuplocation'	=>	'required',
			'dropofflocation'	=>	'required',
			'triptype'			=>	'required',
			
			]);
			
			
		}else{
		
			$validator = $request->validate([  
				'id'     		=>  'required|numeric',
				'quantity' 		=> 	'required|numeric',
				'date'			=>  'required',
				'category'  	=>  'required|numeric',
				'image'     	=>  'required',
				'title'     	=>  'required',
				'price'			=>	'required'
			]);
		
		}

		$request->session()->forget('cart');

		if($request->category == 4){

			$d=strtotime($request->date);

			$requestdate = date("Y-m-d", $d);

			// dd($requestdate);

			$guestPassresevationdatedata = GuestpassReservation::where('GuestPassID',$request->id)->where('ReservationForDate',$requestdate)->sum('qty');

			$guestpassoccupancy = Guestpass::where('GuestPassID',$request->id)->first();

			$guestspassorder = intval($guestPassresevationdatedata) + $request->quantity;

			// dd($guestspassorder,$guestpassoccupancy->MaxOccupancy);

			if( $guestspassorder > $guestpassoccupancy->MaxOccupancy){

				// dd("big");

				return  Redirect::back()->withErrors(['message' => 'This GuestPass is fully booked on this date']);

			}

		}elseif($request->category == 2){

			$roomoccupancy = Room::where('id',$request->id)->first();

			// dd($roomoccupancy->AvailableQty);

			$Bookdates = explode('-',$request->date);

			$time = strtotime($Bookdates[1]);

					$checkoutnewformatdate = date('Y-m-d',$time);

					$period = new DatePeriod(
						 new DateTime($Bookdates[0]),
						 new DateInterval('P1D'),
						 new DateTime($Bookdates[1])
					);

					$datederror = [];

					// dd($datederror);

					$rookbookedflag = 0 ;

			foreach ($period as $key => $value) {

				$roomreservationbookedqty = Roomreservation::where('RoomID',$request->id)->where('checkin',$value->format('Y-m-d 00:00:00'))->sum('qty');

				// dd($value->format('Y-m-d 00:00:00'));

				$roomorder = intval($roomreservationbookedqty) + $request->quantity;

				// dd($roomreservationbookedqty,$roomoccupancy->AvailableQty);

				if( $roomorder > $roomoccupancy->AvailableQty  ){

					$rookbookedflag = 1 ;

					// dd($value->format('Y-m-d'));

					array_push($datederror,$value->format('Y-m-d'));

				}

			}

			if($rookbookedflag == 1){

				Session::flash('bookedDates',$datederror);

				// dd($datederror);

				return  Redirect::back();

		}

		}elseif($request->category == 3){

				$d=strtotime($request->date);

				$requestdate = date("Y-m-d 00:00:00", $d);

				$transportreservationbookedqty = TransportReservation::where('VehicleRouteID',$request->id)->where('PickUpDateTime',$requestdate)->sum('qty');

				// dd($transportreservationbookedqty);

				$transportvehicleoccupancy = Transportationroute::with('getTransporttype')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('VehicleRouteID',$request->id)->first();

				// dd($transportvehicleoccupancy->getTransporttype->NumOfSeats);

				// dd($value->format('Y-m-d 00:00:00'));

				$transportorder = intval($transportreservationbookedqty) + $request->quantity;

				// dd($roomreservationbookedqty,$transportvehicleoccupancy->AvailableQty);

				if( $transportorder > $transportvehicleoccupancy->getTransporttype->NumOfSeats  ){

					// dd($value->format('Y-m-d'));

					return  Redirect::back()->withErrors(['message' => 'This Vehicle is fully booked on this date']);

				}


		}elseif($request->category == 1){
			
			// $d=strtotime($request->date);

			$requestdate = date("Y-m-d");

			// dd($requestdate);

			$packagesresevationdata = Search::where('package_deals_id',$request->id)->sum('qty');
			
			// dd($packagesresevationdatedata);

			$packagesoccupancy = ManageSetting::where('id',$request->id)->first();
			
			// dd($packagesoccupancy);

			$packagesorder = intval($packagesresevationdata) + $request->quantity;

			// dd($guestspassorder,$guestpassoccupancy->MaxOccupancy);

			if( $packagesorder > $packagesoccupancy->max_occupancy){

				// dd("big");

				return  Redirect::back()->withErrors(['message' => 'This Package is fully Booked!']);

			}
			
			if($packagesoccupancy->deadline == $requestdate ){
				
				return  Redirect::back()->withErrors(['message' => 'Last Date to Book this package is over!']);
				
			}

		}elseif($request->category == 5){
			
		}


        $cart = session()->get('cart');

        // dd($cart);

        if(!$cart) {
			
			if($request->category == 3){
				
				$cart = [

							"id"            	=> 	$request->id,
							"title"         	=> 	$request->title,
							"quantity"      	=> 	$request->quantity,
							"offered_price" 	=> 	$request->price,
							"price"         	=> 	$request->price,
							"category"      	=> 	$request->category,
							"date"          	=> 	$request->date,
							"image"         	=> 	$request->image,
							"pickuplocation"	=>	$request->pickuplocation,
							"dropofflocation"	=>	$request->dropofflocation,
							"triptype"			=>	$request->triptype,

						];

						// dd($cart);

					session()->put('cart', $cart);
				
			}else{

				$cart = [

									"id"            => $request->id,
									"title"         => $request->title,
									"quantity"      => $request->quantity,
									"offered_price" => $request->price,
									"price"         => $request->price,
									"category"      => $request->category,
									"date"          => $request->date,
									"image"         => $request->image

						];

						// dd($cart);

					session()->put('cart', $cart);
			}

            if($cart){
                // return response()->json(['msg'=>'Item successfully added to cart.','count'=> sizeof(session()->get('cart'))]);
                return redirect('checkout');
            }else{
                // return response()->json(['msg'=>'Unable To Send Request, Please Try Again.','count'=>sizeof(session()->get('cart'))]);
                return redirect('checkout');
            }//end if else.
        }//endif.

            return redirect('checkout');



    }//end addToCart function.
    public function cart(){
        // session()->flush();
        $data['cart'] = session()->get("cart");

        // dd($data);

    	return view('website.cart',$data);

    }
	
    public function aboutus(){
    	return view('website.aboutus');
    }
	
    public function privacypolicy(){

    	return view('website.privacypolicy');

    }
	
    public function faq(){

    	return view('website.faq');

    }
	
    public function sqlconnect(){

        $data['guestpass'] = DB::select('call SP_GET_PackageDealsDetails(1)',[$id]);

            dd($data);

    }
	
    public function searchGuestpass (Request $request){
        extract($request->all());
        $search_city = $city;
        $route_name = $request->path();
        $guestpass  = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails')->where('MaxOccupancy','>=',$request->total_guests)->where('GuestPassLocation','like','%'.$request->city.'%')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->paginate(12);
        return view('website.guestspass', compact('guestpass','route_name','search_city'));
    }
	
    public function searchHotels(Request $request){
//        return $request;
        $checkin_date = substr($request->daterange, 0, 10);
        $checkout_date = substr($request->daterange, 13, 23);
        $diff = abs(strtotime($checkin_date) - strtotime($checkout_date));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        if(!isset($request->destination)){
            return back();
        }
        extract($request->all());
        $search_city = $destination;
        $route_name = $request->path();
        $search_rooms  = Room::where('RoomStatus','Ready')->with('getBedType','roomFeatureList')->where('MaxOccupancy','>=',$request->total_guests_hotels)->groupBy('PropertyId')->get();
        $property_ids = [];
        foreach ($search_rooms as $search_room){
            array_push($property_ids, $search_room->PropertyId);
        }
        $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->whereIn('PropertyID', $property_ids)->with('getHotelPics','getRooms','getHotelReviewAverage','getHotelReview')->where('City',$search_city)->get();
//        return view('website.myhotels',compact('hotelsData','route_name','search_city','days'));
//        $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewAverage');
//        $data = $hotelsdata->get();
        $arr = [];
        foreach($hotelsData as $key=>$val){
            if(sizeof($val->getHotelReviewAverage)==0)continue;
            array_push($arr,$val->getHotelReviewAverage[0]);
        }
//        return count($arr);
//        if(count($arr)>1){
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
//        }
        $propertyIdArray=[];



        foreach ($arr as $ar){
            array_push($propertyIdArray, $ar->PropertyID);
        }
//        return $propertyIdArray;
        $ids = implode(',', $propertyIdArray);
//        return $ids;
        $hotelsData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City',$request->destination)->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview','getUserFavoriteProperties')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        $route_name = $request->path();
        return view('website.myhotels',compact('hotelsData','route_name','search_city','days'));



    }
    public function addPropertyReview (Request $request)
    {
//        return $requestData = $request->all();
        $data = PropertyReview::create($request->all());
        return back();
    }
    public function addGuestPassReview (Request $request)
    {
        $requestData = $request->all();
//        $requestData['GuestPassID'] = ;
        $requestData['ReviewerName'] = Auth::user()->name;
        $requestData['EmailAddress'] = Auth::user()->email;
//        $requestData['EmailAddress'] = Auth::email();
        $requestData['IPAddress'] = \Request::getClientIp(true);
//        return $requestData;
        $data = GuestPassReview::create($requestData);
        return back();
    }
    public function checkoutsubmit($request){


		$user = Auth::user();

		// print_r($user);
		
		dd($request);

		$cart = session()->get('cart');

		if(isset($cart['category'])){

			if(isset($user->id)){

					if($cart['category'] == 4){

		$time = strtotime($cart['date']);

		$newformatdate = date('Y-m-d',$time);

		// echo $newformatdate;

		// dd($newformatdate);

						$lastId = GuestpassReservation::orderBy('ReservationID','DESC')->limit(1)->first();
							// dd($lastId->ReservationID);
						$addLastId = $lastId == ''?1:$lastId->ReservationID+1;

						$allmydate = date('Y-m-d_H:i:s');

						$guestpassreserveid = "GP-".$addLastId;

		$allmydate = date('Y-m-d_H:i:s');

		if($request){

			$GuestpassReservation = GuestpassReservation::firstOrCreate([
								"ReceiptNum"   			=> 	$guestpassreserveid,
                "GuestPassID"     		=> 	$cart['id'],
                "qty"   				=> 	$cart['quantity'],
				"CreatedBy"   			=> 	$user->id,
                "CreatedOn"     		=> 	date('Y-m-d h:i:sa'),
                "ReservationForDate"	=> 	$newformatdate,
				"NotesByCustomer"   	=> 	$request->customernotes,
				"Insurance" 			=>	$request->Insurance,
				"Donation"				=>	$request->donation,
				"Donation_amount"		=>	$request->formtotaldonation,
                "TotalPrice"     		=> 	$request->formtotalamount,
                "BookingStatus"   		=> 	"CONFIRMED",
				"PaymentStatus"   		=> 	"PAID",
                "SPComments"     		=> 	$request->customernotes,
                "SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
				"updated_at"			=>	date('Y-m-d h:i:sa'),
				"created_at"			=>	date('Y-m-d h:i:sa'),
				"customer_id"			=>	$cart[0]['customer_id'],
				"charge_id"			    =>	$cart[0]['charge_id'],
				"reciept_url"			=>	$cart[0]['reciept_url'],
            ]);

		}

		// dd($GuestpassReservation);

					}elseif($cart['category'] == 2){


						if($request){

							$Bookdates = explode('-',$cart['date']);

							$time = strtotime($Bookdates[1]);

							$checkoutnewformatdate = date('Y-m-d',$time);
							// return $daterange;

							$period = new DatePeriod(
								 new DateTime($Bookdates[0]),
								 new DateInterval('P1D'),
								 new DateTime($Bookdates[1])
							);

							// dd($period);

							$lastId = Roomreservation::orderBy('ReservationID','DESC')->limit(1)->first();
							// dd($lastId->ReservationID);
							$addLastId = $lastId == ''?1:$lastId->ReservationID+1;

							// $mylastid = $addLastId * 1000;

							$hotelreserveid = "HOTL-".$addLastId;

							foreach ($period as $key => $value) {

										// dd($value->format('Y-m-d'));

									$RoomReservation = Roomreservation::firstOrCreate([

										"ReceiptNum"   			=> 	$hotelreserveid,
										"PropertyID"     		=> 	$request->propertyid,
										"RoomID"     			=> 	$cart['id'],
										"qty"   				=> 	$cart['quantity'],
										"CreatedBy"   			=> 	$user->id,
										"CreateDate"   			=> 	date('Y-m-d h:i:sa'),
										"CreatedOn"     		=> 	date('Y-m-d h:i:sa'),
										"checkin"				=> 	$value->format('Y-m-d'),
										"checkout"				=> 	$checkoutnewformatdate,
										"NotesByCustomer"   	=> 	$request->customernotes,
										"Insurance" 			=>	$request->Insurance,
										"Donation"				=>	$request->donation,
										"Donation_amount"		=>	$request->formtotaldonation,
										"TotalPrice"     		=> 	$request->formtotalamount,
										"BookingStatus"   		=> 	"CONFIRMED",
										"PaymentStatus"   		=> 	"PAID",
										"SPComments"     		=> 	$request->customernotes,
										"SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
										"updated_at"			=>	date('Y-m-d h:i:sa'),
										"created_at"			=>	date('Y-m-d h:i:sa'),
                                        "customer_id"			=>	$cart[0]['customer_id'],
                                        "charge_id"			=>	$cart[0]['charge_id'],
                                        "reciept_url"			=>	$cart[0]['reciept_url'],

									]);

							}


								$RoomReservation = Roomreservation::firstOrCreate([

										"ReceiptNum"   			=> 	$hotelreserveid,
										"PropertyID"     		=> 	$request->propertyid,
										"RoomID"     			=> 	$cart['id'],
										"qty"   				=> 	$cart['quantity'],
										"CreatedBy"   			=> 	$user->id,
										"CreateDate"   			=> 	date('Y-m-d h:i:sa'),
										"CreatedOn"     		=> 	date('Y-m-d h:i:sa'),
										"checkin"				=> 	$checkoutnewformatdate,
										"checkout"				=> 	$checkoutnewformatdate,
										"NotesByCustomer"   	=> 	$request->customernotes,
										"Insurance" 			=>	$request->Insurance,
										"Donation"				=>	$request->donation,
										"Donation_amount"		=>	$request->formtotaldonation,
										"TotalPrice"     		=> 	$request->formtotalamount,
										"BookingStatus"   		=> 	"CONFIRMED",
										"PaymentStatus"   		=> 	"PAID",
										"SPComments"     		=> 	$request->customernotes,
										"SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
										"updated_at"			=>	date('Y-m-d h:i:sa'),
										"created_at"			=>	date('Y-m-d h:i:sa'),
                                        "customer_id"			=>	$cart[0]['customer_id'],
                                        "charge_id"			=>	$cart[0]['charge_id'],
                                        "reciept_url"			=>	$cart[0]['reciept_url'],

									]);

						}


					}elseif($cart['category'] == 3){

						$extradatatransport = Transportationroute::where('VehicleRouteID',$cart['id'])->first();

							// dd($extradatatransport);

						$time = strtotime($cart['date']);

						$newformatdate = date('Y-m-d',$time);

						// echo $newformatdate;

						$lastId = TransportReservation::orderBy('ReservationID','DESC')->limit(1)->first();
							// dd($lastId->ReservationID);
						$addLastId = $lastId == ''?1:$lastId->ReservationID+1;

						$allmydate = date('Y-m-d_H:i:s');

						$transportreserveid = "TRANSP-".$addLastId;

						$tofromdestination = explode('to',$request->tofrom);

						// dd($tofromdestination[0]);

						if($request){

							$TransportReservation = TransportReservation::firstOrCreate([
								"ReceiptNum"   			=> 	$transportreserveid,
								"RouteID"     			=> 	$extradatatransport->RouteID,
								"TransportationOwnerID" => 	$extradatatransport->TransportationOwnerID,
								"TransportationTypeID"  => 	$extradatatransport->TransportationTypeID,
								"VehicleRouteID"     	=> 	$cart['id'],
								"CreatedBy"   			=> 	$user->id,
								"CreateDate"     		=> 	date('Y-m-d h:i:sa'),
								"qty"					=>	$cart['quantity'],
								"PickUpDateTime"		=> 	$cart['date'],
								"DropOffDateTime"   	=> 	$cart['date'],
								"ReservationStatus"		=>	'Booked',
								"PickupLocation"		=>	$tofromdestination[0],
								"DropOffLocation"		=>	$tofromdestination[1],
								"NotesByCustomer"		=>	$request->customernotes,
								"Insurance" 			=>	$request->Insurance,
								"Donation"				=>	$request->donation,
								"Donation_amount"		=>	$request->formtotaldonation,
								"TotalPrice"     		=> 	$request->formtotalamount,
								"BookingStatus"   		=> 	"CONFIRMED",
								"PaymentStatus"   		=> 	"PAID",
								"SPComments"     		=> 	$request->customernotes,
								"SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
								"updated_at"			=>	date('Y-m-d h:i:sa'),
								"created_at"			=>	date('Y-m-d h:i:sa'),
                                "customer_id"			=>	$cart[0]['customer_id'],
                                "charge_id"			=>	$cart[0]['charge_id'],
                                "reciept_url"			=>	$cart[0]['reciept_url'],

							]);

						}

					}elseif($cart['category'] == 1){

						$time = strtotime($cart['date']);

						$newformatdate = date('Y-m-d',$time);

						$lastId = Search::orderBy('id','DESC')->limit(1)->first();
							// dd($lastId->ReservationID);
						$addLastId = $lastId == ''?1:$lastId->id+1;

						$allmydate = date('Y-m-d_H:i:s');

						$packagesreserveid = "PKG-".$addLastId;

						if($request){

							$PackageReservation = Search::firstOrCreate([
								"user_id"					=>	$user->id,
								"receipt_num"   			=> 	$packagesreserveid,
								"package_deals_id"     		=> 	$cart['id'],
								"created_by"   				=> 	$user->email,
								"qty"						=>	$cart['quantity'],
								"reservation_for_date"		=>	$newformatdate,
								"notes_by_customer"			=>	$request->customernotes,
								"package_insurance" 		=>	$request->Insurance,
								"package_donation"			=>	$request->donation,
								"package_donation_amount"	=>	$request->formtotaldonation,
								"total_price"     			=> 	$request->formtotalamount,
								"booking_status"   			=> 	"CONFIRMED",
								"payment_status"   			=> 	"PAID",
								"sp_comments"     			=> 	$request->customernotes,
								"sp_comments_date_time"		=> 	date('Y-m-d h:i:sa'),
								"updated_at"				=>	date('Y-m-d h:i:sa'),
								"created_at"				=>	date('Y-m-d h:i:sa'),
                                "customer_id"			=>	$cart[0]['customer_id'],
                                "charge_id"			=>	$cart[0]['charge_id'],
                                "reciept_url"			=>	$cart[0]['reciept_url'],
							]);

						}

					}elseif($cart['category'] == 5){

						$time = strtotime($cart['date']);

						$newformatdate = date('Y-m-d',$time);

						$lastId = GuideReservation::orderBy('ReservationID','DESC')->limit(1)->first();
							// dd($lastId->ReservationID);
						$addLastId = $lastId == ''?1:$lastId->ReservationID+1;

						$allmydate = date('Y-m-d_H:i:s');

						$guidesreserveid = "GUID-".$addLastId;

						// dd($request);

						if($request){

							$GuideReservation = GuideReservation::firstOrCreate([
								"ReceiptNum"   			=> 	$guidesreserveid,
								"GuidesID"     			=> 	$cart['id'],
								"CreatedBy"   			=> 	$user->id,
								"CreateDate"			=>	$allmydate,
								"qty"					=>	$cart['quantity'],
								"NotesByCustomer"		=>	$request->customernotes,
								"Insurance" 			=>	$request->Insurance,
								"Donation"				=>	$request->donation,
								"Donation_amount"		=>	$request->formtotaldonation,
								"TotalPrice"     		=> 	$request->formtotalamount,
								"BookingStatus"   		=> 	"CONFIRMED",
								"PaymentStatus"   		=> 	"PAID",
								"SPComments"     		=> 	$request->customernotes,
								"SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
								"updated_at"			=>	date('Y-m-d h:i:sa'),
								"created_at"			=>	date('Y-m-d h:i:sa'),
                                "customer_id"			=>	$cart[0]['customer_id'],
                                "charge_id"			=>	$cart[0]['charge_id'],
                                "reciept_url"			=>	$cart[0]['reciept_url'],
							]);

						}

					}else{

					}

		if(isset($GuestpassReservation) || isset($RoomReservation) || isset($TransportReservation) || isset($PackageReservation) || isset($GuideReservation) ){

			// dd("True");

			session()->forget('cart');
			return true;
			return redirect()->route('index');

		}else{

			return false;
						// dd("False");

			return redirect()->route('index');
		}


			}else{

				return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
			}

		}else{

			return redirect('/checkout')->with('message', 'Kindly Select Product to order!');

		}

		// dd("Out");

		// $request->session()->forget('cart');

        return redirect()->route('index');

    }
	
	public function registeruser(Request $request){

        // dd($request);

        $ErrorMsg = "";
    	$data = [];

        $validator = $request->validate([
            'name'              =>  'required',
            'email'             =>  'required|unique:users,email',
            'phone'             => 	'required',
            'countryCode'       =>  'required|numeric',
            'password'          =>  'required|confirmed|min:6',
            'formtotalamount'   =>  'required|numeric|min:1|not_in:0'
        ]);
        try {
            Stripe::setApiKey('sk_test_51IwCsLHvXmO4xH0sbyJLDB0i5Ig84QIhLN66UNHOZ2h0gHPfNCWHi0lOUxiTQB0wnNAeDhmhfbOyJJRAjzTobNXN005gh2UgIa');

            $stripe = new \Stripe\StripeClient(
                'sk_test_51IwCsLHvXmO4xH0sbyJLDB0i5Ig84QIhLN66UNHOZ2h0gHPfNCWHi0lOUxiTQB0wnNAeDhmhfbOyJJRAjzTobNXN005gh2UgIa'
            );
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->formtotalamount*100,
                'currency' => 'usd',
            ));
        // DB::beginTransaction();
            $data = [
                'customer_id' => $customer->id,
                'charge_id' => $charge->id,
                'reciept_url' => $charge->receipt_url,
            ];
            session()->push('cart', $data);

//            dd(session()->get('cart'));
        // try{
//        return $request->all();
            $user =  User::firstOrCreate(['name'=>$request->name,'email'=> $request->email]);
            $user->status = 1;
            $user->password = bcrypt($request->password);
            $user->save();

            // $profile = Profile::create([
            //     "name"          => $request->Insurance,
            //     "email"         => $request->programtime,
            //     "password"      => bcrypt($request->password),
            // ]);

            $userid = $user->id;

            $userrole = $user->roles()->attach([1 => ['role_id' => 9, 'user_id' => $userid]]);
            $profile = Profile::firstOrCreate([
                "user_id"   => $userid,
                "phone"     => $request->phone,
                "country"   => $request->countryCode,
            ]);

            $credentials = [
                'email'     => $request->email,
                'password'  => $request->password,
            ];
            if (Auth::attempt(['email'=> $request->email,'password'=> $request->password,'status'=>1])) {

					$user = Auth::user();

				// print_r($user);

				$cart = session()->get('cart');

				if(isset($cart['category'])){

					if(isset($user->id)){

                $this->checkoutsubmit($request);



						}else{

					return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
						}

				}else{

					return redirect('/checkout')->with('message', 'Kindly Select Product to order!');

				}


                    return redirect()->route('index');
            }else{
                echo 'else';
            }//end if



        // }
        // catch (\Throwable $e)
	    // {
	    // 	DB::rollback();
	    // }
    } catch (\Exception $e) {
        return $e->getMessage();
    }

    }


	public function checkoutwithauth(Request $request){

		// dd($request);

		$validator = $request->validate([

			'formtotalamount'   =>  'required|numeric|min:1|not_in:0',
			'customernotes' 	=>	'required'

        ]);


		$user = Auth::user();

		// print_r($user);

		$cart = session()->get('cart');

		if(isset($cart['category'])){

			if(isset($user->id)){


				$this->checkoutsubmit($request);



			}else{

					return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
				}

		}else{

			return redirect('/checkout')->with('message', 'Kindly Select Product to order!');

		}

		return redirect()->route('index');

	}

	public function mysignup(Request $request){

        // dd($request);

        $ErrorMsg = "";
    	$data = [];

        $validator = $request->validate([
            'name'              =>  'required',
            'email'             =>  'required|unique:users,email',
            'phoneno'           => 	'required|numeric',
            'countryCode'       =>  'required|numeric',
            'password'          =>  'required|confirmed|min:6',
			'vendorType'          =>  'required',
			'bio'        		=>  'required',
			'image'   			=>  'required|mimes:jpeg,jpg,png|max:2000',
        ]);

        // DB::beginTransaction();

        // try{

            $user =  User::firstOrCreate(['name'=>$request->name,'email'=> $request->email]);
            $user->status = 1;
            $user->password = bcrypt($request->password);
            $user->save();

            // $profile = Profile::create([
            //     "name"          => $request->Insurance,
            //     "email"         => $request->programtime,
            //     "password"      => bcrypt($request->password),
            // ]);

            $userid = $user->id;

			foreach($request->vendorType as $vendor){



				if($vendor == 'customer'){

				$role = 9;

				}elseif($vendor == 'hotels'){

				$role = 5;

				}elseif($vendor == 'packagedeals'){

				$role = 4 ;

				}elseif($vendor == 'transport'){

				$role = 6;

				}elseif($vendor == 'guestspass'){

				$role = 7;

				}elseif($vendor == 'guide'){

				$role = 8;

			}else{

				$role = 9;

			}

            $userrole = $user->roles()->attach([1 => ['role_id' => $role, 'user_id' => $userid]]);

			}

			$imageName = Storage::disk('website')->put('ProfileImage', $request->image);

            $profile = Profile::firstOrCreate([
                "user_id"   => $userid,
                "phone"     => $request->phoneno,
                "country"   => $request->countryCode,
				"pic"		=> $imageName,
				"bio"		=> $request->bio,
            ]);

            $credentials = [
                'email'     => $request->email,
                'password'  => $request->password,
            ];
            if (Auth::attempt(['email'=> $request->email,'password'=> $request->password,'status'=>1])) {

                    return redirect()->route('index');
            }else{
                echo 'else';

				return redirect()->route('index');
            }//end if



        // }
        // catch (\Throwable $e)
	    // {
	    // 	DB::rollback();
	    // }


    }

	public function oldbooking(){

		$userDetail = \Auth::user();

		if(isset($userDetail)){

		$guestpassreserves = GuestpassReservation::with('getcustomerorder','getGuestPassDetailsphoto')->where('CreatedBy',$userDetail->id)->get();

		return view('website.cart',compact('guestpassreserves'));

		}else{

			return redirect()->route('index');
		}

    }

    public function searchPackageDeals (Request $request){
		//        return $request->all();
        if ($request->total_guests_package) {
            $total_guests = $request->total_guests_package;
        }
        if ($request->total_guests) {
            $total_guests = $request->total_guests;
        }//end if else.
        $packageType = PackageDealType::get();
        $packageTypeName = PackageDealType::where('id',$request->owner_dm)->first();
        $searchPackageName = $packageTypeName->package_deals_type_desc;
        $packages = ManageSetting::with('getPackageDealsDefaultPhoto')->where('max_occupancy', '>=', $total_guests)->where('package_deals_type_id', 'like', '%' . $request->owner_dm . '%')->where('package_deals_status', '1')->paginate(12);
        $route_name = $request->path();
        $cityNames = ManageSetting::where('package_deals_status','1')->groupBy('package_deals_location')->get();
        return view('website.packages', compact('packages','packageType','route_name','searchPackageName','cityNames'));
	}

	public function mybookingsingleitem($id){
		dd($id);
	}

    public function updatePackageStatus($PackageDealsID, $status)
    {
        if ($status == 1) {
            ManageSetting::where('id', $PackageDealsID)->update(['package_deals_status' => 0]);
            return redirect()->back();
        } else {
            ManageSetting::where('id', $PackageDealsID)->update(['package_deals_status' => 1]);
            return redirect()->back();
        }//end if else.
    }//end updateCompanyStatus function.

	public function addPackageReview (Request $request)
	{
		$requestData = $request->all();
		$requestData['flag'] = 1;
		$data = PackageDealReview::create($requestData);
		return back();
	}

    //Package Deal Sorting
    public function myPackage(Request $request){
        $hotelsdata = Property::where('Published',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewAverage');
        $data = $hotelsdata->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getHotelReviewAverage)==0)continue;
            array_push($arr,$val->getHotelReviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $propertyIdArray=[];
        foreach ($arr as $ar){
            array_push($propertyIdArray, $ar->PropertyID);
        }
        $ids = implode(',', $propertyIdArray);
        $hotelsData = Property::where('Published',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelPics','getMinPriceRooms','getRooms','getHotelReviewAverage','getHotelReview','getUserFavoriteProperties')->whereIn('PropertyID',$propertyIdArray)->orderByRaw(DB::raw("FIELD(PropertyID, $ids)"))->paginate(12);
        $route_name = $request->path();
        return view('website.myhotels',compact('hotelsData','route_name'));
    }
    public function packageSorting(Request $request, $sort_type){
        if ($sort_type == 'price_high_to_low') {
          $packages = ManageSetting::where('package_deals_status', 1)->orderBy('price', 'DESC')->paginate(12);

        }
        elseif ($sort_type == 'price_low_to_high') {
          $packages = ManageSetting::where('package_deals_status', 1)->orderBy('price', 'ASC')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $packages = ManageSetting::where('package_deals_status',1)->with('getPackageReviewCount');
            $data = $packages->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewCount)==0)continue;
                array_push($arr,$val->getPackageReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
            $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails','getPackageReviewForView')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }


        elseif ($sort_type == 'min_reviews'){
         $packages = ManageSetting::where('package_deals_status',1)->with('getPackageReviewCount');
         $data = $packages->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewCount)==0)continue;
                array_push($arr,$val->getPackageReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
            $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails','getPackageReviewCount')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $packages = ManageSetting::where('package_deals_status',1)->with('getPackageReviewCount');
            $data = $packages->get();

            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewAverage)==0)continue;
                array_push($arr,$val->getPackageReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
             $ids = implode(',', $PackageDealsIdArray);
           $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $packages = ManageSetting::where('package_deals_status',1)->with('getPackageReviewAverage');
            $data = $packages->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewAverage)==0)continue;
                array_push($arr,$val->getPackageReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
            $packages = ManageSetting::where('package_deals_status',1)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
            $route_name = $request->path();
            $packageType = PackageDealType::get();
            return view('website.package_card_section',compact('packages','packageType','route_name'));
    }
    public function packageSortingWithCity(Request $request, $sort_type, $searchPackageName){
        $packageType = PackageDealType::where('package_deals_type_desc',$searchPackageName)->first();
        if ($sort_type == 'price_high_to_low'){
         $packages = ManageSetting::where('package_deals_status',1)->where('package_deals_type_id',$packageType->id)->orderBy('price','DESC')->paginate(12);

        }
        elseif ($sort_type == 'price_low_to_high') {
          $packages = ManageSetting::where('package_deals_status',1)->where('package_deals_type_id',$packageType->id)->orderBy('price','ASC')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
           $packages = ManageSetting::where('package_deals_status',1)->where('package_deals_type_id',$packageType->id)->with('getPackageReviewCount');
           $data = $packages->get();
           $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewCount)==0)continue;
                array_push($arr,$val->getPackageReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
              array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
           $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageType->id)->with('getPackageDealReviewDetails','getPackageReviewCount')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'min_reviews'){
           $packages = ManageSetting::where('package_deals_status',1)->where('package_deals_type_id',$packageType->id)->with('getPackageReviewCount');
            $data = $packages->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewCount)==0)continue;
                array_push($arr,$val->getPackageReviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
            $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageType->id)->with('getPackageDealReviewDetails','getPackageReviewCount')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $packages = ManageSetting::where('package_deals_status',1)->where('package_deals_type_id',$packageType->id)->with('getPackageReviewCount');
            $data = $packages->get();

            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewAverage)==0)continue;
                array_push($arr,$val->getPackageReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
            $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageType->id)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $packages = ManageSetting::where('package_deals_status',1)->where('package_deals_type_id',$packageType->id)->with('getPackageReviewCount');
            $data = $packages->get();
            $arr = [];
            foreach($data as $key=>$val){
                if(sizeof($val->getPackageReviewAverage)==0)continue;
                array_push($arr,$val->getPackageReviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $PackageDealsIdArray=[];
            foreach ($arr as $ar){
                array_push($PackageDealsIdArray, $ar->PackageDealsID);
            }
            $ids = implode(',', $PackageDealsIdArray);
           $packages = ManageSetting::where('package_deals_status',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageType->id)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        $packageType = PackageDealType::get();
        return view('website.package_card_section',compact('packages','packageType','route_name'));
}

    public function myPackageBookingCalendar(){
        if(auth()->user()->hasrole('PackagesAdmin')){
         $packagebookingCalendar = Search::where('user_id',Auth()->user()->id)->with('getPackageDealsOrderDetail')->get();
        return view('website.vendor_package_calendar',compact('packagebookingCalendar'));
        }
    }

    public function testing(){
    //return     Storage::disk('website')->delete('img/abc.png');
    //    $imageName = Storage::disk('website')->put('ProfileImage', $request->image);
        return back();
    }
}

