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
use App\VendorTransportRoute;
use App\WithdrawRequest;
use function Couchbase\basicEncoderV1;
use function GuzzleHttp\Promise\all;
use Illuminate\Cache\RedisTaggedCache;
use Illuminate\Http\Request;
use DB;
use App\GuestPass;
use App\RoleUser;
use App\Room;
use App\Guide;
use App\Blog;
use App\FAQ;
use App\SPFAQ;
use App\GuideLanguage;
use App\AskAQuestion;
use App\GuestPassReview;
use App\AgencyImage;
use App\Contact;
use App\Discover;
use App\ContactDetail;
use App\Transportationroute;
use App\Property;
use App\PropertyPhoto;
use App\Testimonial;
use App\VisaArrival;
use App\TravelAgency;
use App\User;
use App\Profile;
use App\About;
use App\TourTrip;
use App\GuestpassReservation;
use App\PropertyFavorite;
use App\ManageSetting;
use App\PackageDealPhoto;
use App\TransportMainRoute;
use App\TransportationPhoto;
use Illuminate\Mail\Transport\Transport;
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
use App\Guid;
//stripe
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Stripe\Price;
use Stripe\StripeClient;
use App\Subscription;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CarbonPeriod;
use URL;

class WebsiteController extends Controller
{
    public function __construct()
    {
        //its just a dummy data object.
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
        header('Access-Control-Allow-Origin: *');
        $cityNames = City::where('citystatus',1)->get('GuestPassLocation');
        // Sharing is caring
        View::share('cityNames', $cityNames);
    }
    public function index(){
        $packageType = PackageDealType::get();
        $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
        $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
        $packages = ManageSetting::with('getPackageDealsDefaultPhoto','getPackageReviewForView')->orderBy('id', 'DESC')->where('Package_deals_status', 1)->where('display_on_home_page',1)->get();
        $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->where('DisplayOnHomePage',1)->get();
        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('DisplayOnHomePage',1)->get();
        $pages = About::get();
        $faqs = FAQ::limit(5)->get();
        $tourtrips = TourTrip::where('feature',1)->first();
        $tourtrips_lower = TourTrip::where('feature',null)->get();
        $testimonials = Testimonial::get();
        $discovers = Discover::get();
        $blogs = Blog::get();
        return view('website.index',compact('packages','guestpass','guides','tourtrips_lower','transportation_routes_from','transportation_routes_to','packageType','pages','faqs','tourtrips','testimonials','discovers','blogs'));
    }//end index function.
    public function myhotels(Request $request){
//        if(Session::has('checkin_date') || Session::has('checkout_date')){
            session()->forget('checkin_date');
            session()->forget('checkout_date');
            session()->forget('adults_guide');
            session()->forget('childs_guide');
            session()->forget('infants_guide');
//        }
        $default_checkin = Date('m/d/Y', strtotime('+7 days'));
        $default_checkout = Date('m/d/Y', strtotime('+17 days'));
        $pages = About::get();
        $hotelsdata = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('City','karbala')->with('getHotelReviewAverage');
        $data = $hotelsdata->get();
        $arr = [];
        foreach($data as $key=>$val){
            if(sizeof($val->getHotelReviewAverage) == 0)continue;
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
        return view('website.myhotels',compact('hotelsData','route_name','pages','default_checkin','default_checkout'));
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
        // return$request->all();
        if($request->data){
            $existingData = json_decode($request->data);
        }else{
            $existingData = [];
        }//end if esle.
        $hotelData = Property::where('Published',1)->where('Admin_status',1)->where('userstatus',1)->with('getHotelPics','getRooms','getHotelReviewAverage','getHotelFeaturesAndAmenities','getHotelReview')->where('PropertyID',$id)->first();
        if(!empty($hotelData)){
            $default_checkin=Date('m/d/Y', strtotime('+7 days'));
            $default_checkout=Date('m/d/Y', strtotime('+17 days'));
            return view('website.hoteldetails',compact('hotelData','default_checkin','default_checkout','existingData'));
         }else{
            return back();
        }
    }
    //22Sep2021
    public function addFavoriteProperty(Request $request, $PropertyID, $CategoryID){
        if(Auth::id()){
            PropertyFavorite::updateorCreate(['user_id' => Auth::id(),'property_id' => $PropertyID,'category_id' => $CategoryID]);
            return 'Add in favorite successfully';
        }
        return 'Add in favorite fail';
    }
    //22Sep2021
    public function removeFavoriteProperty(Request $request, $PropertyID, $CategoryID){
        if(Auth::id()){
            PropertyFavorite::where('user_id', '=', Auth::id())->where('property_id', '=', $PropertyID)->where('category_id', '=', $CategoryID)->delete();
            return 'Remove from favorite successfully';
        }
        return 'Remove from favorite fail';
    }
    public function viewFavorites(Request $request){
        $favoriteProperties = PropertyFavorite::where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        $favourites = [];
        if (!sizeof($favoriteProperties) == 0){
            foreach ($favoriteProperties as $key=>$item){
                if ($item->category_id=='1'){
                    $package = ManageSetting::where('Package_deals_status', 1)->where('id',$item->property_id)->first();
                    array_push($favourites,['name'=>$package->package_deals_name,'price'=>$package->price,'image'=>$package->getPackageDealsDefaultPhoto->PhotoLocation??null,'route'=>URL('packagesdetail/'.$item->property_id.'/'.$package->package_deals_name),'property_id'=>$item->property_id,'category_id'=>$item->category_id]);
                }elseif ($item->category_id=='2'){
                    $property = Property::with('getMinPriceRooms')->where('Published',1)->where('Admin_status',1)->where('userstatus',1)->where('PropertyTypeID',1)->where('PropertyId',$item->property_id)->first();
                    array_push($favourites,['name'=>$property->Name,'price'=>$property->getMinPriceRooms->Price??'','image'=>$property->getHotelDefaultPhoto->PhotoLocation??null,'route'=>URL('hotelsdetails/'.$item->property_id.'/'.$property->Name),'property_id'=>$item->property_id,'category_id'=>$item->category_id]);
                }elseif ($item->category_id=='3'){
                    $transport = Transportationroute::where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('VehicleRouteID',$item->property_id)->first();
                    array_push($favourites,['name'=>$transport->NameofVehicle,'price'=>$transport->Price,'image'=>$transport->getTransportDefaultPic->PhotoLocation??null,'route'=>URL('transportdetails/'.$item->property_id.'/'.$transport->NameofVehicle),'property_id'=>$item->property_id,'category_id'=>$item->category_id]);
                }elseif ($item->category_id=='4'){
                    $guestpass = GuestPass::where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->where('GuestPassID',$item->property_id)->first();
                    array_push($favourites,['name'=>$guestpass->GuestPassName,'price'=>$guestpass->Price,'image'=>$guestpass->getGuestPassDefaultPic->PhotoLocation??null,'route'=>URL('guestdetails/'.$item->property_id.'/'.$guestpass->GuestPassName),'property_id'=>$item->property_id,'category_id'=>$item->category_id]);
                }elseif ($item->category_id=='5'){
                    $guide = Guide::where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('GuidesID',$item->property_id)->first();
                    array_push($favourites,['name'=>$guide->GuidesName??'','price'=>$guide->PricePerDay??'','image'=>$guide->getGuideDefaultPic->PhotoLocation??null,'route'=>URL('guide-details/'.$item->property_id.'/'.$guide->GuidesName??''),'property_id'=>$item->property_id??'','category_id'=>$item->category_id??'']);
                }//end
            }
            $route_name = $request->path();
//            return sizeof($favoriteProperties);
            return view('website.favourite',compact('favourites','route_name'));

        } else{
            return back()->with('no_favourite_found', 'You favorite is empty!');
        }//end
        return back();
    }
    public function checkout(){
//        $tax_and_charges = session()->get('tax_and_charges');
////        return gettype(intval($tax_and_charges));
//        $tax_and_charges = intval($tax_and_charges);
        if(Auth::check()) {
            if (Auth::user()->hasRole('customer')) {
                $data['cart'] = session()->get("cart");

                //dd($data['cart']);

                if (isset($data['cart']["id"])) {

                    if ($data['cart']["category"] == "4") {

                        // dd($data['cart']["category"]);

                        // $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassID',$data['cart']["id"]);

                        $data['categoryitem'] = GuestPass::with('getGuestPassDetails', 'getGuestPassprogramDetails', 'getGuestPassreviewdetails', 'guestpassbyuser')->where('GuestPassID', $data['cart']["id"])->first();
                        // return $data;


                    } elseif ($data['cart']["category"] == "1") {

                        $data['categoryitem'] = ManageSetting::where('id', $data['cart']["id"])->with('getPackageReviewAverage', 'getPackageReviewCountForView', 'getPackageDealsphoto', 'getPackageDealsType', 'getPackageDealsDefaultPhoto', 'getPackageReviewAverageForView', 'getPackageUser')->first();
                        // dd($data['categoryitem']);
                    } elseif ($data['cart']["category"] == "2") {
                        // dd($data['cart']["id"]);
                       $data['roomid'] = Room::where('id', $data['cart']["id"])->first();
                        // dd($data['roomid']->PropertyId);
                       $data['categoryitem'] = Property::with('getHotelReviewAverage', 'getUserofProperty', 'getHotelReview')->where('PropertyId', $data['roomid']->PropertyId)->first();
                        // dd($data['categoryitem']);
                    } elseif ($data['cart']["category"] == "3") {
                        $data['categoryitem'] = Transportationroute::with('getTransporttype', 'getTransportRoutes.getTransportmainroute', 'getTransportReviewForView', 'getTransportDefaultPic', 'getTransportPics', 'getTransportuser', 'getTransportuserprofile')->where('Status', 1)->where('status_from_admin', 1)->where('vendor_status', 1)->where('VehicleRouteID', $data['cart']["id"])->first();
                    } elseif ($data['cart']["category"] == "5") {
                        $data['categoryitem'] = Guide::with('getGuideReviewForView', 'getGuideReviewAverageForView', 'getGuideReviewCountForView', 'getGuideDefaultPic', 'getguideUser')->where('GuidesStatus', 1)->where('Admin_status', 1)->where('userstatus', 1)->where('GuidesID', $data['cart']["id"])->first();
                    }
                }
                // dd($data['cart']["category"]);
                // return $data;
                return view('website.checkout', $data);
            }
            else{
                return back()->with('vendors_not_allowed', 'Service Providers or vendors are not allowed for booking...');
            }
        }
        else{
            $data['cart'] = session()->get("cart");
            // dd($data['cart']);
            if (isset($data['cart']["id"])) {
                if ($data['cart']["category"] == "4") {
                    // dd($data['cart']["category"]);
                    // $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassID',$data['cart']["id"]);
                    $data['categoryitem'] = GuestPass::with('getGuestPassDetails', 'getGuestPassprogramDetails', 'getGuestPassreviewdetails', 'guestpassbyuser')->where('GuestPassID', $data['cart']["id"])->first();
                    // return $data;
                } elseif ($data['cart']["category"] == "1") {
                    $data['categoryitem'] = ManageSetting::where('id', $data['cart']["id"])->with('getPackageReviewAverage', 'getPackageReviewCountForView', 'getPackageDealsphoto', 'getPackageDealsType', 'getPackageDealsDefaultPhoto', 'getPackageReviewAverageForView', 'getPackageUser')->first();
                    // dd($data['categoryitem']);
                }elseif ($data['cart']["category"] == "2") {

                    // dd($data['cart']["id"]);
                    $data['roomid'] = Room::where('id', $data['cart']["id"])->first();
                    // dd($data['roomid']->PropertyId);
                    $data['categoryitem'] = Property::with('getHotelReviewAverage', 'getUserofProperty', 'getHotelReview')->where('PropertyId', $data['roomid']->PropertyId)->first();
                    // dd($data['categoryitem']);
                }elseif ($data['cart']["category"] == "3") {
                    $data['categoryitem'] = Transportationroute::with('getTransporttype', 'getTransportmainroute', 'getTransportReviewForView', 'getTransportDefaultPic', 'getTransportPics', 'getTransportuser', 'getTransportuserprofile')->where('Status', 1)->where('status_from_admin', 1)->where('vendor_status', 1)->where('VehicleRouteID', $data['cart']["id"])->first();
                }elseif ($data['cart']["category"] == "5") {
                    $data['categoryitem'] = Guide::with('getGuideReviewForView', 'getGuideReviewAverageForView', 'getGuideReviewCountForView', 'getGuideDefaultPic', 'getguideUser')->where('GuidesStatus', 1)->where('Admin_status', 1)->where('userstatus', 1)->where('GuidesID', $data['cart']["id"])->first();

                }
            }
            // dd($data['cart']["category"]);
            // return $data;
            return view('website.checkout', $data);
        }
    }

    public function mypackages(Request $request){
//        $packages = ManageSetting::with('getPackageDealsDefaultPhoto','getPackageReviewForView')->orderBy('id', 'DESC')->where('Package_deals_status', 1)->paginate(12);
        $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->with('getPackageReviewCount');
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
        $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        $packageType = PackageDealType::get();
        $route_name = $request->path();
        $cityNames = ManageSetting::where('package_deals_status','1')->groupBy('package_deals_location')->get();
        $packagesdeals = About::get();
        return view('website.packages',compact('packages','packageType','route_name','cityNames','packagesdeals'));

    }
    public function mypackagedetail($id,$name){
        $packageType = PackageDealType::get();
//        $review = PackageDealReview::where('PackageDealsID',$id)->where('flag',1)->get();
        $packages = ManageSetting::where('id',$id)->with('getPackageReviewCountForView','getPackageDealsphoto','getPackageDealsType','getPackageDealsDefaultPhoto','getPackageReviewAverageForView','getPackageUser')->first();
        $is_user_book_this_before = Search::where('package_deals_id',$id)->where('user_id',Auth::id())->where('booking_status','CONFIRMED')->where('payment_status','PAID')->whereDate('reservation_for_date','<',date('Y-m-d'))->get();
        $packagesresevationdata = Search::where([['package_deals_id','=',$id],['booking_status','!=','CONFIRMED']])->sum('qty');
        $packagesoccupancy = ManageSetting::where('id',$id)->first();
        $is_booking_available = false;
        if((($packagesoccupancy->max_occupancy)-(intval($packagesresevationdata)))>0){
            $is_booking_available = true;}
        return view('website.packagedetail',compact('packages','packageType','is_user_book_this_before','is_booking_available'));
    }
    public function myvisa(){
        $pages = About::get();
        $visaArrivals = VisaArrival::where('status',0)->get();
        $lowercases = VisaArrival::where('status',1)->get();
        return view('website.visa',compact('pages','visaArrivals','lowercases'));

    }
    public function myflight(){
        $pages = About::get();
        $agencies = TravelAgency::get();
        $agencyImages = AgencyImage::where('status',1)->get();
        return view('website.flights',compact('pages','agencies','agencyImages'));

    }
    public function myguestspasses(Request $request){
        // $data = $guestPass = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails')->get();
        // return $guestpass = DB::select('call All_GuestPass_Active()');
        //$guestpass = GuestPass::with('getGuestPassreviewAverage')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->get();
        $pages = About::get();
        $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
        $avgs = $guestpassdata->get();
        $arr = [];
        foreach($avgs as $key=>$val){
            if(sizeof($val->getGuestPassreviewAverage)==0)continue;
            array_push($arr,$val->getGuestPassreviewAverage[0]);
        }
        for ($j = 0; $j < count($arr) - 1; $j++){
            if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
                $j = -1;
            }
        }
        $gustPasses = [];
        foreach($arr as $ar){
            array_push($gustPasses, $ar->GuestPassID);
        }
        $ids = implode(',', $gustPasses);
        $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->whereIn('GuestPassID',$gustPasses)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        $route_name = $request->path();
        return view('website.guestspass',compact('guestpass','route_name','pages'));
        // return view('website.guestspass',compact('data'));
    }
    public function guestsPassesByCity(Request $request,$cityName){
        $pages = About::get();
        $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
        $avgs = $guestpassdata->get();
        $arr = [];
        foreach($avgs as $key=>$val){
            if(sizeof($val->getGuestPassreviewAverage) == 0) continue;
            array_push($arr,$val->getGuestPassreviewAverage[0]);
        }
        $gustPasses = [];
        foreach($arr as $ar){
            array_push($gustPasses, $ar->GuestPassID);
        }
        $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->whereIn('GuestPassID',$gustPasses)->where('GuestPassLocation',$cityName)->paginate(12);
        // $cityNames = GuestPass::where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->groupBy('GuestPassLocation')->get('GuestPassLocation');
        $route_name = $request->path();
        return view('website.guestspass',compact('pages','guestpass','route_name', 'cityName'));
        // return $cityName;
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
        return view('website.packages',compact('packages','route_name','packageType','cityNames','cityName'));
//        return $cityName;
    }

    public function packageDealsByType(Request $request,$id){
        $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$id)->with('getPackageReviewCount');
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
        $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$id)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        $packageType = PackageDealType::get();
        $route_name = $request->path();
        $cityNames = ManageSetting::where('package_deals_status','1')->groupBy('package_deals_location')->get();
        $packagesdeals = About::get();
        return view('website.packages',compact('packagesdeals','packages','packageType','route_name','cityNames','id'));
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
        // return $request->all();
//        session()->forget();
        Session::forget('RouteFrom');
        Session::forget('RouteTo');
        try {
            $pages = About::get();
            $karbala_to_najaf_transport_route = TransportMainRoute::where('RouteFrom','Karbala')->where('RouteTo','Najaf')->first();
            $karbala_to_najaf_transport_route_id = $karbala_to_najaf_transport_route->RouteID;
            $transports = Transportationroute::with('getTransportReviewAverageForView')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('RouteID',$karbala_to_najaf_transport_route_id);
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
                $transports = Transportationroute::with('getTransportRoutes','getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverageForView')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('RouteID',$karbala_to_najaf_transport_route_id)->whereIn('VehicleRouteID',$transportationIdArray)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
                $transportation_types = Transportationtype::groupBy('TransportationTypeDesc')->get();
                $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
                $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
                $route_name = $request->path();
                $pages = About::get();
                $date =Date('Y-m-d', strtotime('+2 day'));
                return view('website.transport',compact('date','pages','transports','transportation_types','route_name','transportation_routes_from','transportation_routes_to','pages'));
            }
            else{
                return back()->with('no_transportation_found', 'No Transportation Found');
            }
        }
        catch (\Exception $e){
            return back()->with('no_transportation_found', 'No Transportation Found');
        }
    }

    public function mytranspotationdetails(Request $request, $id,$name){
//        return$request->data;
        if($request->data){
            $existingData = json_decode($request->data);
        }else{
            $existingData = [];
        }//end if esle.
        $transport = Transportationroute::with('getTransportRoutes','getTransporttype','getTransportmainroute','getTransportuser','getTransportReviewForView','getTransportDefaultPic','getTransportPics')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('VehicleRouteID',$id)->first();
        $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
        $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
        $route_name = $request->path();
        $date = Date('Y-m-d', strtotime('+2 day'));
        return view('website.tranportationdetails',compact('existingData','date','transport','transportation_routes_from','transportation_routes_to','route_name'));
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
        $pages = About::get();
        return view('website.transport',compact('pages','transports','transportation_types','route_name','transportation_routes_from','transportation_routes_to','TransportationTypeID'));
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
        // return $request->all();

        try {
            Session::put('RouteFrom',$request->route_from);
            Session::put('RouteTo',$request->route_to);
            $type = $request->type;
            $transportation_route_ids = TransportMainRoute::where('RouteFrom',$request->route_from)->where('RouteTo',$request->route_to)->first('RouteID');
            $searched_transportation_id = $transportation_route_ids->RouteID??'';
            $transportation_vehicle_route_ids = VendorTransportRoute::where('RouteID',$transportation_route_ids->RouteID)->get()->pluck('VehicleRouteID');
            $transports = Transportationroute::with('getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportation_vehicle_route_ids);
            //        $transports = Transportationroute::with('getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportation_vehicle_route_ids);
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
//        $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->whereIn('RouteID',$transportation_route_ids)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            $transports = Transportationroute::with('getTransporttype','getTransportmainroute','getTransportowner','getTransportDefaultPic','getTransportReviewAverage','getTransportRoutes')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->whereIn('VehicleRouteID',$transportationIdArray)->whereIn('VehicleRouteID',$transportation_vehicle_route_ids)->orderByRaw(DB::raw("FIELD(VehicleRouteID, $ids)"))->paginate(12);
            $transportation_types = Transportationtype::groupBy('TransportationTypeDesc')->get();
            $transportation_routes_from = TransportMainRoute::groupBy('RouteFrom')->get();
            $transportation_routes_to = TransportMainRoute::groupBy('RouteTo')->get();
            $transportation_routes_from_name = $request->route_from;
            $transportation_routes_to_name = $request->route_to;
            $route_name = $request->path();
            $pages = About::get();
            $date= $request->start;
            return view('website.transport',compact('date','pages','transports','transportation_types','route_name','transportation_routes_from','transportation_routes_to','searched_transportation_id','type','transportation_routes_from_name','transportation_routes_to_name'));
        }
        catch (\Exception $e){
            return back()->with('no_transportation_found', 'No Transportation Found.');
        }

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
        // return$request->all();
        session()->forget('checkin_date');
        session()->forget('checkout_date');
        session()->forget('adults_guide');
        session()->forget('childs_guide');
        session()->forget('infants_guide');
        $default_checkin=date('m/d/Y');
        $default_checkout=Date('m/d/Y', strtotime('+10 days'));
        $pages = About::get();
        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1);
        $data = $guides->get();
        if(sizeof($data)>0){
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
            return view('website.myguide',compact('guides','guide_cities','guide_languages','route_name','pages', 'default_checkin', 'default_checkout'));
        }
        else{
            return back()->with('no_transportation_found', 'No Guide Found');
        }
    }

    public function guideDetails(Request $request, $id){
//        return$request->data;
        if($request->data){
            $existingData = json_decode($request->data);
        }else{
            $existingData = [];
        }//end if esle.
        $checkin_date = session()->get('checkin_date');
        $checkout_date = session()->get('checkout_date');

        $adults_guide = session()->get('adults_guide');
        $childs_guide = session()->get('childs_guide');
        $infants_guide = session()->get('infants_guide');

        $guides = Guide::with('getGuideReviewForView','getGuideReviewAverageForView','getGuideReviewCountForView','getGuideDefaultPic','getguideUser')->where('GuidesStatus',1)->where('Admin_status',1)->where('userstatus',1)->where('GuidesID',$id)->first();
        $guide_cities = GuideCity::where('status',1)->get();
        $guide_languages = GuideLanguage::where('status',1)->get();
        return view('website.guidedetails',compact('guides','guide_cities','guide_languages', 'checkin_date', 'checkout_date', 'adults_guide', 'childs_guide', 'infants_guide', 'existingData'));

    }

    public function addGuideReview (Request $request){
    //        return $request;
        $data = Guides_Review::create($request->all());
        return back();
    }

    public function searchGuide(Request $request){
        // return $request;
        $default_checkin = substr($request->daterange, 0, 10);
        $default_checkout = substr($request->daterange, 13, 23);
        $checkin_date = substr($request->daterange, 0, 10);
        $checkout_date = substr($request->daterange, 13, 23);
        session()->put('checkin_date', $checkin_date);
        session()->put('checkout_date', $checkout_date);
        $diff = abs(strtotime($checkin_date) - strtotime($checkout_date));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $adults_guide = $request->adults_guide;
        $childs_guide = $request->childs_guide;
        $infants_guide = $request->infants_guide;
        session()->put('adults_guide', $adults_guide);
        session()->put('childs_guide', $childs_guide);
        session()->put('infants_guide', $infants_guide);

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
        $pages = About::get();
        return view('website.myguide',compact('pages','guides','guide_cities','guide_languages','route_name','searched_city', 'searched_language','total_guests', 'default_checkin', 'default_checkout', 'checkin_date', 'checkout_date', 'diff', 'years', 'months', 'days', 'adults_guide', 'childs_guide', 'infants_guide'));
    }

    public function guideByLanguage(Request $request, $language){
        $pages =  About::get();
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
        return view('website.myguide',compact('pages','guides','guide_cities','guide_languages','route_name'));
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
//        return $request;
        $tax_and_charges = $request->tax_and_charges;
        session()->put('tax_and_charges', $tax_and_charges);
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
                'RouteID'			=>	'required',
            ],[
                'RouteID.required' => 'Please Select Route'
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
//            return $request;
            // $transportvehicle = Transportationroute::where('VehicleRouteID',$request->id)->first();

            $transportbookedflag = 0 ;

            $time = strtotime($request->date);

            $newformatdatepickup = date('Y-m-d H:i:s',$time);

            $datederror = [];


            $date=date_create($newformatdatepickup);
            $mydayquantity = $request->quantity;
            date_add($date,date_interval_create_from_date_string($mydayquantity." days"));
            $newformatdatedropout = date_format($date,"Y-m-d 00:00:00");

            // dd($date);

            $period = new DatePeriod(
                new DateTime($newformatdatepickup),
                new DateInterval('P1D'),
                new DateTime($newformatdatedropout)
            );

            foreach ($period as $key => $value) {

                // dd($value->format('Y-m-d'));


                $transportreservationbooked = TransportReservation::where('NumberPlate',$request->numberplate)->whereDate('PickUpDateTime',$value->format('Y-m-d 00:00:00'))->first();

                // return $transportreservationbooked;

                if($transportreservationbooked){

                    $transportbookedflag = 1 ;

                    // dd($value->format('Y-m-d'));

                    array_push($datederror,$value->format('Y-m-d'));

                }

            }

            if($transportbookedflag == 1){

                Session::flash('bookedDates',$datederror);

                // dd($datederror);

                return  Redirect::back();

            }

            // $d=strtotime($request->date);

            // $requestdate = date("Y-m-d 00:00:00", $d);

            // $transportreservationbookedqty = TransportReservation::where('VehicleRouteID',$request->id)->where('PickUpDateTime',$requestdate)->sum('qty');



            // $transportvehicleoccupancy = Transportationroute::with('getTransporttype')->where('Status',1)->where('status_from_admin',1)->where('vendor_status',1)->where('VehicleRouteID',$request->id)->first();


            // $transportorder = intval($transportreservationbookedqty) + $request->quantity;



            // if( $transportorder > $transportvehicleoccupancy->getTransporttype->NumOfSeats  ){



            // return  Redirect::back()->withErrors(['message' => 'This Vehicle is fully booked on this date']);

            // }


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

            $Bookdates = explode('-',$request->date);

            $time = strtotime($Bookdates[1]);

            $checkoutnewformatdate = date('Y-m-d',$time);

            $period = new DatePeriod(
                new DateTime($Bookdates[0]),
                new DateInterval('P1D'),
                new DateTime($Bookdates[1])
            );

            $datederror = [];

            $guidebookedflag = 0 ;


            foreach ($period as $key => $value) {

                // dd($value);

                $guidereservationdates = GuideReservation::where('GuidesID',$request->id)->whereDate('reservation_start_date',$value->format('Y-m-d'))->first();

                // dd($value->format('Y-m-d 00:00:00'));

                // dd($roomreservationbookedqty,$roomoccupancy->AvailableQty);

                // dd($guidereservationdates);

                if($guidereservationdates){

                    $guidebookedflag = 1 ;

                    // dd($value->format('Y-m-d'));

                    array_push($datederror,$value->format('Y-m-d'));

                }

            }

            if($guidebookedflag == 1){

                Session::flash('bookedDates',$datederror);

                // dd($datederror);

                return  Redirect::back();

            }



            if($Bookdates[0]){

                $checkinonlytime = strtotime($Bookdates[0]);

                $checkinonlynewformatdate = date('Y-m-d',$checkinonlytime);


                $guidereservationdates = GuideReservation::where('GuidesID',$request->id)->whereDate('reservation_start_date',$checkinonlynewformatdate)->first();

                // dd($guidereservationdates);

                if($guidereservationdates){

                    $guidebookedflag = 1 ;

                    // dd($value->format('Y-m-d'));

                    array_push($datederror,$checkinonlynewformatdate);

                }


            }

            if($guidebookedflag == 1){

                Session::flash('bookedDates',$datederror);

                // dd($datederror);

                return  Redirect::back();

            }



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
                    "RouteID"			=>  $request->RouteID??0,
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
//            if($cart){
                return redirect('checkout');
//            }else{
//                return redirect('checkout');
//            }//end if else.
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
        $abouts = About::get();
        return view('website.aboutus',compact('abouts'));
    }//end aboutus function.

    public function privacypolicy(){
        $pages = About::get();
        return view('website.privacypolicy',compact('pages'));
    }//end privacypolicy function.

    public function faq(){
        $pages = About::get();
        $faqs = FAQ::paginate(6);
        return view('website.faq',compact('pages','faqs'));
    }//end faq function.

    public function sqlconnect(){

        $data['guestpass'] = DB::select('call SP_GET_PackageDealsDetails(1)',[$id]);

        dd($data);
    }//end sqlconnect function.

    public function searchGuestpass (Request $request){
        //  return $request;
        extract($request->all());
        $search_city = $city;
        $route_name = $request->path();
        $pages = About::get();
        $cityName = $city;
        $guestpass  = GuestPass::with('getGuestPassDetails','getGuestPassprogramDetails','getGuestPassreviewdetails')->where('MaxOccupancy','>=',$request->total_guests)->where('GuestPassLocation','like','%'.$request->city.'%')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->paginate(12);
        return view('website.guestspass', compact('guestpass','route_name','search_city','pages','cityName'));
    }

    public function searchHotels(Request $request){
//        return $request->all();
        $default_checkin = substr($request->daterange, 0, 10);
        $default_checkout = substr($request->daterange, 13, 23);
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
        $pages = About::get();
        return view('website.myhotels',compact('hotelsData','route_name','search_city','days','pages','default_checkin','default_checkout','checkin_date','checkout_date','total_guests_hotels','adults_hotels','childs_hotels','infants_hotels'));
    }
    public function addPropertyReview (Request $request)
    {
        $requestData = $request->all();
        $requestData['Flag'] = 1;
        $data = PropertyReview::create($requestData);
        return back();
    }//end addPropertyReview function.
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
    }//end GuestPassReview function.
    public function checkoutsubmit($request){


        $user = Auth::user();

        // print_r($user);

        $cart = session()->get('cart');

        // dd($cart);
        $PaymentStatus = 'UNPAID';
        if(isset($cart[0]['transaction_id']) || isset($cart[0]['charge_id']) ){

            $PaymentStatus = 'PAID';

            if($cart[0]['payment_type'] == "zelle"){
                $PaymentStatus = 'UNPAID';
            }

        }else{
            $PaymentStatus = 'UNPAID';
        }

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
                            "ReceiptNum"   			=> 	$guestpassreserveid??'',
                            "GuestPassID"     		=> 	$cart['id']??'',
                            "qty"   				=> 	$cart['quantity']??"",
                            "CreatedBy"   			=> 	$user->id??'',
                            "CreatedOn"     		=> 	date('Y-m-d h:i:sa'),
                            "ReservationForDate"	=> 	$newformatdate??'',
                            "NotesByCustomer"   	=> 	$request->customernotes??'',
                            "Insurance" 			=>	$request->Insurance??'',
                            "Donation"				=>	$request->donation??'',
                            "donation_shrine_name"				=>	$request->donation_shrine_name??'',
                            "Donation_amount"		=>	$request->formtotaldonation??'',
                            "TotalPrice"     		=> 	$request->formtotalamount??0+25,
                            "BookingStatus"   		=> 	"PENDING",
                            "reservation_status"		=>	'Booked',
                            "PaymentStatus"   		=> 	$PaymentStatus??'',
                            "SPComments"     		=> 	$request->customernotes??'',
                            "SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
                            "updated_at"			=>	date('Y-m-d h:i:sa'),
                            "created_at"			=>	date('Y-m-d h:i:sa'),
                            "customer_id"			=>	$cart[0]['customer_id']??'',
                            "charge_id"			    =>	$cart[0]['charge_id']??'',
                            "reciept_url"			=>	$cart[0]['reciept_url']??'',
                            "transaction_id"	    =>	$cart[0]['transaction_id']??'',
                            "TypeofPayment"			=>	$cart[0]['payment_type']??'',
                            "DepositorName"			=>	$cart[0]['depositorname']??'',
                            "DepositorEmail"		=>	$cart[0]['depositoremail']??'',
                            "DepositorNumber"		=>	$cart[0]['depositorphoneno']??'',
                            "ChequeNum"				=>	$cart[0]['chequenumber']??'',
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

                                "ReceiptNum"   			=> 	$hotelreserveid??'',
                                "PropertyID"     		=> 	$request->propertyid??'',
                                "RoomID"     			=> 	$cart['id']??'',
                                "qty"   				=> 	$cart['quantity']??'',
                                "CreatedBy"   			=> 	$user->id??'',
                                "CreateDate"   			=> 	date('Y-m-d h:i:sa'),
                                "CreatedOn"     		=> 	date('Y-m-d h:i:sa'),
                                "checkin"				=> 	$value->format('Y-m-d')??'',
                                "checkout"				=> 	$checkoutnewformatdate??'',
                                "NotesByCustomer"   	=> 	$request->customernotes??'',
                                "Insurance" 			=>	$request->Insurance??'',
                                "Donation"				=>	$request->donation??'',
                                "donation_shrine_name"				=>	$request->donation_shrine_name??'',
                                "Donation_amount"		=>	$request->formtotaldonation??'',
                                "TotalPrice"     		=> 	$request->formtotalamount??0+25,
                                "BookingStatus"   		=> 	"PENDING",
                                "PaymentStatus"   		=> 	$PaymentStatus??'',
                                "SPComments"     		=> 	$request->customernotes??'',
                                "SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
                                "updated_at"			=>	date('Y-m-d h:i:sa'),
                                "created_at"			=>	date('Y-m-d h:i:sa'),
                                "customer_id"			=>	$cart[0]['customer_id']??'',
                                "charge_id"				=>	$cart[0]['charge_id']??'',
                                "reciept_url"			=>	$cart[0]['reciept_url']??'',
                                "transaction_id"		=>	$cart[0]['transaction_id']??'',
                                "TypeofPayment"			=>	$cart[0]['payment_type']??'',
                                "DepositorName"			=>	$cart[0]['depositorname']??'',
                                "DepositorEmail"		=>	$cart[0]['depositoremail']??'',
                                "DepositorNumber"		=>	$cart[0]['depositorphoneno']??'',
                                "ChequeNum"				=>	$cart[0]['chequenumber']??'',

                            ]);

                        }


                        $RoomReservation = Roomreservation::firstOrCreate([

                            "ReceiptNum"   			=> 	$hotelreserveid??'',
                            "PropertyID"     		=> 	$request->propertyid??'',
                            "RoomID"     			=> 	$cart['id']??'',
                            "qty"   				=> 	$cart['quantity']??'',
                            "CreatedBy"   			=> 	$user->id,
                            "CreateDate"   			=> 	date('Y-m-d h:i:sa'),
                            "CreatedOn"     		=> 	date('Y-m-d h:i:sa'),
                            "checkin"				=> 	$checkoutnewformatdate??'',
                            "checkout"				=> 	$checkoutnewformatdate??'',
                            "NotesByCustomer"   	=> 	$request->customernotes??'',
                            "Insurance" 			=>	$request->Insurance??'',
                            "Donation"				=>	$request->donation??'',
                            "donation_shrine_name"				=>	$request->donation_shrine_name??'',
                            "Donation_amount"		=>	$request->formtotaldonation??'',
                            "TotalPrice"     		=> 	$request->formtotalamount??0+25,
                            "BookingStatus"   		=> 	"PENDING",
                            "PaymentStatus"   		=> 	$PaymentStatus??'',
                            "SPComments"     		=> 	$request->customernotes??'',
                            "SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
                            "updated_at"			=>	date('Y-m-d h:i:sa'),
                            "created_at"			=>	date('Y-m-d h:i:sa'),
                            "customer_id"			=>	$cart[0]['customer_id']??'',
                            "charge_id"				=>	$cart[0]['charge_id']??'',
                            "reciept_url"			=>	$cart[0]['reciept_url']??'',
                            "transaction_id"		=>	$cart[0]['transaction_id']??'',
                            "TypeofPayment"			=>	$cart[0]['payment_type']??'',
                            "DepositorName"			=>	$cart[0]['depositorname']??'',
                            "DepositorEmail"		=>	$cart[0]['depositoremail']??'',
                            "DepositorNumber"		=>	$cart[0]['depositorphoneno']??'',
                            "ChequeNum"				=>	$cart[0]['chequenumber']??'',

                        ]);

                    }


                }elseif($cart['category'] == 3){

                    $extradatatransport = Transportationroute::where('VehicleRouteID',$cart['id'])->first();

                    // dd($extradatatransport);

                    $time = strtotime($cart['date']);

                    $newformatdatepickup = date('Y-m-d H:i:s',$time);


                    $date=date_create($cart['date']);
                    $mydayquantity = $cart['quantity'] - 1;
                    date_add($date,date_interval_create_from_date_string($mydayquantity." days"));
                    $newformatdatedropout = date_format($date,"Y-m-d H:i:s");

                    $period = new DatePeriod(
                        new DateTime($newformatdatepickup),
                        new DateInterval('P1D'),
                        new DateTime($newformatdatedropout)
                    );


                    // dd($period);

                    // $timedropout = strtotime($cart['date']. + $cart['quantity']);

                    // $newformatdatedropout = date('Y-m-d h:i:s',$timedropout);

                    // echo $newformatdate;

                    $lastId = TransportReservation::orderBy('ReservationID','DESC')->limit(1)->first();
                    // dd($lastId->ReservationID);
                    $addLastId = $lastId == ''?1:$lastId->ReservationID+1;

                    $allmydate = date('Y-m-d_H:i:s');

                    $transportreserveid = "TRANSP-".$addLastId;

                    $tofromdestination = explode('to',$request->tofrom);

                    // dd($tofromdestination[0]);

                    if($request){

                        foreach ($period as $key => $value) {

                            $TransportReservation = TransportReservation::firstOrCreate([
                                "ReceiptNum"   			=> 	$transportreserveid??'',
                                "RouteID"     			=> 	$cart['RouteID']??0,
//                                "RouteID"     			=> 	$extradatatransport->RouteID??'',
                                "TransportationOwnerID" => 	$extradatatransport->TransportationOwnerID??'',
                                "TransportationTypeID"  => 	$extradatatransport->TransportationTypeID??'',
                                "VehicleRouteID"     	=> 	$cart['id']??'',
                                "CreatedBy"   			=> 	$user->id??'',
                                "CreateDate"     		=> 	date('Y-m-d h:i:sa'),
                                "noofdaysqty"			=>	$cart['quantity']??'',
                                "triptype"				=>	$request->pickuplocation??'',
                                "PickUpDateTime"		=> 	$value->format('Y-m-d H:i:s'),
                                "DropOffDateTime"   	=> 	$newformatdatedropout??'',
                                "triptype"				=>	$request->triptype??'',
                                "NumberPlate"			=>	$extradatatransport->NumberPlate??'',
                                "ReservationStatus"		=>	'Booked',
                                "PickupLocation"		=>	$request->pickuplocation??'',
                                "DropOffLocation"		=>	$request->dropofflocation??'',
                                "NotesByCustomer"		=>	$request->customernotes??'',
                                "Insurance" 			=>	$request->Insurance??'',
                                "Donation"				=>	$request->donation??'',
                                "donation_shrine_name"				=>	$request->donation_shrine_name??'',
                                "Donation_amount"		=>	$request->formtotaldonation??'',
                                "TotalPrice"     		=> 	$request->formtotalamount??0+25,
                                "BookingStatus"   		=> 	"PENDING",
                                "PaymentStatus"   		=>	$PaymentStatus??'',
                                "SPComments"     		=> 	$request->customernotes??'',
                                "SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
                                "updated_at"			=>	date('Y-m-d h:i:sa'),
                                "created_at"			=>	date('Y-m-d h:i:sa'),
                                "customer_id"			=>	$cart[0]['customer_id']??'',
                                "charge_id"				=>	$cart[0]['charge_id']??'',
                                "reciept_url"			=>	$cart[0]['reciept_url']??'',
                                "transaction_id"		=>	$cart[0]['transaction_id']??'',
                                "TypeofPayment"			=>	$cart[0]['payment_type']??'',
                                "DepositorName"			=>	$cart[0]['depositorname']??'',
                                "DepositorEmail"		=>	$cart[0]['depositoremail']??'',
                                "DepositorNumber"		=>	$cart[0]['depositorphoneno']??'',
                                "ChequeNum"				=>	$cart[0]['chequenumber']??'',

                            ]);

                        }

                        $TransportReservation = TransportReservation::firstOrCreate([
                            "ReceiptNum"   			=> 	$transportreserveid??'',
                            "RouteID"     			=> 	$cart['RouteID']??0,
//                                "RouteID"     			=> 	$extradatatransport->RouteID??'',
                            "TransportationOwnerID" => 	$extradatatransport->TransportationOwnerID??'',
                            "TransportationTypeID"  => 	$extradatatransport->TransportationTypeID??'',
                            "VehicleRouteID"     	=> 	$cart['id']??'',
                            "CreatedBy"   			=> 	$user->id??'',
                            "CreateDate"     		=> 	date('Y-m-d h:i:sa'),
                            "noofdaysqty"			=>	$cart['quantity']??'',
                            "triptype"				=>	$request->pickuplocation??'',
                            "PickUpDateTime"		=> 	$newformatdatedropout??'',
                            "DropOffDateTime"   	=> 	$newformatdatedropout??'',
                            "triptype"				=>	$request->triptype??'',
                            "NumberPlate"			=>	$extradatatransport->NumberPlate??'',
                            "ReservationStatus"		=>	'Booked',
                            "PickupLocation"		=>	$request->pickuplocation??'',
                            "DropOffLocation"		=>	$request->dropofflocation??'',
                            "NotesByCustomer"		=>	$request->customernotes??'',
                            "Insurance" 			=>	$request->Insurance??'',
                            "Donation"				=>	$request->donation??'',
                            "donation_shrine_name"				=>	$request->donation_shrine_name??'',
                            "Donation_amount"		=>	$request->formtotaldonation??'',
                            "TotalPrice"     		=> 	$request->formtotalamount??0+25,
                            "BookingStatus"   		=> 	"PENDING",
                            "PaymentStatus"   		=> 	$PaymentStatus??'',
                            "SPComments"     		=> 	$request->customernotes??'',
                            "SPCommentsDateTime"	=> 	date('Y-m-d h:i:sa'),
                            "updated_at"			=>	date('Y-m-d h:i:sa'),
                            "created_at"			=>	date('Y-m-d h:i:sa'),
                            "customer_id"			=>	$cart[0]['customer_id']??'',
                            "charge_id"				=>	$cart[0]['charge_id']??'',
                            "reciept_url"			=>	$cart[0]['reciept_url']??'',
                            "transaction_id"		=>	$cart[0]['transaction_id']??'',
                            "TypeofPayment"			=>	$cart[0]['payment_type']??'',
                            "DepositorName"			=>	$cart[0]['depositorname']??'',
                            "DepositorEmail"		=>	$cart[0]['depositoremail']??'',
                            "DepositorNumber"		=>	$cart[0]['depositorphoneno']??'',
                            "ChequeNum"				=>	$cart[0]['chequenumber']??'',

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
                            "user_id"					=>	$user->id??'',
                            "receipt_num"   			=> 	$packagesreserveid??'',
                            "package_deals_id"     		=> 	$cart['id']??'',
                            "created_by"   				=> 	$user->email??'',
                            "qty"						=>	$cart['quantity']??'',
                            "reservation_for_date"		=>	$newformatdate??'',
                            "notes_by_customer"			=>	$request->customernotes??'',
                            "package_insurance" 		=>	$request->Insurance??'',
                            "package_donation"			=>	$request->donation??'',
                            "donation_shrine_name"				=>	$request->donation_shrine_name??'',
                            "package_donation_amount"	=>	$request->formtotaldonation??'',
                            "total_price"     			=> 	$request->formtotalamount??0+25,
                            "booking_status"   			=> 	"PENDING",
                            "payment_status"   			=> 	$PaymentStatus??'',
                            "sp_comments"     			=> 	$request->customernotes??'',
                            "sp_comments_date_time"		=> 	date('Y-m-d h:i:sa'),
                            "updated_at"				=>	date('Y-m-d h:i:sa'),
                            "created_at"				=>	date('Y-m-d h:i:sa'),
                            "customer_id"				=>	$cart[0]['customer_id']??'',
                            "charge_id"					=>	$cart[0]['charge_id']??'',
                            "reciept_url"				=>	$cart[0]['reciept_url']??'',
                            "transaction_id"			=>	$cart[0]['transaction_id']??'',
                            "TypeofPayment"				=>	$cart[0]['payment_type']??'',
                            "DepositorName"				=>	$cart[0]['depositorname']??'',
                            "DepositorEmail"			=>	$cart[0]['depositoremail']??'',
                            "DepositorNumber"			=>	$cart[0]['depositorphoneno']??'',
                            "ChequeNum"					=>	$cart[0]['chequenumber']??'',
                        ]);

                    }

                }elseif($cart['category'] == 5){

                    // $time = strtotime($cart['date']);

                    // $newformatdate = date('Y-m-d',$time);

                    $Bookdates = explode('-',$cart['date']);

                    $time = strtotime($Bookdates[1]);

                    $checkoutnewformatdate = date('Y-m-d',$time);
                    // return $daterange;

                    $period = new DatePeriod(
                        new DateTime($Bookdates[0]),
                        new DateInterval('P1D'),
                        new DateTime($Bookdates[1])
                    );



                    $lastId = GuideReservation::orderBy('ReservationID','DESC')->limit(1)->first();
                    // dd($lastId->ReservationID);
                    $addLastId = $lastId == ''?1:$lastId->ReservationID+1;

                    $allmydate = date('Y-m-d_H:i:s');

                    $guidesreserveid = "GUID-".$addLastId;

                    // dd($request);

                    if($request){

                        foreach ($period as $key => $value) {

                            $GuideReservation = GuideReservation::firstOrCreate([
                                "ReceiptNum"   				=> 	$guidesreserveid??'',
                                "GuidesID"     				=> 	$cart['id']??'',
                                "CreatedBy"   				=> 	$user->id??'',
                                "CreateDate"				=>	$allmydate??'',
                                "qty"						=>	$cart['quantity']??'',
                                "reservation_start_date"	=>	$value->format('Y-m-d')??'',
                                "reservation_end_date"		=>	$checkoutnewformatdate??'',
                                "NotesByCustomer"			=>	$request->customernotes??'',
                                "Insurance" 				=>	$request->Insurance??'',
                                "Donation"					=>	$request->donation??'',
                                "donation_shrine_name"					=>	$request->donation_shrine_name??'',
                                "Donation_amount"			=>	$request->formtotaldonation??'',
                                "TotalPrice"     			=> 	$request->formtotalamount??0+25,
                                "BookingStatus"   		=> 	"PENDING",
                                "PaymentStatus"   			=> 	$PaymentStatus??'',
                                "SPComments"     			=> 	$request->customernotes??'',
                                "SPCommentsDateTime"		=> 	date('Y-m-d h:i:sa'),
                                "updated_at"				=>	date('Y-m-d h:i:sa'),
                                "created_at"				=>	date('Y-m-d h:i:sa'),
                                "customer_id"				=>	$cart[0]['customer_id']??'',
                                "charge_id"					=>	$cart[0]['charge_id']??'',
                                "reciept_url"				=>	$cart[0]['reciept_url']??'',
                                "transaction_id"			=>	$cart[0]['transaction_id']??'',
                                "TypeofPayment"				=>	$cart[0]['payment_type']??'',
                                "DepositorName"				=>	$cart[0]['depositorname']??'',
                                "DepositorEmail"			=>	$cart[0]['depositoremail']??'',
                                "DepositorNumber"			=>	$cart[0]['depositorphoneno']??'',
                                "ChequeNum"					=>	$cart[0]['chequenumber']??'',
                            ]);

                        }



                        $GuideReservation = GuideReservation::firstOrCreate([
                            "ReceiptNum"   				=> 	$guidesreserveid??'',
                            "GuidesID"     				=> 	$cart['id']??'',
                            "CreatedBy"   				=> 	$user->id??'',
                            "CreateDate"				=>	$allmydate??'',
                            "qty"						=>	$cart['quantity']??'',
                            "reservation_start_date"	=>	$checkoutnewformatdate??'',
                            "reservation_end_date"		=>	$checkoutnewformatdate??'',
                            "NotesByCustomer"			=>	$request->customernotes??'',
                            "Insurance" 				=>	$request->Insurance??'',
                            "Donation"					=>	$request->donation??'',
                            "Donation_amount"			=>	$request->formtotaldonation??'',
                            "TotalPrice"     			=> 	$request->formtotalamount??0+25,
                            "BookingStatus"   			=> 	"PENDING",
                            "PaymentStatus"   			=> 	$PaymentStatus??'',
                            "SPComments"     			=> 	$request->customernotes??'',
                            "SPCommentsDateTime"		=> 	date('Y-m-d h:i:sa'),
                            "updated_at"				=>	date('Y-m-d h:i:sa'),
                            "created_at"				=>	date('Y-m-d h:i:sa'),
                            "customer_id"				=>	$cart[0]['customer_id']??'',
                            "charge_id"					=>	$cart[0]['charge_id']??'',
                            "reciept_url"				=>	$cart[0]['reciept_url']??'',
                            "transaction_id"			=>	$cart[0]['transaction_id']??'',
                            "TypeofPayment"				=>	$cart[0]['payment_type']??'',
                            "DepositorName"				=>	$cart[0]['depositorname']??'',
                            "DepositorEmail"			=>	$cart[0]['depositoremail']??'',
                            "DepositorNumber"			=>	$cart[0]['depositorphoneno']??'',
                            "ChequeNum"					=>	$cart[0]['chequenumber']??'',
                        ]);


                    }

                }else{

                }

                if(isset($GuestpassReservation) || isset($RoomReservation) || isset($TransportReservation) || isset($PackageReservation) || isset($GuideReservation) ){

                    // dd("True");

                    session()->forget('cart');
                    return $addLastId;
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

    }

    public function registeruser(Request $request){

//        return $request->all();

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
        if ($request->payment_type == 'paypal'){
//            return $request;
            $data = [
                'customer_id' => $request->customer_id,
                'charge_id' => $request->charge_id,
                'reciept_url' => $request->reciept_url,
                'payment_type' => $request->payment_type??'',
            ];
            session()->push('cart', $data);
//            dd(session()->get('cart'));
            // try{
//        return $request->all();
            $user =  User::firstOrCreate(['name'=>$request->name,'email'=> $request->email]);
            $user->status = 1;
            $user->password = bcrypt($request->password);
            $user->save();
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
                $cart = session()->get('cart');
                if(isset($cart['category'])){
                    if(isset($user->id)){
                        $orderid = $this->checkoutsubmit($request);
                    }else{
                        return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
                    }
                }else{
                    return redirect('/checkout')->with('message', 'Kindly Select Product to order!');
                }

                if($cart['category'] == 1 ){

                    return redirect('customer_package_deals_invoice/'.$orderid);

                }elseif($cart['category'] == 2 ){

                    return redirect('customerroom_invoice/'.$orderid);

                }elseif($cart['category'] == 3 ){

                    return redirect('customertransport_invoice/'.$orderid);

                }elseif($cart['category'] == 4 ){

                    return redirect('customer_guestpass_invoice/'.$orderid);

                }elseif($cart['category'] == 5 ){

                    return redirect('customerguide_invoice/'.$orderid);

                }else{

                    return redirect()->route('index');
                }

                return redirect()->route('index');


            }else{
                echo 'else';
            }//end if
        }elseif($request->payment_type == 'zelle'){
//                return $request->all();
            $data = [
                'transaction_id' => $request->transaction_id??'',
                'payment_type' => $request->payment_type??'',
            ];
            session()->push('cart', $data);
            $user =  User::firstOrCreate(['name'=>$request->name,'email'=> $request->email]);
            $user->status = 1;
            $user->password = bcrypt($request->password);
            $user->save();
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
                $cart = session()->get('cart');
                if(isset($cart['category'])){
                    if(isset($user->id)){
                        $orderid =  $this->checkoutsubmit($request);
                    }else{
                        return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
                    }
                }else{
                    return redirect('/checkout')->with('message', 'Kindly Select Product to order!');
                }

                if($cart['category'] == 1 ){

                    return redirect('customer_package_deals_invoice/'.$orderid);

                }elseif($cart['category'] == 2 ){

                    return redirect('customerroom_invoice/'.$orderid);

                }elseif($cart['category'] == 3 ){

                    return redirect('customertransport_invoice/'.$orderid);

                }elseif($cart['category'] == 4 ){

                    return redirect('customer_guestpass_invoice/'.$orderid);

                }elseif($cart['category'] == 5 ){

                    return redirect('customerguide_invoice/'.$orderid);

                }else{

                    return redirect()->route('index');
                }

                return redirect()->route('index');


            }else{
                echo 'else';
            }//end if
        }elseif($request->payment_type == 'cashpayment'){


            $data = [
                'depositorname' 	=> $request->cashdepositorname??'',
                'depositorphoneno' 	=> $request->cashdepositorphoneno??'',
                'depositoremail' 	=> $request->cashdepositoremail??'',
                'payment_type' 		=> $request->payment_type??'',
                'paymentTypeselect' => $request->paymentTypeselect??'',
            ];

            session()->push('cart', $data);

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
                        $orderid = $this->checkoutsubmit($request);
                    }else{
                        return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
                    }
                }else{
                    return redirect('/checkout')->with('message', 'Kindly Select Product to order!');
                }

                if($cart['category'] == 1 ){

                    return redirect('customer_package_deals_invoice/'.$orderid);

                }elseif($cart['category'] == 2 ){

                    return redirect('customerroom_invoice/'.$orderid);

                }elseif($cart['category'] == 3 ){

                    return redirect('customertransport_invoice/'.$orderid);

                }elseif($cart['category'] == 4 ){

                    return redirect('customer_guestpass_invoice/'.$orderid);

                }elseif($cart['category'] == 5 ){

                    return redirect('customerguide_invoice/'.$orderid);

                }else{

                    return redirect()->route('index');
                }

                return redirect()->route('index');

            }else{
                echo 'else';
            }

        }elseif($request->payment_type == 'bankpayment'){

            $data = [
                'depositorname' 	=> $request->chequedepositorname??'',
                'depositorphoneno' 	=> $request->chequedepositorphoneno??'',
                'depositoremail' 	=> $request->chequedepositoremail??'',
                'chequenumber' 		=> $request->chequenumber??'',
                'payment_type' 		=> $request->payment_type??'',
                'paymentTypeselect' => $request->paymentTypeselect??'',
            ];
            session()->push('cart', $data);
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
                        $orderid =  $this->checkoutsubmit($request);
                    }else{
                        return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
                    }
                }else{
                    return redirect('/checkout')->with('message', 'Kindly Select Product to order!');
                }

                if($cart['category'] == 1 ){

                    return redirect('customer_package_deals_invoice/'.$orderid);

                }elseif($cart['category'] == 2 ){

                    return redirect('customerroom_invoice/'.$orderid);

                }elseif($cart['category'] == 3 ){

                    return redirect('customertransport_invoice/'.$orderid);

                }elseif($cart['category'] == 4 ){

                    return redirect('customer_guestpass_invoice/'.$orderid);

                }elseif($cart['category'] == 5 ){

                    return redirect('customerguide_invoice/'.$orderid);

                }else{

                    return redirect()->route('index');

                }

                return redirect()->route('index');

            }else{
                echo 'else';
            }

        }elseif($request->payment_type == 'creditcard'){

//            return $request->all();
            try {
                $stripe = new \Stripe\StripeClient('sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH');
                $token = $stripe->tokens->create([
                    'card' => [
                        'number' => '4242424242424242',
                        'exp_month' =>12,
                        'exp_year' =>2023,
                        'cvc' => 123,
                    ],
                ]);

                Stripe::setApiKey('sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH');

                $stripe = new \Stripe\StripeClient(
                    'sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH'
                );
                $customer = Customer::create(array(
                    'email' 	=> $request->email,
                    'source' 	=> $token['id']
                ));
                $charge = Charge::create(array(
                    'customer' 	=> $customer->id,
                    'amount' 	=> $request->formtotalamount*100,
                    'currency' 	=> 'usd',
                ));
                // DB::beginTransaction();
                $data = [
                    'customer_id'	=> $customer->id??'',
                    'charge_id' 	=> $charge->id??'',
                    'reciept_url' 	=> $charge->receipt_url??'',
                    'payment_type' 	=> $request->payment_type??'',
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
                            $orderid = $this->checkoutsubmit($request);
                        }else{
                            return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
                        }
                    }else{
                        return redirect('/checkout')->with('message', 'Kindly Select Product to order!');
                    }

                    if($cart['category'] == 1 ){

                        return redirect('customer_package_deals_invoice/'.$orderid);

                    }elseif($cart['category'] == 2 ){

                        return redirect('customerroom_invoice/'.$orderid);

                    }elseif($cart['category'] == 3 ){

                        return redirect('customertransport_invoice/'.$orderid);

                    }elseif($cart['category'] == 4 ){

                        return redirect('customer_guestpass_invoice/'.$orderid);

                    }elseif($cart['category'] == 5 ){

                        return redirect('customerguide_invoice/'.$orderid);

                    }else{

                        return redirect()->route('index');
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
    }


    public function checkoutwithauth(Request $request){

        $validator = $request->validate([

            'formtotalamount'   =>  'required|numeric|min:1|not_in:0',
            // 'customernotes' 	=>	'required'

        ]);


        $user = Auth::user();

        // print_r($user);

        $cart = session()->get('cart');

        if ($request->payment_type == 'paypal'){

            $data = [
                'customer_id' => $request->customer_id,
                'charge_id' => $request->charge_id,
                'reciept_url' => $request->reciept_url,
                'payment_type' => $request->payment_type??'',
            ];

            session()->push('cart', $data);

        }
        elseif($request->payment_type == 'zelle'){

            $data = [
                'transaction_id' => $request->transaction_id??'',
                'payment_type' => $request->payment_type??'',
            ];

            session()->push('cart', $data);

        }elseif($request->payment_type == 'cashpayment'){

            $data = [
                'depositorname' 	=> $request->cashdepositorname??'',
                'depositorphoneno' 	=> $request->cashdepositorphoneno??'',
                'depositoremail' 	=> $request->cashdepositoremail??'',
                'payment_type' 		=> $request->payment_type??'',
                'paymentTypeselect' => $request->paymentTypeselect??'',
            ];

            session()->push('cart', $data);

        }elseif($request->payment_type == 'bankpayment'){

            $data = [
                'depositorname' 	=> $request->chequedepositorname??'',
                'depositorphoneno' 	=> $request->chequedepositorphoneno??'',
                'depositoremail' 	=> $request->chequedepositoremail??'',
                'chequenumber' 		=> $request->chequenumber??'',
                'payment_type' 		=> $request->payment_type??'',
                'paymentTypeselect' => $request->paymentTypeselect??'',
            ];

            session()->push('cart', $data);

        }else{
//            return $request->all();
            try {
                $stripe = new \Stripe\StripeClient('sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH');
                 $token = $stripe->tokens->create([
                    'card' => [
                        'number' => '4242424242424242',
                        'exp_month' =>12,
                        'exp_year' =>2023,
                        'cvc' => 123,
                    ],
                ]);

                Stripe::setApiKey('sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH');

                $stripe = new \Stripe\StripeClient(
                    'sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH'
                );
                $customer = Customer::create(array(
                    'email' => auth()->user()->email,
                    'source' => $token['id']
                ));
                $charge = Charge::create(array(
                    'customer' => $customer->id,
                    'amount' => $request->formtotalamount*100,
                    'currency' => 'usd',
                ));
                // DB::beginTransaction();
                $data = [
                    'customer_id' => $customer->id??'',
                    'charge_id' => $charge->id??'',
                    'reciept_url' => $charge->receipt_url??'',
                    'payment_type' => $request->payment_type??'',
                ];
                session()->push('cart', $data);

            } catch (\Exception $e) {

                return $e->getMessage();

            }

        }

        if(isset($cart['category'])){

            if(isset($user->id)){


                $orderid = $this->checkoutsubmit($request);



            }else{

                return redirect('/checkout')->with('message', 'Kindly do login for submit order!');
            }

        }else{

            return redirect('/checkout')->with('message', 'Kindly Select Product to order!');

        }


        if($cart['category'] == 1 ){

            return redirect('customer_package_deals_invoice/'.$orderid);

        }elseif($cart['category'] == 2 ){

            return redirect('customerroom_invoice/'.$orderid);

        }elseif($cart['category'] == 3 ){

            return redirect('customertransport_invoice/'.$orderid);

        }elseif($cart['category'] == 4 ){

            return redirect('customer_guestpass_invoice/'.$orderid);

        }elseif($cart['category'] == 5 ){

            return redirect('customerguide_invoice/'.$orderid);

        }else{

            return redirect()->route('index');
        }

        return redirect()->route('index');

    }

    public function mysignup(Request $request){
//return $request;
        // dd($request);

        $ErrorMsg = "";
        $data = [];

        $validator = $request->validate([
//            'company_name'              =>  'required',
            'name'              =>  'required',
            'email'             =>  'required|unique:users,email',
            'phoneno'           => 	'required|numeric',
            'countryCode'       =>  'required',
            'password'          =>  'required|confirmed|min:6',
            'vendorType'          =>  'required',
//            'bio'        		=>  'required',
//            'image'   			=>  'required|mimes:jpeg,jpg,png|max:2000',
        ]);

        // DB::beginTransaction();

        // try{

        $tokenforverify =  Str::random(60);
        $user =  User::firstOrCreate(['name'=>$request->name,'email'=> $request->email,'emailtoken' => $tokenforverify,'status'=>$request->status??0 ]);
        extract($request->all());
        Session::put('registration_session',['email'=>$request->email,'emailtoken' => $tokenforverify]);
//        $user->status = 1;
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

//        $imageName = Storage::disk('website')->put('ProfileImage', $request->image);

        $profile = Profile::firstOrCreate([
            "user_id"   => $userid,
            "company_name"   => $request->company_name,
            "phone"     => $request->phoneno,
            "country"   => $request->countryCode,
//            "pic"		=> $imageName,
            "bio"		=> $request->bio,
        ]);


        $all=[
            'VerifyToken'=>$tokenforverify,
            'request'=>$request,
        ];

        $emailcandi = $request->email;

        $checkmymail = Mail::send('mail.testmail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);

                // $message->cc('uzair_khalid@gmail.com');
                $message->subject('Alzuwar:Email Verification');
            });


        // if($checkmymail){

        // dd($checkmymail);
        // }else{
        // dd('nomail');
        // }
        // $credentials = [
        // 'email'     => $request->email,
        // 'password'  => $request->password,
        // ];
        // if (Auth::attempt(['email'=> $request->email,'password'=> $request->password,'status'=>1])) {

        // return redirect()->route('user-login');
        // }else{


        // return redirect()->route('user-login');
        // }//end if


        return redirect()->route('user-login')->with(['message' => 'Thanks for signing up!, We have send you an email confirmation, Please confirm your email and then we will activate your account.']);
        // }
        // catch (\Throwable $e)
        // {
        // 	DB::rollback();
        // }


    }

    public function registrationResendMail(Request $request){
        $registration_session =  Session::get('registration_session');
        $all=[
            'request'=>(object)$registration_session,
            'VerifyToken'=>$registration_session['emailtoken']??""
        ];
        $emailcandi =$registration_session['email'];
        $checkmymail = Mail::send('mail.testmail',['datas' =>$all],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
                $message->subject('Confirmation Email for AlZuwar');
            });
        return redirect()->route('user-login')->with(['message' => 'Need the link of resending email confirmation as it could get lost in emails.']);
    }//end registrationResendMail function.

    public function oldbooking(){

        $userDetail = \Auth::user();

        // dd($userDetail->id);

        $customerreservation = array();

        if(isset($userDetail)){

            $guestpassreserves = GuestpassReservation::with('getcustomerorder','getGuestPassDetailsphoto')->where('CreatedBy',$userDetail->id)->get();

            if(isset($guestpassreserves)){

                foreach($guestpassreserves as $guestresdata){
//                    $date = Carbon::parse($guestresdata->ReservationForDate);
//                    $now = Carbon::now();
//                    $diff = $date->diffInDays($now);
                    array_push($customerreservation,[

                        'reciptno'			=>	$guestresdata->ReceiptNum,
                        'name'				=>	$guestresdata->getcustomerorder->GuestPassName,
                        'image'				=>	$guestresdata->getGuestPassDetailsphoto[0]->PhotoLocation??null,
                        'price'				=>	$guestresdata->TotalPrice,
                        'route'				=>	URL('customer_guestpass_invoice/'.$guestresdata->ReservationID),
                        'product_id'		=>	$guestresdata->GuestPassID,
                        'ReservationID'		=>	$guestresdata->ReservationID,
                        'category_id'		=>	$guestresdata->getcustomerorder->Productcategory,
                        'bookingstatus'		=>	$guestresdata->BookingStatus,
                        'paymentstatus'		=>	$guestresdata->PaymentStatus,
                        'reservationdate'	=>	date_format(date_create($guestresdata->ReservationForDate),"Y/m/d"),
                        'created_at'		=>	date_format(date_create($guestresdata->created_at??''),"Y/m/d"),
                        'request_refund'    =>	$guestresdata->request_refund??'',
                        'request_refund_reply_comments' =>	$guestresdata->request_refund_reply_comments??'',
//                        'diff' => $diff,
                    ]);

                }

            }

            $roompassreserves = Roomreservation::with('getReservationOrderspropertycustomer','getReservationOrdersroom','getPropertyphoto')->groupBy('ReceiptNum')->where('CreatedBy',$userDetail->id)->get();

            if(isset($roompassreserves)){

                foreach($roompassreserves as $roomresdata){
//                    $date = Carbon::parse($roomresdata->checkin);
//                    $now = Carbon::now();
//                    $diff = $date->diffInDays($now);
                    array_push($customerreservation,[

                        'reciptno'			=>	$roomresdata->ReceiptNum,
                        'name'				=>	$roomresdata->getReservationOrderspropertycustomer->Name,
                        'image'				=>	$roomresdata->getPropertyphoto->PhotoLocation??null,
                        'price'				=>	$roomresdata->TotalPrice,
                        'route'				=>	URL('customerroom_invoice/'.$roomresdata->ReservationID),
                        'product_id'		=>	$roomresdata->PropertyID,
                        'ReservationID'		=>	$roomresdata->ReservationID,
                        'category_id'		=>	$roomresdata->getReservationOrderspropertycustomer->Productcategory,
                        'bookingstatus'		=>	$roomresdata->BookingStatus,
                        'paymentstatus'		=>	$roomresdata->PaymentStatus,
                        'reservationdate'	=>	date_format(date_create($roomresdata->checkin),"Y/m/d"),
                        'created_at'		=>	date_format(date_create($roomresdata->created_at??''),"Y/m/d"),
                        'request_refund'    =>	$roomresdata->request_refund??'',
                        'request_refund_reply_comments' =>	$roomresdata->request_refund_reply_comments??'',
//                        'diff' => $diff,

                    ]);

                }

            }

            $guidereserves = GuideReservation::with('getcustomerorder','getGuideDetailsphoto')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->where('CreatedBy',$userDetail->id)->get();

            if(isset($guidereserves)){

                foreach($guidereserves as $guideresdata){
//                    $date = Carbon::parse($guideresdata->reservation_start_date);
//                    $now = Carbon::now();
//                    $diff = $date->diffInDays($now);
                    array_push($customerreservation,[

                        'reciptno'			=>	$guideresdata->ReceiptNum??'',
                        'name'				=>	$guideresdata->getcustomerorder->GuidesName??'',
                        'image'				=>	$guideresdata->getGuideDetailsphoto->PhotoLocation??null,
                        'price'				=>	$guideresdata->TotalPrice??'',
                        'route'				=>	URL('customerguide_invoice/'.$guideresdata->ReservationID)??'',
                        'product_id'		=>	$guideresdata->PropertyID??'',
                        'ReservationID'		=>	$guideresdata->ReservationID??'',
                        'category_id'		=>	$guideresdata->getcustomerorder->Productcategory??'',
                        'bookingstatus'		=>	$guideresdata->BookingStatus??'',
                        'paymentstatus'		=>	$guideresdata->PaymentStatus??'',
                        'reservationdate'	=>	date_format(date_create($guideresdata->reservation_start_date??''),"Y/m/d"),
                        'created_at'		=>	date_format(date_create($guideresdata->created_at??''),"Y/m/d"),
                        'request_refund'    =>	$guideresdata->request_refund??'',
                        'request_refund_reply_comments' =>	$guideresdata->request_refund_reply_comments??'',
//                        'diff' => $diff,


                    ]);

                }

            }

            $transportreserves = TransportReservation::with('getcustomerorder','getTransportmainrouteforreservation','gettransportDetailsphoto')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->where('CreatedBy',$userDetail->id)->get();

            if(isset($transportreserves)){

                foreach($transportreserves as $transportresdata){
//                    $date = Carbon::parse($transportresdata->PickUpDateTime);
//                    $now = Carbon::now();
//                    $diff = $date->diffInDays($now);
                    array_push($customerreservation,[

                        'reciptno'			=>	$transportresdata->ReceiptNum??'',
                        'name'				=>	$transportresdata->getcustomerorder->NameofVehicle??'',
                        'image'				=>	$transportresdata->gettransportDetailsphoto->PhotoLocation??null,
                        'price'				=>	$transportresdata->TotalPrice??'',
                        'route'				=>	URL('customertransport_invoice/'.$transportresdata->ReservationID??''),
                        'product_id'		=>	$transportresdata->VehicleRouteID??'',
                        'ReservationID'		=>	$transportresdata->ReservationID??'',
                        'category_id'		=>	3,
                        'bookingstatus'		=>	$transportresdata->BookingStatus??'',
                        'paymentstatus'		=>	$transportresdata->PaymentStatus??'',
                        'reservationdate'	=>	date_format(date_create($transportresdata->PickUpDateTime??''),"Y/m/d"),
                        'created_at'		=>	date_format(date_create($transportresdata->created_at??''),"Y/m/d"),
                        'request_refund'    =>	$transportresdata->request_refund??'',
                        'request_refund_reply_comments' =>	$transportresdata->request_refund_reply_comments??'',
//                        'diff' => $diff,

                    ]);
                }
            }
            $packagereserve = Search::with('getPackageDealsOrderDetail.getPackageUser.profile','getPackageDealsOrderDetail.getPackageDealsDefaultPhoto')->orderBy('id', 'DESC')->where('user_id',$userDetail->id)->get();
            if(isset($packagereserve)){
                foreach($packagereserve as $packageresdata){
//                    $date = Carbon::parse($packageresdata->getPackageDealsOrderDetail->package_available_from);
//                    return $now = Carbon::now()->addDays(10);
//                    $diff = $now->gt($date);
//                    return $diff = $now->diffInDays($date);
//                    return $diff = $date->gt($now);
                    array_push($customerreservation,[
                        'reciptno'			=>	$packageresdata->receipt_num??'',
                        'name'				=>	$packageresdata->getPackageDealsOrderDetail->package_deals_name??'',
                        'image'				=>	$packageresdata->getPackageDealsOrderDetail->getPackageDealsDefaultPhoto->PhotoLocation??null,
                        'price'				=>	$packageresdata->total_price??'',
                        'route'				=>	URL('customer_package_deals_invoice/'.$packageresdata->id??''),
                        'product_id'		=>	$packageresdata->getPackageDealsOrderDetail->id??'',
                        'ReservationID'		=>	$packageresdata->id??'',
                        'category_id'		=>	1,
                        'bookingstatus'		=>	$packageresdata->booking_status??'',
                        'paymentstatus'		=>	$packageresdata->payment_status??'',
                        'reservationdate'	=>	date_format(date_create($packageresdata->getPackageDealsOrderDetail->package_available_from??''),"Y/m/d"),
                        'created_at'		=>	date_format(date_create($packageresdata->created_at??''),"Y/m/d"),
                        'request_refund'    =>	$packageresdata->request_refund??'',
                        'request_refund_reply_comments' =>	$packageresdata->request_refund_reply_comments??'',
                    ]);
                }
            }
            $price = array_column($customerreservation, 'created_at');
            array_multisort($price, SORT_DESC, $customerreservation);
            if (sizeof($customerreservation) == 0){
                return back()->with('no_favourite_found', 'Sorry, you have no booking in the system yet');
            }
            else{
                return view('website.cart',compact('customerreservation'));
            }
            return back();
            // dd($customerreservation);
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
        $id = $request->owner_dm;
        $packagesdeals = About::get();
        return view('website.packages', compact('packages', 'packagesdeals','packageType','route_name','searchPackageName','cityNames', 'id'));
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails','getPackageReviewForView')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }


        elseif ($sort_type == 'min_reviews'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails','getPackageReviewCount')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->with('getPackageDealReviewDetails')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->with('getPackageReviewAverage');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        $packageType = PackageDealType::get();
        return view('website.package_card_section',compact('packages','packageType','route_name'));
    }
    public function packageSortingWithType(Request $request, $sort_type, $packageDealsTypeID){
//        return $packageDealsTypeID;
//        $packageType = PackageDealType::where('id',$packageDealsTypeID)->first();
        if ($sort_type == 'price_high_to_low'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$packageDealsTypeID)->orderBy('price','DESC')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high') {
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$packageDealsTypeID)->orderBy('price','ASC')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageDealReviewDetails','getPackageReviewCount')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'min_reviews'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageDealReviewDetails','getPackageReviewCount')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageReviewCount');
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
            $packages = ManageSetting::where('package_deals_status',1)->where('status_from_admin',1)->whereIn('id',$PackageDealsIdArray)->where('package_deals_type_id',$packageDealsTypeID)->with('getPackageDealReviewDetails','getPackageReviewAverage')->orderByRaw(DB::raw("FIELD(id, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        $packageType = PackageDealType::get();
        return view('website.package_card_section',compact('packages','packageType','route_name'));
    }

    public function myPackageBookingCalendar(){
        if(auth()->user()->hasrole('PackagesAdmin')){
            $myPackageIds =  ManageSetting::where('user_id',Auth::user()->id)->get()->pluck('id');
            $packagebooking= Search::whereIn('package_deals_id',$myPackageIds)->with('getPackageDealsOrderDetail')->get();
            return view('superadminviews.packagecalender',compact('packagebooking'));
        }
    }

    //Change Reservation Status by vendor

    public function packagesReservationStatus($id,$status,$value){
        if($value == 'undefined'){
            $value = 'CONFIRMED';
        }
        $package = Search::where('id',$id)->first();
        Search::where('id',$id)->update(['booking_status'=> $status,'sp_comments' => $value]);

        //order confirmation invoice email
        $invoice_url = url('/customer_package_deals_invoice/').'/'.$id;
        $all=[
            'request'=>$invoice_url,
        ];
        $emailcandi = $package->getPackageDealsUserDetail->email;
        $checkmymail = Mail::send('mail.confirmation_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('Alzuwar:Booking Confirmation');
            });
        //order confirmation invoice email end

        return 'success';
    }

    public function guestpassReservationStatus($id,$status,$value){
        if($value == 'undefined'){
            $value = 'CONFIRMED';
        }
        GuestpassReservation::where('ReservationID',$id)->update(['BookingStatus'=> $status,'SPComments' => $value]);
        return 'success';
    }

    public function hotelsReservationStatus($id,$status,$value){
        if($value == 'undefined'){
            $value = 'CONFIRMED';
        }
        $room = Roomreservation::where('ReservationID',$id)->first();
        Roomreservation::where('ReservationID',$id)->update(['BookingStatus'=> $status,'SPComments' => $value]);

        //order confirmation invoice email
        $invoice_url = url('/customertransport_invoice/').'/'.$id;
        $all=[
            'request'=>$invoice_url,
        ];
        $emailcandi = $room->getRoomOrdersbyusersupadmin->email;
        $checkmymail = Mail::send('mail.confirmation_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('Alzuwar:Booking Confirmation');
            });
        //order confirmation invoice email end

        return 'success';
    }

    public function transportReservationStatus($id,$status,$value){
        if($value == 'undefined'){
            $value = 'CONFIRMED';
        }
        $tranport = TransportReservation::where('ReservationID',$id)->first();
        TransportReservation::where('ReservationID',$id)->update(['BookingStatus'=> $status,'SPComments' => $value]);

        //order confirmation invoice email
        $invoice_url = url('/customertransport_invoice/').'/'.$id;
        $all=[
            'request'=>$invoice_url,
        ];
        $emailcandi = $tranport->getTransportOrdersbyusersupadmin->email;
        $checkmymail = Mail::send('mail.confirmation_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('Alzuwar:Booking Confirmation');
            });
        //order confirmation invoice email end

        return 'success';
    }
    public function guideReservationStatus(Request $request, $id,$status,$value){
        if($value == 'undefined'){
            $value = 'CONFIRMED';
        }
        $guide = GuideReservation::where('ReservationID',$id)->first();
        $guide_receipt_num = $guide->ReceiptNum;
        GuideReservation::where('ReceiptNum',$guide_receipt_num)->update(['BookingStatus'=> $status,'SPComments' => $value]);
//        GuideReservation::where('ReservationID',$id)->update(['BookingStatus'=> $status,'SPComments' => $value]);
        //order confirmation invoice email
        $invoice_url = url('/customerguide_invoice/').'/'.$id;
        $all=[
            'request'=>$invoice_url,
        ];
        $emailcandi = $guide->getGuideOrdersbyusersupadmin->email;
        $checkmymail = Mail::send('mail.confirmation_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('Alzuwar:Booking Confirmation');
            });
        //order confirmation invoice email end

        return 'success';
    }
    //Search Reservations by Date
    public function searchPackageByDate(Request $request){

        if (auth()->user()->hasrole('PackagesAdmin')) {
            $packageID = ManageSetting::where('user_id',Auth::id())->pluck('id');
            $bookings = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereIn('package_deals_id',$packageID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->pluck('receipt_num')->count();
            $package = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $package = $package->whereIn('package_deals_id',$packageID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
            $mytotalprice = 0;
            foreach($package as $packages) {
                if ($packages->package_insurance == 1 && $packages->package_donation == 0){
                    $totalprice = $packages->total_price-10;
                }elseif($packages->package_insurance == 0 && $packages->package_donation == 1){
                    $totalprice = $packages->total_price - $packages->package_donation_amount;
                }elseif(($packages->package_insurance == 1 && $packages->package_donation == 1)){
                    $totalprice = $packages->total_price - $packages->package_donation_amount-10;
                }else{
                    $totalprice = $packages->total_price;
                }
                $mytotalprice +=  $totalprice;
            }
            $packagewithdraw = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $packagewithdraw = $packagewithdraw->where('withdraw',NULL);
            $packagewithdraw = $packagewithdraw->whereIn('package_deals_id',$packageID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
            $myTotalPrice = 0;
            foreach($packagewithdraw as $packages) {
                if ($packages->package_insurance == 1 && $packages->package_donation == 0){
                    $totalprice = $packages->total_price-10;
                }elseif($packages->package_insurance == 0 && $packages->package_donation == 1){
                    $totalprice = $packages->total_price - $packages->package_donation_amount;
                }elseif(($packages->package_insurance == 1 && $packages->package_donation == 1)){
                    $totalprice = $packages->total_price - $packages->package_donation_amount-10;
                }else{
                    $totalprice = $packages->total_price;
                }
                $myTotalPrice += $totalprice;
            }

            $spEarningWithdraw = number_format($myTotalPrice/ 100 * 80??'0', 2, '.', ',');
            $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $search =  Search::whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('id', 'DESC')->paginate(100);
            $searchstatus =  Search::whereBetween('created_at' ,[$request->date_from,$request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('id', 'DESC')->paginate(100);
            return view('search.search.index', compact('search','searchstatus','mytotalprice', 'bookings', 'spEarning','spEarningWithdraw','dateFrom','dateTo'));
        }
        else{
            $bookings = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereBetween('created_at' ,[$request->date_from,$request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->pluck('receipt_num')->count();
            $package = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $package = $package->whereBetween('created_at' ,[$request->date_from,$request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
            $mytotalprice = 0;
            foreach($package as $packages) {
                if ($packages->package_insurance == 1 && $packages->package_donation == 0){
                    $totalprice = $packages->total_price-10;
                }elseif($packages->package_insurance == 0 && $packages->package_donation == 1){
                    $totalprice = $packages->total_price - $packages->package_donation_amount;
                }elseif(($packages->package_insurance == 1 && $packages->package_donation == 1)){
                    $totalprice = $packages->total_price - $packages->package_donation_amount-10;
                }else{
                    $totalprice = $packages->total_price;
                }
                $mytotalprice +=  $totalprice;
            }
            $spEarning = number_format($mytotalprice/100*80??'0',2, '.', ',');
            $appFee = number_format($mytotalprice/100*20??'0',2, '.', ',');
            $totalDonation =Search:: where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $totalDonation =$totalDonation->where('package_donation',1)->whereBetween('created_at' ,[$request->date_from,$request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
            $totalInsurance =Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $totalInsurance =$totalInsurance->where('package_insurance',1)->whereBetween('created_at' ,[$request->date_from,$request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get()->pluck('receipt_num')->count();
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $search =  Search::whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('id', 'DESC')->paginate(100);
            $searchstatus =  Search::whereBetween('created_at' ,[$request->date_from,$request->date_to])->where('booking_status','CONFIRMED')->where('payment_status','PAID')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('id', 'DESC')->paginate(100);
            return view('search.search.index', compact('search','searchstatus', 'mytotalprice', 'bookings', 'spEarning', 'appFee', 'totalDonation', 'totalInsurance','dateFrom','dateTo'));

        }
    }

    public function searchGuideByDate(Request $request)
    {
        if (auth()->user()->hasrole('GuideAdmin')) {
            $guidID = Guid::where('GuidesCreatedBy',Auth::id())->pluck('GuidesID');
            $bookings = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereIn('GuidesID',$guidID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $guide = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $guide = $guide->whereIn('GuidesID',$guidID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
            $mytotalprice = 0;
            foreach ($guide as $guides) {
                if ($guides->Insurance == 1 && $guides->Donation == 0) {
                    $totalprice = $guides->TotalPrice - 10;
                } elseif ($guides->Insurance == 0 && $guides->Donation == 1) {
                    $totalprice = $guides->TotalPrice - $guides->Donation_amount;
                } elseif (($guides->Insurance == 1 && $guides->Insurance == 1)) {
                    $totalprice = $guides->TotalPrice - $guides->Donation_amount - 10;
                } else {
                    $totalprice = $guides->TotalPrice;
                }
                $mytotalprice += $totalprice;
            }
            $guidewithdraw = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $guidewithdraw = $guidewithdraw->where('withdraw',NULL);
            $guidewithdraw = $guidewithdraw->whereIn('GuidesID',$guidID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
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
            $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
            $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $guidereserves = GuideReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply')->with('getGuideOrders')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            $guidereservesstats = GuideReservation::with('getGuideOrders')->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
            return view('guid.guid.guidereservation', compact('guidereserves', 'guidereservesstats', 'mytotalprice', 'bookings', 'spEarning', 'appFee','spEarningWithdraw','dateFrom','dateTo'));
        }
        else{
            $bookings = GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereBetween('created_at',[$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $guide = GuideReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $guide = $guide->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
            $mytotalprice = 0;
            foreach ($guide as $guides) {
                if ($guides->Insurance == 1 && $guides->Donation == 0) {
                    $totalprice = $guides->TotalPrice - 10;
                } elseif ($guides->Insurance == 0 && $guides->Donation == 1) {
                    $totalprice = $guides->TotalPrice - $guides->Donation_amount;
                } elseif (($guides->Insurance == 1 && $guides->Insurance == 1)) {
                    $totalprice = $guides->TotalPrice - $guides->Donation_amount - 10;
                } else {
                    $totalprice = $guides->TotalPrice;
                }

                $mytotalprice += $totalprice;
            }
            $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
            $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
            $totalDonation = GuideReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply')->whereBetween('created_at', [$request->date_from, $request->date_to]);
            $totalDonation = $totalDonation->where('Donation', 1)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
            $totalInsurance = GuideReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $totalInsurance = $totalInsurance->whereBetween('created_at', [$request->date_from, $request->date_to])->where('Insurance', 1)->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $guidereserves = GuideReservation::with('getGuideOrders')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            $guidereservesstats = GuideReservation::with('getGuideOrders')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            return view('superadminviews.allguidesreservation', compact('guidereserves', 'guidereservesstats', 'mytotalprice', 'bookings', 'spEarning', 'appFee', 'totalDonation', 'totalInsurance','dateFrom','dateTo'));
        }
    }
    public function searchTransportByDate(Request $request){
        if (auth()->user()->hasrole('TransportAdmin')) {
            $transportID = Transportationroute::where('TransportationOwnerID',Auth::id())->pluck('VehicleRouteID');
            $bookings = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereIn('VehicleRouteID',$transportID)->whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
            $transport = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $transport = $transport->whereIn('VehicleRouteID',$transportID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();

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
            $transportwithdraw = TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $transportwithdraw =$transportwithdraw->where('withdraw',NULL);
            $transportwithdraw = $transportwithdraw->where('PaymentStatus','PAID')->whereBetween('created_at',[$request->date_from, $request->date_to])->whereIn('VehicleRouteID',$transportID)->where('BookingStatus', 'CONFIRMED')->groupBy('ReceiptNum')->get();
            $myTotalPrice = 0;

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
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $transportreserves = TransportReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->with('getTransportOrders','getTransportmainrouteforreservation')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            $transportreservesstats = TransportReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->with('getTransportOrderssupadmin','getTransportmainrouteforreservation')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            return view('transportation.transportation.transportreservations', compact('transportreserves','transportreserves','mytotalprice','bookings','spEarning','spEarningWithdraw','dateFrom','dateTo'));
        }
        else{
            $bookings = TransportReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
            $transport = TransportReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $transport = $transport->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
            $mytotalprice = 0;
            foreach ($transport as $transports) {
                if ($transports->Insurance == 1 && $transports->Donation == 0) {
                    $totalprice = $transports->TotalPrice - 10;
                } elseif ($transports->Insurance == 0 && $transports->Donation == 1) {
                    $totalprice = $transports->TotalPrice - $transports->Donation_amount;
                } elseif (($transports->Insurance == 1 && $transports->Insurance == 1)) {
                    $totalprice = $transports->TotalPrice - $transports->Donation_amount - 10;
                } else {
                    $totalprice = $transports->TotalPrice;
                }

                $mytotalprice += $totalprice;
            }
            $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
            $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
            $totalDonation = TransportReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $totalDonation = $totalDonation->whereBetween('created_at', [$request->date_from, $request->date_to])->where('Donation', 1)->groupBy('ReceiptNum')->get();
            $totalInsurance = TransportReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $totalInsurance = $totalInsurance->whereBetween('created_at', [$request->date_from, $request->date_to])->where('Insurance', 1)->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $transportreserves = TransportReservation::with('getTransportOrderssupadmin','getTransportmainrouteforreservation')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            $transportreservesstats = TransportReservation::with('getTransportOrderssupadmin','getTransportmainrouteforreservation')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            return view('superadminviews.alltransportreservation',compact('transportreserves','transportreservesstats','mytotalprice','bookings','spEarning','appFee','totalDonation','totalInsurance','dateFrom','dateTo'));
        }
    }

    public function searchRoomByDate(Request $request){
        if (auth()->user()->hasrole('HotelsAdmin')) {
            $roomID = Property::where('PropertyCreatedBy',Auth::id())->pluck('PropertyID');
            $bookings = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            // $bookings = $bookings->whereIn('PropertyID',$roomID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $bookings = $bookings->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $room = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $room =  $room->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
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
            $roomswithdraw = $roomswithdraw->whereIn('PropertyID',$roomID)->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get();
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
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $roompassreserves = Roomreservation::with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
            $wthdrawed_amount = WithdrawRequest::where('vendor_id',Auth::id())->where('category','2')->where('is_request_accepted','1')->pluck('requested_amount')->sum();
            return view('hotelsviews.hotelreservations',compact('roompassreserves','wthdrawed_amount','mytotalprice', 'bookings', 'spEarning', 'appFee','spEarningWithdraw','dateFrom','dateTo'));
        }
        else{

            $bookings = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $bookings = $bookings->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
            $room= Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            $room = $room->whereBetween('created_at',[$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupby('ReceiptNum')->get();
            $mytotalprice = 0;
            foreach ($room as $rooms) {
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
            $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
            $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
            $totalDonation = Roomreservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $totalDonation = $totalDonation->whereBetween('created_at', [$request->date_from, $request->date_to])->where('Donation', 1)->groupBy('ReceiptNum')->get();
            $totalInsurance = Roomreservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $totalInsurance = $totalInsurance->whereBetween('created_at', [$request->date_from, $request->date_to])->where('Insurance', 1)->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $roomreserves = Roomreservation::with('getRoomOrderssupadmin','getReservationOrdersroom')->whereBetween('created_at', [$request->date_from, $request->date_to])->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
            $roomreservestatus = Roomreservation::with('getRoomOrderssupadmin','getReservationOrdersroom')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
            $wthdrawed_amount = WithdrawRequest::where('vendor_id',Auth::id())->where('category','2')->where('is_request_accepted','1')->pluck('requested_amount')->sum();
            return view('superadminviews.allroomreservation',compact('roomreserves','roomreservestatus','wthdrawed_amount','mytotalprice', 'bookings', 'spEarning','totalDonation' ,'appFee','dateFrom','dateTo'));
        }

    }


    public function searchGuestpassByDate(Request $request){

        if (auth()->user()->hasrole('GuestsPassAdmin')) {
            $guestID = GuestPass::where('GuestPassCreatedBy',Auth::id())->pluck('GuestPassID');
            $bookings = GuestpassReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->whereIn('GuestPassID',$guestID);
            $bookings = $bookings->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
            $guestpass = GuestpassReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->whereIn('GuestPassID',$guestID)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID');
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
            $guestwithdraw = GuestpassReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->whereIn('GuestPassID',$guestID)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID');
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
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $guestpassreserves = GuestpassReservation::with('getGuestPassOrders')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
            return view('website.guestspassreservations',compact('guestpassreserves','mytotalprice','bookings','spEarning','appFee','spEarningWithdraw','dateFrom','dateTo'));
        }
        else{
            // $bookings = Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
            // $bookings = $bookings->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();

            $bookings = GuestpassReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->where('PaymentStatus','PAID')->where('BookingStatus','CONFIRMED');
            $bookings = $bookings->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupBy('ReceiptNum')->pluck('ReceiptNum')->count();
            $guestpass = GuestpassReservation::whereBetween('created_at',[$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID');
            $guestpass = $guestpass->where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->groupby('ReceiptNum')->get();
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
            $spEarning = number_format($mytotalprice / 100 * 80??'0', 2, '.', ',');
            $appFee = number_format($mytotalprice / 100 * 20??'0', 2, '.', ',');
            $totalDonation = GuestpassReservation::whereBetween('created_at', [$request->date_from, $request->date_to])->where('Donation', 1);
            $totalDonation = $totalDonation->where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply')->groupby('ReceiptNum')->get();
            $totalInsurance = GuestpassReservation::where('request_refund_reply', '!=', 'REFUNDED')->orWhereNull('request_refund_reply');
            $totalInsurance = $totalInsurance->whereBetween('created_at', [$request->date_from, $request->date_to])->where('Insurance', 1)->groupby('ReceiptNum')->count();
            $dateFrom= $request->date_from;
            $dateTo= $request->date_to;
            $guestpassreserves = GuestpassReservation::with('getGuestPassOrderssupadmin')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->get();
            $guestpassreservesstats = GuestpassReservation::with('getGuestPassOrderssupadmin')->whereBetween('created_at' ,[$request->date_from,$request->date_to])->get();
            return view('website.supadminguestpassreservation',compact('guestpassreserves','guestpassreservesstats','mytotalprice', 'bookings', 'spEarning', 'appFee', 'totalDonation', 'totalInsurance','dateFrom','dateTo'));
        }
    }
    //Search RefundRequestByDate
    public function searchRefundRequestByDate(Request $request){
        $dateFrom= $request->date_from??'';
        $dateTo= $request->date_to??'';
        $customerrefundrequests = array();
        $guestpassreserves = GuestpassReservation::with('getcustomerorder','getGuestPassDetailsphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'route'				=>	URL('customer_guestpass_invoice/'.$guestresdata->ReservationID),
                    'product_id'		=>	$guestresdata->GuestPassID,
                    'ReservationID'		=>	$guestresdata->ReservationID,
                    'category_id'		=>	$guestresdata->getcustomerorder->Productcategory,
                    'bookingstatus'		=>	$guestresdata->BookingStatus,
                    'paymentstatus'		=>	$guestresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($guestresdata->ReservationForDate),"Y/m/d"),
                    'created_at'		=>	date_format($guestresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$guestresdata->request_refund??'',
                    'request_refund_reply'   		 	=>	$guestresdata->request_refund_reply,
                    'request_refund_reply_comments' =>	$guestresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $roompassreserves = Roomreservation::with('getReservationOrderspropertycustomer','getReservationOrdersroom','getPropertyphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'route'				=>	URL('customerroom_invoice/'.$roomresdata->ReservationID),
                    'product_id'		=>	$roomresdata->PropertyID,
                    'ReservationID'		=>	$roomresdata->ReservationID,
                    'category_id'		=>	$roomresdata->getReservationOrderspropertycustomer->Productcategory,
                    'bookingstatus'		=>	$roomresdata->BookingStatus,
                    'paymentstatus'		=>	$roomresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($roomresdata->checkin),"Y/m/d"),
                    'created_at'		=>	date_format($roomresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$roomresdata->request_refund??'',
                    'request_refund_reply'   		 	=>	$roomresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$roomresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $guidereserves = GuideReservation::with('getcustomerorder','getGuideDetailsphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();

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
                    'route'				=>	URL('customerguide_invoice/'.$guideresdata->ReservationID),
                    'product_id'		=>	$guideresdata->PropertyID,
                    'ReservationID'		=>	$guideresdata->ReservationID,
                    'category_id'		=>	$guideresdata->getcustomerorder->Productcategory,
                    'bookingstatus'		=>	$guideresdata->BookingStatus,
                    'paymentstatus'		=>	$guideresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($guideresdata->reservation_start_date),"Y/m/d"),
                    'created_at'		=>	date_format($guideresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$guideresdata->request_refund??'',
                    'request_refund_reply'   		 	=>	$guideresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$guideresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $transportreserves = TransportReservation::with('getcustomerorder','getTransportmainrouteforreservation','gettransportDetailsphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'route'				=>	URL('customertransport_invoice/'.$transportresdata->ReservationID),
                    'product_id'		=>	$transportresdata->VehicleRouteID,
                    'ReservationID'		=>	$transportresdata->ReservationID,
                    'category_id'		=>	3,
                    'bookingstatus'		=>	$transportresdata->BookingStatus,
                    'paymentstatus'		=>	$transportresdata->PaymentStatus,
                    'reservationdate'	=>	date_format(date_create($transportresdata->PickUpDateTime),"Y/m/d"),
                    'created_at'		=>	date_format($transportresdata->created_at,"Y/m/d H:i:s"),
                    'request_refund'    =>	$transportresdata->request_refund??'',
                    'request_refund_reply'   		 	=>	$transportresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$transportresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $packagereserve = Search::with('getPackageDealsOrderDetail.getPackageUser.profile','getPackageDealsOrderDetail.getPackageDealsDefaultPhoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('id', 'DESC')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->where('request_refund','<>','')->get();
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
                    'request_refund_reply'   		 	=>	$packageresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$packageresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $price = array_column($customerrefundrequests, 'created_at');
        array_multisort($price, SORT_DESC, $customerrefundrequests);
//        Total Count Work Start
        $totalCustomers = array();
        $guestpassreserves = GuestpassReservation::with('getcustomerorder','getGuestPassDetailsphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'request_refund_reply'  =>	$guestresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$guestresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $roompassreserves = Roomreservation::with('getReservationOrderspropertycustomer','getReservationOrdersroom','getPropertyphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'request_refund_reply'  =>	$roomresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$roomresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $guidereserves = GuideReservation::with('getcustomerorder','getGuideDetailsphoto')->orderBy('updated_at', 'DESC')->whereBetween('created_at', [$request->date_from, $request->date_to])->groupBy('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'request_refund_reply'   		 	=>	$guideresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$guideresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $transportreserves = TransportReservation::with('getcustomerorder','getTransportmainrouteforreservation','gettransportDetailsphoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('request_refund','<>','')->get();
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
                    'request_refund_reply'   		 	=>	$transportresdata->request_refund_reply??'',
                    'request_refund_reply_comments' =>	$transportresdata->request_refund_reply_comments??'',
                ]);
            }
        }
        $packagereserve = Search::with('getPackageDealsOrderDetail.getPackageUser.profile','getPackageDealsOrderDetail.getPackageDealsDefaultPhoto')->whereBetween('created_at', [$request->date_from, $request->date_to])->orderBy('id', 'DESC')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->where('request_refund','<>','')->get();
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
            if($request['request_refund'] != '')
                $refundRequest +=  $sales['price'];
        }
        $issuedRefund= 0;
        foreach($totalCustomers as $request) {
            if($request['request_refund_reply'] == 'REFUNDED')
                $issuedRefund +=  $sales['price'];
        }
        $CancelledRefund= 0;
        foreach($totalCustomers as $request) {
            if($request['request_refund_reply'] == 'CANCELLED')
                $CancelledRefund +=  $sales['price'];
        }

        //        Total Count Work Ends
        return view('superadminviews.refundrequest',compact('customerrefundrequests','totalSales','spEarning','refundRequest','issuedRefund','CancelledRefund','dateFrom','dateTo'));
    }
    //Invoice functions
    public function packageDealsInvoice($id){
        $search = Search::findOrFail($id);
        $user = User::where('id',$search->user_id??'')->first();
        $start  = new Carbon($search->getPackageDealsOrderDetail->package_available_from??'');
        $end    = new Carbon($search->getPackageDealsOrderDetail->package_available_to??'');
        $diff = $start->diff($end);
        $message = $diff->d . 'days ';
        $newDateTime= new Carbon($search->reservation_for_date??'');
        $reservationStartDate =  $newDateTime->subDays(10);
        return view('website.package_deals_invoice', compact('search','user','message','reservationStartDate'));
    }
    public function guideInvoice($id){

       $guidereserves = GuideReservation::with('getGuideOrderssupadmin','getGuideOrdersbyusersupadmin','getGuideOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();
        $start  = new Carbon($guidereserves->reservation_start_date??'');
        $end    = new Carbon($guidereserves->reservation_end_date??'');
        $diff = $start->diff($end);
        $message = $diff->d . 'days ';
        $newDateTime= new Carbon($guidereserves->reservation_start_date??'');
        $reservationStartDate =  $newDateTime->subDays(10);
        // dd($guestpassreserves);

        return view('superadminviews.guide_invoice',compact('guidereserves','message','reservationStartDate'));
    }
    public function transportInvoice($id){

        $transportreserves = TransportReservation::with('getTransportOrderssupadmin','getTransportOrdersbyusersupadmin','getTransportOrdersbyuserprofilesupadmin','getTransportRoutes')->where('ReservationID',$id)->first();
        $newDateTime= new Carbon($transportreserves->PickUpDateTime??'');
        $reservationStartDate =  $newDateTime->subDays(10);
        $VehicleRouteID = TransportReservation::where('ReservationID',$id)->pluck('VehicleRouteID');
        $RouteID= TransportReservation::where('ReservationID',$id)->pluck('RouteID');
        $route=VendorTransportRoute::whereIn('VehicleRouteID',$VehicleRouteID)->where('RouteID',$RouteID)->first();

        return view('superadminviews.transport_invoice',compact('transportreserves','reservationStartDate','route'));

    }
    public function roomInvoice($id){
        $roomreserves = Roomreservation::with('getHotel','getRoomOrderssupadmin','getReservationOrdersroom','getRoomOrdersbyusersupadmin','getRoomOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();
        $start  = new Carbon($roomreserves->checkin??'');
        $end    = new Carbon($roomreserves->checkout??'');
        $diff = $start->diff($end);
        $noOfDays= $diff->d . 'days ';
        $newDateTime= new Carbon($roomreserves->checkin??'');
        $reservationStartDate =  $newDateTime->subDays(10);
        return view('superadminviews.room_invoice',compact('roomreserves','noOfDays','reservationStartDate'));

    }

    public function guestpassInvoice($id){
        $guestpassreserves = GuestpassReservation::with('getGuestPassOrderssupadmin','getGuestPassOrdersbyusersupadmin','getGuestPassOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();
        $newDateTime= new Carbon($guestpassreserves->ReservationForDate??'');
        $reservationStartDate =  $newDateTime->subDays(10);
        return view('website.guestpass_invoice',compact('guestpassreserves','reservationStartDate'));

    }

    //CustomerInvoices

    public function customerpackageDealsInvoice(Request $request, $id){
        $search = Search::findOrFail($id);
        $user = User::where('id',$search->user_id??'')->first();
        $start  = new Carbon($search->getPackageDealsOrderDetail->package_available_from??'');
        $end    = new Carbon($search->getPackageDealsOrderDetail->package_available_to??'');
        $diff = $start->diff($end);
        $message = $diff->d . 'days ';
        //order confirmation invoice email
        $invoice_url = $request->url();
        $all=[
            'request'=>$invoice_url,
            'package_name'=>'package',
        ];
        $emailcandi = $search->created_by;
        $checkmymail = Mail::send('mail.booking_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('AlZuwar Team:Order Confirmation');
            });
        //order confirmation invoice email end
        return view('website.mycustomer_package_invoice', compact('search','user','message'));
    }

    public function customerguestpassInvoice(Request $request, $id){
        $guestpassreserves = GuestpassReservation::with('getGuestPassOrderssupadmin','getGuestPassOrdersbyusersupadmin','getGuestPassOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();
        //order confirmation invoice email
        $invoice_url = $request->url();
//        $all=[
//            'request'=>$invoice_url,
//            'package_name'=>'shrine program',
//        ];
//        $emailcandi = $guestpassreserves->getGuestPassOrdersbyusersupadmin->email;
//        $checkmymail = Mail::send('mail.booking_mail',[
//            'datas' =>$all,
//        ],
//        function ($message) use ($emailcandi) {
//            $message->to($emailcandi);
//             $message->cc('development.aftab@gmail.com');
//            $message->subject('AlZuwar Team:Order Confirmation');
//        });
        //order confirmation invoice email end


        return view('website.customerguestpassinvoice',compact('guestpassreserves'));

    }

    public function customerroomInvoice(Request $request, $id){
        $roomreserves = Roomreservation::with('getRoomOrderssupadmin','getReservationOrdersroom','getRoomOrdersbyusersupadmin','getRoomOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();
        $start  = new Carbon($roomreserves->checkin??'');
        $end    = new Carbon($roomreserves->checkout??'');
        $diff = $start->diff($end);
        $noOfDays= $diff->d . 'days ';
        //order confirmation invoice email
        $invoice_url = $request->url();
        $all=[
            'request'=>$invoice_url,
            'package_name'=>'hotel',
        ];
        $emailcandi = $roomreserves->getRoomOrdersbyusersupadmin->email;
        $checkmymail = Mail::send('mail.booking_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('AlZuwar Team:Order Confirmation');
            });
        //order confirmation invoice email end
        return view('superadminviews.customerroominvoice',compact('roomreserves','noOfDays'));

    }

    public function customertransportInvoice(Request $request,$id){
        $transportreserves = TransportReservation::with('getTransportOrderssupadmin','getTransportOrdersbyusersupadmin','getTransportOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();

        $VehicleRouteID = TransportReservation::where('ReservationID',$id)->pluck('VehicleRouteID');
        $RouteID= TransportReservation::where('ReservationID',$id)->pluck('RouteID');
        $route=VendorTransportRoute::whereIn('VehicleRouteID',$VehicleRouteID)->where('RouteID',$RouteID)->first();
        $invoice_url = $request->url();
        $all=[
            'request'=>$invoice_url,
            'package_name'=>'transport',
        ];
        $emailcandi = $transportreserves->getTransportOrdersbyusersupadmin->email;
        $checkmymail = Mail::send('mail.booking_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('AlZuwar Team:Order Confirmation');
            });

        return view('superadminviews.customertransportinvoice',compact('transportreserves','route'));

    }

    public function customerguideInvoice(Request $request, $id){
        $guidereserves = GuideReservation::with('getGuideOrderssupadmin','getGuideOrdersbyusersupadmin','getGuideOrdersbyuserprofilesupadmin')->where('ReservationID',$id)->first();
        $start  = new Carbon($guidereserves->reservation_start_date??'');
        $end    = new Carbon($guidereserves->reservation_end_date??'');
        $diff = $start->diff($end);
        $message = $diff->d .' '. 'days ';
        //order confirmation invoice email
        $invoice_url = $request->url();
        $all=[
            'request'=>$invoice_url,
            'package_name'=>'guide',
        ];
        $emailcandi = $guidereserves->getGuideOrdersbyusersupadmin->email;
        $checkmymail = Mail::send('mail.booking_mail',[
            'datas' =>$all,
        ],
            function ($message) use ($emailcandi) {
                $message->to($emailcandi);
//                 $message->cc('haseeb.tafsol@gmail.com');
                $message->subject('AlZuwar Team:Order Confirmation');
            });
        //order confirmation invoice email end
        $adults_guide = session()->get('adults_guide');
        $childs_guide = session()->get('childs_guide');
        $infants_guide = session()->get('infants_guide');
        return view('superadminviews.customerguideinvoice',compact('guidereserves','message', 'adults_guide', 'childs_guide', 'infants_guide'));
    }


    public function profile(){
        $profile_data = Profile::with('user')->where('user_id',Auth::id())->first();
        return view('website.profile',compact('profile_data'));
    }
    public function updateProfile(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|unique:users,email,'.auth()->user()->profile->user_id,
//            'dob' => 'required',
//            'bio' => 'required',
            'phone' => 'required',
            'country' => 'required'

        ]);
        if(!isset($request->pic)){
            $requestData['pic'] = $request->old_pic;
        }else{
            $this->validate($request, [
                'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = Storage::disk('website')->put('ProfileImage', $request->pic??'');
            Storage::disk('website')->delete($request->old_pic);
            $requestData['pic'] = $imageName;
        }
        $requestData['bio'] = $request->bio;
        $requestData['dob'] = $request->dob;
        $requestData['country'] = $request->country;
        $requestData['phone'] = $request->phone;

        Profile::where('user_id',auth()->user()->profile->user_id)->update($requestData);
        $userData['name'] = $request->name;
        $userData['email'] = $request->email;
        User::where('id',auth()->user()->id)->update($userData);
        return back()->with('update_profile','Profile Updated Successfully');
    }
    public function userLogin(Request $request){
        return view('website.user_login');
    }
    public function userSignup(Request $request){
        $route_name = $request->path();
        return view('website.user_signup',compact('route_name'));
    }
    public function listYourServices(Request $request){
        $pages = About::get();
        $faqs = SPFAQ::get();
        return view('website.list_your_services',compact('pages','faqs'));
    }

    public function testing(){
/*        $dt = Transportationroute::get();
        foreach ($dt as $d){
            $m = VendorTransportRoute::create(['VehicleRouteID'=>$d->VehicleRouteID,'RouteID'=>$d->RouteID,'Price'=>$d->Price,'TwoWayPrice'=>$d->TwoWayPrice]);
            echo  '<pre>';
            print_r($m);
        }*/
        die;
        die;
        //return     Storage::disk('website')->delete('img/abc.png');
        //    $imageName = Storage::disk('website')->put('ProfileImage', $request->image);
        return back();
    }
    public function guideReservationRejection(Request $request){
        return $request->all();
        return view('website.guestpass_invoice',compact('guestpassreserves'));

    }

    public function requestRefundByCustomer($ReservationID,$category_id,$value){
        if($category_id == '1'){
            $package = Search::where('id',$ReservationID)->update(['request_refund'=>$value]);
            return 'Package Request Sent';
        }elseif($category_id == '2'){
            $guestPass = Roomreservation::where('ReservationID',$ReservationID)->update(['request_refund'=>$value]);
            return 'Hotel Request Sent';
        }elseif($category_id == '4'){
            $room = GuestpassReservation::where('ReservationID',$ReservationID)->update(['request_refund'=>$value]);
            return 'GuestPass Request Sent';
        }elseif($category_id == '3'){
            $transport = TransportReservation::where('ReservationID',$ReservationID)->update(['request_refund'=>$value]);
            return 'Transporation Request Sent';
        }elseif($category_id == '5'){
            $guide = GuideReservation::where('ReservationID',$ReservationID)->update(['request_refund'=>$value]);
            return 'Guide Request Sent';}
        return view('website.guestpass_invoice',compact('guestpassreserves'));

    }//end requestRefundByCustomer function.

    public function RequestRefundReply($receipt_num,$status,$value,$category_id){
        if($category_id == '1'){
            $package = Search::where('receipt_num',$receipt_num)->update(['request_refund_reply'=>$status,'request_refund_reply_comments'=>$value]);
            return 'Package Request Sent';
        }elseif($category_id == '2'){
            $guestPass = Roomreservation::where('ReceiptNum',$receipt_num)->update(['request_refund_reply'=>$status,'request_refund_reply_comments'=>$value]);
            return 'Hotel Request Sent';
        }elseif($category_id == '4'){
            $room = GuestpassReservation::where('ReceiptNum',$receipt_num)->update(['request_refund_reply'=>$status,'request_refund_reply_comments'=>$value]);
            return 'GuestPass Request Sent';
        }elseif($category_id == '3'){
            $transport = TransportReservation::where('ReceiptNum',$receipt_num)->update(['request_refund_reply'=>$status,'request_refund_reply_comments'=>$value]);
            return 'Transporation Request Sent';
        }elseif($category_id == '5'){
            $guide = GuideReservation::where('ReceiptNum',$receipt_num)->update(['request_refund_reply'=>$status,'request_refund_reply_comments'=>$value]);
            return 'Guide Request Sent';}
        return view('website.guestpass_invoice',compact('guestpassreserves'));

    }//end RequestRefundReply function.

    public function packageRequestRefundReply($id,$status,$value){
        Search::where('id',$id)->update(['request_refund_reply'=>$status,'request_refund_reply_comments'=>$value]);
        return 'Successfully Replied';

    }
    public function withdrawRequest(Request $request){
//        return $request;
        if($request->category == "1"){

        }else if($request->category == "2"){

//return            $roompassreserves = Roomreservation::with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus','PAID')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->pluck('TotalPrice','ReceiptNum');
            $total_sales_amount = Roomreservation::with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus','PAID')->pluck('TotalPrice')->sum();
            $total_insurance_amount = Roomreservation::with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus','PAID')->pluck('Insurance')->sum()*10;
            $total_donation_amount = Roomreservation::with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus','PAID')->pluck('Donation_amount')->sum();
//            echo '<p> Total Sales Amount: '.$total_sales_amount.'</p><br>';
//            echo '<p> Total Insurance Amount: '.$total_insurance_amount.'</p><br>';
//            echo '<p> Total Donation Amount: '.$total_donation_amount.'</p><br>';
//            echo '<p> Total Sales Amount: '.($total_sales_amount-$total_insurance_amount-$total_donation_amount).'</p><br>';
//            echo '<p> Total Sales Amount(80%): '.(($total_sales_amount-$total_insurance_amount-$total_donation_amount)*0.8).'</p><br>';
//            die();
//return Auth::id();
            $vendor_total_sales = (($total_sales_amount-$total_insurance_amount-$total_donation_amount)*0.8);
            $vendor_previous_total_withdraw = WithdrawRequest::where('vendor_id',Auth::id())->where('category','2')->where('is_request_accepted','1')->pluck('requested_amount')->sum();
            $vendor_remaining_amount = $vendor_total_sales - $vendor_previous_total_withdraw;
            if($vendor_remaining_amount>0){
                $requestData = $request->all();
                $data = WithdrawRequest::create($request->all());
                return back();
            }
        }else if($request->category == "3"){

        }else if($request->category == "4"){

        }else if($request->category == "5"){

        }
//        return $request;
    }
    public function paymentConfirmation(Request $request){
        WithdrawRequest::findOrFail($request->paymentId)->update(['is_request_accepted'=> 1, 'super_admin_comments'=>$request->super_admin_comments]);
//        PropertyFavorite::updateorCreate(['user_id' => Auth::id(),'property_id' => $PropertyID,'category_id' => $CategoryID]);
        return back();
    }
    public function getPaymentComment(Request $request, $id)
    {
//        return $id;
        return WithdrawRequest::where('id',$id)->first('super_admin_comments');
    }
    public function addPackageOnHomepage($id){
        return ManageSetting::findOrFail($id)->update(['display_on_home_page' => 1]);
    }
    public function removePackageFromHomepage($id){
        return ManageSetting::findOrFail($id)->update(['display_on_home_page' => 0]);
    }
    public function addGuestPassOnHomepage($id){
        return GuestPass::where('GuestPassID',$id)->update(['DisplayOnHomePage' => 1]);
    }
    public function removeGuestPassFromHomepage($id){
        return GuestPass::where('GuestPassID',$id)->update(['DisplayOnHomePage' => 0]);
    }
    public function termsAndConditions(){
        $pages = About::get();
        return view('website.terms_and_conditions',compact('pages'));
    }//end termsAndConditions function.
    public function passwordReset(){
        $pages = About::get();
        return view('website.password_reset',compact('pages'));
    }//end passwordReset function.
    public function guestPassSorting(Request $request, $sort_type){
        if ($sort_type == 'price_high_to_low') {
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->orderBy('price', 'DESC')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high') {
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->orderBy('Price', 'ASC')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewCount)==0)continue;
                array_push($arr,$val->getGuestPassreviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'min_reviews'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewCount)==0)continue;
                array_push($arr,$val->getGuestPassreviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewAverage)==0)continue;
                array_push($arr,$val->getGuestPassreviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewAverage)==0)continue;
                array_push($arr,$val->getGuestPassreviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->where('GuestPassLocation',$city_name)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        return view('website.guestpass_card_section',compact('guestpass','route_name'));
    }
    public function guestPassSortingWithCity(Request $request, $sort_type, $city_name){
        if ($sort_type == 'price_high_to_low') {
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->where('GuestPassLocation',$city_name)->orderBy('price', 'DESC')->paginate(12);
        }
        elseif ($sort_type == 'price_low_to_high') {
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->where('GuestPassLocation',$city_name)->orderBy('Price', 'ASC')->paginate(12);
        }
        elseif ($sort_type == 'max_reviews'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewCount)==0)continue;
                array_push($arr,$val->getGuestPassreviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview < $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->where('GuestPassLocation',$city_name)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'min_reviews'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewCount)==0)continue;
                array_push($arr,$val->getGuestPassreviewCount[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->countReview > $arr[$j + 1]->countReview){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->where('GuestPassLocation',$city_name)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_high_to_low'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewAverage)==0)continue;
                array_push($arr,$val->getGuestPassreviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating < $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->where('GuestPassLocation',$city_name)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        elseif ($sort_type == 'rating_low_to_high'){
            $guestpassdata = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1);
            $avgs = $guestpassdata->get();
            $arr = [];
            foreach($avgs as $key=>$val){
                if(sizeof($val->getGuestPassreviewAverage)==0)continue;
                array_push($arr,$val->getGuestPassreviewAverage[0]);
            }
            for ($j = 0; $j < count($arr) - 1; $j++){
                if ($arr[$j]->averageRating > $arr[$j + 1]->averageRating){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                    $j = -1;
                }
            }
            $GuestPassIdArray = [];
            foreach($arr as $ar){
                array_push($GuestPassIdArray, $ar->GuestPassID);
            }
            $ids = implode(',', $GuestPassIdArray);
            $guestpass = GuestPass::with('getGuestPassreviewAverage','getGuestPassreviewdetails','getGuestPassDetails','getGuestPassprogramDetails')->where('GuestPassStatus','Active')->where('Admin_status','Active')->where('userstatus',1)->whereIn('GuestPassID',$GuestPassIdArray)->where('GuestPassLocation',$city_name)->orderByRaw(DB::raw("FIELD(GuestPassID, $ids)"))->paginate(12);
        }
        $route_name = $request->path();
        return view('website.guestpass_card_section',compact('guestpass','route_name'));
    }

    public function emailverification($emailverifytoken){

        // dd($emailverifytoken);

        $ErrorMsg = "";
        // $UserId = Auth::user()->id;

        try
        {
            // dd($UserId);

         $InputUserUpdate = [
                'email_verify_status' => 1,
            ];

            // dd($InputUserUpdate);

            if($emailverifytoken){

                // $UserDetail = UserDetail::where("id",'=',$UserId)->update($InputUserUpdate);

                $UserDetail = User::where("emailtoken",'=',$emailverifytoken)->update($InputUserUpdate);
                $UserDetailcolumns = User::where("emailtoken",'=',$emailverifytoken)->first();

            }

            // dd($UserDetailcolumns);

            // dd($ErrorMsg);

        }
        catch (\Throwable $e)
        {
            DB::rollback();
            $ErrorMsg = "Error Occurred while Change the role. Exception Msg : " . $e->getMessage();
            $data["status"] = false;
            $data["message"] = $ErrorMsg;

        }

        if ($ErrorMsg == "")
        {
            // return response()->json($data, $this->successStatus);
            $data["message"] = "Your Email has been Verified!";
            DB::commit();

            // $credentials = [
            // 'email'     => $UserDetailcolumns->email,
            // 'password'  => $UserDetailcolumns->password,
            // ];

            // dd($UserDetailcolumns->email);
            if (Auth::attempt(['email'=> $UserDetailcolumns->email,'password'=> $UserDetailcolumns->password,'status'=>1])) {

                return redirect()->route('index');
            }else{
                return redirect()->route('user-login')->with(['message' => 'Your Email is now Verified']);
            }//end if
            return redirect()->route('user-login')->with(['message' => 'Your Email is now Verified']);
            // return response()->json($UserDetail, 200);
        }
        else
        {
            // DB::commit();
            // $data["status"] = false;
            // $data["message"] = $ErrorMsg;
            // $data["Obj"] = $request->all();
            // return response()->json($data, 401);

            return redirect()->route('user-login');
        }

    }
    public function contactUs(Request $request){
        return view('website.contact_us');
    }//end contactUs function.
    public function contactRequest(Request $request){
       $contact = Contact::create($request->all());
        $data = [
            'no_reply' => $request->email,
            'email' => 'info@Alziyara.com',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'description' => $request->description,
        ];
        try {
            $result = Mail::send('mail.contact_mail', ['data' => $data], function ($message) use ($data) {
                $message->from($data['no_reply'])->to($data['email'])->subject('Contact Us Email');

            });
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return back()->with(['type'=>'success','title'=>'success','msg'=>'Your message has been submitted. We will get back to you shortly']);
    }//end contactRequest function.
    
    public function askAQuestion(Request $request){
        $result = AskAQuestion::create($request->all());
        try{
            Mail::raw('FAQ
            Sender : '.$result->email.'
            Message: '.$result->description.'
        ', function ($message) {
                $message->to('info@Alziyara.com')->subject('Alzuwar.com FAQ Alert');
            });
        }catch (\Exception $e){}
        return back()->with(['type'=>'success','title'=>'success','msg'=>'Your message has been submitted. We will get back to you shortly']);
    }//end askAQuestion function.

    public function viewBlog(Request $request, $id){
        $blogs =  Blog::where('id',$id)->first()->blog;
        return view('website.view_blog',compact('blogs'));
    }//end viewBlog function.
    public function dashboardIndex(Request $request){
        try {
            $packages = RoleUser::where('role_id', 4)->count();
            $hotels = RoleUser::where('role_id', 5)->count();
            $transports = RoleUser::where('role_id', 6)->count();
            $guestpass = RoleUser::where('role_id', 7)->count();
            $guides = RoleUser::where('role_id', 8)->count();
            $customers = RoleUser::where('role_id', 9)->count();
            $country_users_count = Profile::select('country', DB::raw('count(*) as total'))->groupBy('country')->get();

            $hotelsCounts = Roomreservation::groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $guideCounts = GuideReservation::groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $guestpassCounts = GuestpassReservation::groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $transportCounts = TransportReservation::groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
            $packagesCounts = Search::groupBy('receipt_num')->get()->pluck('receipt_num')->count();
            $hotelsSales = Roomreservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->pluck('TotalPrice')->sum();
            $guideSales = GuideReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('TotalPrice')->sum();
            $guestpassSales = GuestpassReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('TotalPrice')->sum();
            $transportSales = TransportReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('TotalPrice')->sum();
            $packagesSales = Search::where('booking_status', 'CONFIRMED')->where('payment_status', 'PAID')->groupBy('receipt_num')->get()->pluck('total_price')->sum();
            if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user') || Auth::user()->hasRole('admin')) {
                $mothly_sales_data['packages_monthly_sales'] = Search::where('booking_status', 'CONFIRMED')->where('payment_status', 'PAID')->select(
                    DB::raw('count(DISTINCT receipt_num) as `data`'),
                    DB::raw('sum(DISTINCT total_price) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $mothly_sales_data['hotel_monthly_sales'] = Roomreservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $mothly_sales_data['transport_monthly_sales'] = TransportReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $mothly_sales_data['shrines_monthly_sales'] = GuestpassReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $mothly_sales_data['guide_monthly_sales'] = GuideReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
            }
            if (Auth::user()->hasRole('PackagesAdmin')) {
                $user_packages = ManageSetting::where('user_id', Auth::user()->id)->get()->pluck('id');
                $mothly_sales_data['packages_monthly_sales'] = Search::whereIn('package_deals_id', $user_packages)->where('booking_status', 'CONFIRMED')->where('payment_status', 'PAID')->select(
                    DB::raw('count(DISTINCT receipt_num) as `data`'),
                    DB::raw('sum(DISTINCT total_price) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $packagesCounts = Search::whereIn('package_deals_id', $user_packages)->groupBy('receipt_num')->get()->pluck('receipt_num')->count();
                $packagesSales = Search::whereIn('package_deals_id', $user_packages)->where('booking_status', 'CONFIRMED')->where('payment_status', 'PAID')->groupBy('receipt_num')->get()->pluck('total_price')->sum();

            }
            if (Auth::user()->hasRole('HotelsAdmin')) {
                $user_hotel = Property::where('PropertyCreatedBy', Auth::user()->id)->get()->pluck('PropertyID');
                $user_rooms = Room::whereIn('PropertyId', $user_hotel)->get()->pluck('id');
                $mothly_sales_data['hotel_monthly_sales'] = Roomreservation::whereIn('RoomID', $user_rooms)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                //            return $mothly_sales_data['hotel_monthly_sales']->total = Roomreservation::whereIn('RoomID',$user_rooms)->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->select(
                //                DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                //                ->groupby('ReceiptNum')->groupby('year','month')->get();
                //                ;
                $hotelsCounts = Roomreservation::whereIn('RoomID', $user_rooms)->groupBy('ReceiptNum')->get()->pluck('ReceiptNum')->count();
                $hotelsSales = Roomreservation::whereIn('RoomID', $user_rooms)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->where('PaymentStatus', 'PAID')->groupBy('ReceiptNum')->get()->pluck('TotalPrice')->sum();
            }
            if (Auth::user()->hasRole('TransportAdmin')) {
                $user_transport = Transportationroute::where('TransportationOwnerID', Auth::user()->id)->get()->pluck('VehicleRouteID');
                $mothly_sales_data['transport_monthly_sales'] = TransportReservation::whereIn('VehicleRouteID', $user_transport)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $transportCounts = TransportReservation::whereIn('VehicleRouteID', $user_transport)->groupby('ReceiptNum')->get()->pluck('ReceiptNum')->count();
                $transportSales = TransportReservation::whereIn('VehicleRouteID', $user_transport)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->groupby('ReceiptNum')->get()->pluck('TotalPrice')->sum();

            }
            if (Auth::user()->hasRole('GuestsPassAdmin')) {
                $user_guestpass = GuestPass::where('GuestPassCreatedBy', Auth::user()->id)->get()->pluck('GuestPassID');
                $mothly_sales_data['shrines_monthly_sales'] = GuestpassReservation::whereIn('GuestPassID', $user_guestpass)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $guestpassCounts = GuestpassReservation::whereIn('GuestPassID', $user_guestpass)->get()->pluck('ReceiptNum')->count();
                $guestpassSales = GuestpassReservation::whereIn('GuestPassID', $user_guestpass)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->get()->pluck('TotalPrice')->sum();
            }
            if (Auth::user()->hasRole('GuideAdmin')) {
                $user_guides = Guide::where('GuidesCreatedBy', Auth::user()->id)->get();
                $mothly_sales_data['guide_monthly_sales'] = GuideReservation::whereIn('GuidesID', $user_guides)->where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->select(
                    DB::raw('count(DISTINCT ReceiptNum) as `data`'),
                    DB::raw('sum(DISTINCT TotalPrice) as `total`'),
                    DB::raw("DATE_FORMAT(created_at, '%Y, %m, %d') new_date"),
                    DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year', 'month')->get();
                $guideCounts = GuideReservation::whereIn('GuidesID', $user_guides)->groupby('ReceiptNum')->get()->pluck('ReceiptNum')->count();
                $guideSales = GuideReservation::where('BookingStatus', 'CONFIRMED')->where('PaymentStatus', 'PAID')->whereIn('GuidesID', $user_guides)->groupby('ReceiptNum')->get()->pluck('TotalPrice')->sum();
                //            ->pluck('TotalPrice');
            }
            //            $date_arr=array(
            //            0=>$mothly_sales_data['packages_monthly_sales'][0]->new_date??'',
            //            1=>$mothly_sales_data['hotel_monthly_sales'][0]->new_date??'',
            //            2=>$mothly_sales_data['transport_monthly_sales'][0]->new_date??'',
            //            3=>$mothly_sales_data['shrines_monthly_sales'][0]->new_date??'',
            //            4=>$mothly_sales_data['guide_monthly_sales'][0]->new_date??'');
            //            usort($date_arr, function($a, $b) {
            //                $dateTimestamp1 = strtotime($a);
            //                $dateTimestamp2 = strtotime($b);
            //                return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
            //            });
            //        $min_start_date = $date_arr[0];
            //        $max_start_date = $date_arr[count($date_arr) - 1];
            //
            //        $date_arr=array(
            //            0=>$mothly_sales_data['packages_monthly_sales'][sizeof($mothly_sales_data['packages_monthly_sales'])-1]->new_date??'',
            //            1=>$mothly_sales_data['hotel_monthly_sales'][sizeof($mothly_sales_data['hotel_monthly_sales'])-1]->new_date??'',
            //            2=>$mothly_sales_data['transport_monthly_sales'][sizeof($mothly_sales_data['transport_monthly_sales'])-1]->new_date??'',
            //            3=>$mothly_sales_data['shrines_monthly_sales'][sizeof($mothly_sales_data['shrines_monthly_sales'])-1]->new_date??'',
            //            4=>$mothly_sales_data['guide_monthly_sales'][sizeof($mothly_sales_data['guide_monthly_sales'])-1]->new_date??'');
            //        usort($date_arr, function($a, $b) {
            //            $dateTimestamp1 = strtotime($a);
            //            $dateTimestamp2 = strtotime($b);
            //            return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
            //        });
            //        $min_end_date = $date_arr[0];
            //        $max_end_date = $date_arr[count($date_arr) - 1];

            //        $packages   = RoleUser::where('role_id',4)->count();
            //        $hotels     = RoleUser::where('role_id',5)->count();
            //        $transports = RoleUser::where('role_id',6)->count();
            //        $guestpass  = RoleUser::where('role_id',7)->count();
            //        $guides     = RoleUser::where('role_id',8)->count();
            //        $customers  = RoleUser::where('role_id',9)->count();
            //        $country_users_count = Profile::select('country', DB::raw('count(*) as total'))->groupBy('country')->get();
            //        $hotelsCounts  = Roomreservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $guideCounts  = GuideReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $guestpassCounts  = GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $transportCounts  = TransportReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $packagesCounts  = Search::where('booking_status','CONFIRMED')->where('payment_status','PAID')->count();
            //        $hotelsCounts  = Roomreservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $guideCounts  = GuideReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $guestpassCounts  = GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $transportCounts  = TransportReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->count();
            //        $packagesCounts  = Search::where('booking_status','CONFIRMED')->where('payment_status','PAID')->count();
            //        $hotelsSales  = Roomreservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->sum('TotalPrice');
            //        $guideSales  = GuideReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->sum('TotalPrice');
            //        $guestpassSales  = GuestpassReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->sum('TotalPrice');
            //        $transportSales  = TransportReservation::where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->sum('TotalPrice');
            //        $packagesSales  = Search::where('booking_status','CONFIRMED')->where('payment_status','PAID')->sum('total_price');
            return view('dashboard.index', compact('packages', 'hotels', 'transports', 'guestpass', 'guides', 'customers', 'hotelsCounts', 'guideCounts', 'guestpassCounts', 'transportCounts', 'packagesCounts', 'hotelsSales', 'guideSales', 'guestpassSales', 'transportSales', 'packagesSales', 'country_users_count', 'mothly_sales_data'));
        }catch(\Exception $e){
            return redirect(url('/'));
        }
    }//end dashboardIndex function.
    public function withdrawAmountRequest(Request $request, $category, $receipt_num){
//        echo $category.'<br>';
        if($category == 1){
//            echo $category;
//            echo $receipt_num;
//            return;
            $withdraw_validate = Search::where('receipt_num',$receipt_num)->first()->withdraw;
            if(is_null($withdraw_validate)){
//                return $receipt_num;
//                return Search::where('receipt_num',$receipt_num)->get();
//                return Search::where('receipt_num',$receipt_num)->orWhereNull('request_refund_reply')->where('request_refund_reply','!=','REFUNDED')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->get();
                Search::where('receipt_num',$receipt_num)->orWhereNull('request_refund_reply')->where('request_refund_reply','!=','REFUNDED')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->update(['withdraw' => 0]);
                return back()->with('withdraw_request', 'Withdraw Request send to the Super Admin!');
            }else{
                return back()->with('already_requested', 'You are Already Requested for this sale!');
            }
        }elseif($category == 2){
            $withdraw_validate = Roomreservation::where('ReceiptNum',$receipt_num)->first()->withdraw;
            if(is_null($withdraw_validate)){
                Roomreservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('ReceiptNum',$receipt_num)->update(['withdraw' => 0]);
                return back()->with('withdraw_request', 'Withdraw Request send to the Super Admin!');
            }else{
                return back()->with('already_requested', 'You are Already Requested for this sale!');
            }
        }elseif($category == 3){
//            return $category;
            $withdraw_validate = TransportReservation::where('ReceiptNum',$receipt_num)->first()->withdraw;
            if(is_null($withdraw_validate)){
                TransportReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('ReceiptNum',$receipt_num)->update(['withdraw' => 0]);
                return back()->with('withdraw_request', 'Withdraw Request send to the Super Admin!');
            }else{
                return back()->with('already_requested', 'You are Already Requested for this sale!');
            }
        }elseif($category == 4){
            $withdraw_validate = GuestpassReservation::where('ReceiptNum',$receipt_num)->first()->withdraw;
            if(is_null($withdraw_validate)){
//                return GuestpassReservation::where('ReceiptNum',$receipt_num)->where('request_refund_reply','!=','REFUNDED')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->get();
                GuestpassReservation::where('ReceiptNum',$receipt_num)->where('request_refund_reply','!=','REFUNDED')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->update(['withdraw' => 0]);
                return back()->with('withdraw_request', 'Withdraw Request send to the Super Admin!');
            }else{
                return back()->with('already_requested', 'You are Already Requested for this sale!');
            }
        }elseif($category == 5){
            $withdraw_validate = GuideReservation::where('ReceiptNum',$receipt_num)->first()->withdraw;
            if(is_null($withdraw_validate)){
                GuideReservation::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply')->where('BookingStatus','CONFIRMED')->where('PaymentStatus','PAID')->where('ReceiptNum',$receipt_num)->update(['withdraw' => 0]);
                return back()->with('withdraw_request', 'Withdraw Request send to the Super Admin!');
            }else{
                return back()->with('already_requested', 'You are Already Requested for this sale!');
            }
        }
        return back();
    }
    public function getWithdrawRequestComment(Request $request, $category, $receipt_num)
    {
//        return $category;
        if($category == 1) {
            return Search::where('receipt_num', $receipt_num)->first()->withdraw_super_admin_comment??'';
        }elseif($category == 2){
            return Roomreservation::where('ReceiptNum', $receipt_num)->first()->withdraw_super_admin_comment??'';
        }elseif($category == 3){
            return TransportReservation::where('ReceiptNum', $receipt_num)->first()->withdraw_super_admin_comment??'';
        }elseif($category == 4){
            return GuestpassReservation::where('ReceiptNum', $receipt_num)->first()->withdraw_super_admin_comment??'';
        }elseif($category == 5){
            return GuideReservation::where('ReceiptNum', $receipt_num)->first()->withdraw_super_admin_comment??'';
        }
        return back();
    }//end withdrawAmountRequest function.
    public function returnAndRefund(Request $request){
        $pages = About::get();
        return view('website.return_and_refund',compact('pages'));
    }//end returnAndRefund function.
    public function careers(Request $request){
        $pages = About::get();
        return view('website.careers',compact('pages'));
    }//end careers function.
    public function cookiesPolicy(Request $request){
        $pages = About::get();
        return view('website.cookies_policy',compact('pages'));
    }//end cookiesPolicy function.
    public function media(Request $request){
        $pages = About::get();
        return view('website.media',compact('pages'));
    }//end media function.
    public function whyAlzuwar(Request $request){
        $pages = About::get();
        return view('website.why_alzuwar',compact('pages'));
    }//end whyAlzuwar function.
    public function advertiseWithUs(Request $request){
        $pages = About::get();
        return view('website.advertise_with_us',compact('pages'));
    }//end advertiseWithUs function.
    public function mecca(Request $request){
        $pages = About::get();
        return view('website.mecca',compact('pages'));
    }//end mecca function.
    public function medina(Request $request){
        $pages = About::get();
        return view('website.medina',compact('pages'));
    }//end medina function.
    public function karbala(Request $request){
        $pages = About::get();
        return view('website.karbala',compact('pages'));
    }//end karbala function.
    public function najaf(Request $request){
        $pages = About::get();
        return view('website.najaf',compact('pages'));
    }//end najaf function.
    public function samarrah(Request $request){
        $pages = About::get();
        return view('website.samarrah',compact('pages'));
    }//end samarrah function.
    public function kadhmain(Request $request){
        $pages = About::get();
        return view('website.kadhmain',compact('pages'));
    }//end kadhmain function.
    public function kufa(Request $request){
        $pages = About::get();
        return view('website.kufa',compact('pages'));
    }//end kufa function.
    public function damascus(Request $request){
        $pages = About::get();
        return view('website.damascus',compact('pages'));
    }//end damascus function.
    public function help(Request $request){
        $pages = About::get();
        $faqs = FAQ::get();
        return view('website.help',compact('pages','faqs'));
    }//end help function.
    public function donations(Request $request){
        $pages = About::get();
        return view('website.donation',compact('pages'));
    }//end donations function.
    public function acceptedWithdrawalPackagesDeal(){
        $search = Search::where('withdraw',1)->with('getPackageDealsOrderDetail.getPackageUser.profile')->orderBy('id', 'DESC')->get();
        return view('withdrawal.packages-withdrawal', compact('search'));
    }
    public function pendingWithdrawalPackagesDeal(){
        $search = Search::where('withdraw',0)->with('getPackageDealsOrderDetail.getPackageUser.profile')->orderBy('id', 'DESC')->get();
        return view('withdrawal.packages-withdrawal', compact('search'));
    }
    public function rejectedWithdrawalPackagesDeal(){
        $search = Search::where('withdraw',2)->with('getPackageDealsOrderDetail.getPackageUser.profile')->orderBy('id', 'DESC')->get();
        return view('withdrawal.packages-withdrawal', compact('search'));
    }
    public function acceptedWithdrawalHotel(){
        $roompassreserves = Roomreservation:: where('withdraw',1)->with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
        return view('withdrawal.hotel-withdrawal',compact('roompassreserves'));
    }
    public function pendingWithdrawalHotel(){
        $roompassreserves = Roomreservation:: where('withdraw',0)->with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
        return view('withdrawal.hotel-withdrawal',compact('roompassreserves'));
    }
    public function rejectedWithdrawalHotel(){
        $roompassreserves = Roomreservation:: where('withdraw',2)->with('getReservationOrdersproperty','getReservationOrdersroom','getRoomOrderssupadmin.getUserofProperty')->groupBy('ReceiptNum')->orderBy('updated_at', 'DESC')->get();
        return view('withdrawal.hotel-withdrawal',compact('roompassreserves'));
    }
    public function acceptedWithdrawalShrinePrograms(){
        $guestpassreserves = GuestpassReservation::where('withdraw',1)->with('getGuestPassOrders')->orderBy('updated_at', 'DESC')->get();
        return view('withdrawal.shrine-programs-withdrawal',compact('guestpassreserves'));
    }
    public function pendingWithdrawalShrinePrograms(){
        $guestpassreserves = GuestpassReservation::where('withdraw',0)->with('getGuestPassOrders')->orderBy('updated_at', 'DESC')->get();
        return view('withdrawal.shrine-programs-withdrawal',compact('guestpassreserves'));
    }
    public function rejectedWithdrawalShrinePrograms(){
        $guestpassreserves = GuestpassReservation::where('withdraw',2)->with('getGuestPassOrders')->orderBy('updated_at', 'DESC')->get();
        return view('withdrawal.shrine-programs-withdrawal',compact('guestpassreserves'));
    }
    public function acceptedWithdrawalTransportation(){
        $transportreserves = TransportReservation::where('withdraw',1)->with('getTransportOrders','getTransportmainrouteforreservation')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
        return view('withdrawal.transportation-withdrawal',compact('transportreserves'));
    }
    public function pendingWithdrawalTransportation(){
        $transportreserves = TransportReservation::where('withdraw',0)->with('getTransportOrders','getTransportmainrouteforreservation')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
        return view('withdrawal.transportation-withdrawal',compact('transportreserves'));
    }
    public function rejectedWithdrawalTransportation(){
        $transportreserves = TransportReservation::where('withdraw',2)->with('getTransportOrders','getTransportmainrouteforreservation')->orderBy('updated_at', 'DESC')->groupby('ReceiptNum')->get();
        return view('withdrawal.transportation-withdrawal',compact('transportreserves'));
    }
    public function acceptedWithdrawalguide(){
        $guidereserves = GuideReservation::where('withdraw',1)->with('getGuideOrders')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
        return view('withdrawal.guide-withdrawal',compact('guidereserves'));
    }
    public function pendingWithdrawalguide(){
        $guidereserves = GuideReservation::where('withdraw',0)->with('getGuideOrders')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
        return view('withdrawal.guide-withdrawal',compact('guidereserves'));
    }
    public function rejectedWithdrawalguide(){
        $guidereserves = GuideReservation::where('withdraw',2)->with('getGuideOrders')->orderBy('updated_at', 'DESC')->groupBy('ReceiptNum')->get();
        return view('withdrawal.guide-withdrawal',compact('guidereserves'));
    }
    public function withdrawRequestAcceptReject(Request $request){
//        return $request;
//        return $request->receipt_num;

        if($request->category_id == 1) {
            Search::where('receipt_num', $request->ReceiptNum)->update(['withdraw'=>$request->withdraw, 'withdraw_super_admin_comment'=>$request->withdraw_super_admin_comment]);
        }elseif($request->category_id == 2){
            Roomreservation::where('ReceiptNum', $request->ReceiptNum)->update(['withdraw'=>$request->withdraw, 'withdraw_super_admin_comment'=>$request->withdraw_super_admin_comment]);
        }elseif($request->category_id == 3){
            TransportReservation::where('ReceiptNum', $request->ReceiptNum)->update(['withdraw'=>$request->withdraw, 'withdraw_super_admin_comment'=>$request->withdraw_super_admin_comment]);
        }elseif($request->category_id == 4){
            GuestpassReservation::where('ReceiptNum', $request->ReceiptNum)->update(['withdraw'=>$request->withdraw, 'withdraw_super_admin_comment'=>$request->withdraw_super_admin_comment]);
        }elseif($request->category_id == 5){
            GuideReservation::where('ReceiptNum', $request->ReceiptNum)->update(['withdraw'=>$request->withdraw, 'withdraw_super_admin_comment'=>$request->withdraw_super_admin_comment]);
        }
        return back();
    }




    function calculateOrderAmount(array $items){
        // Replace this constant with a calculation of the order's amount
        // Calculate the order total on the server to prevent
        // people from directly manipulating the amount on the client
        return 1400;
    }

    public function test1(Request $request){
    // This is a sample test API key.
//        sk_test_4eC39HqLyjWDarjtT1zdp7dc
        Stripe::setApiKey('sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH');
        $stripe = new \Stripe\StripeClient('sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH');
        header('Content-Type: application/json');
        try {
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
            // Create a PaymentIntent with amount and currency
//            $paymentIntent = \Stripe\PaymentIntent::create([
//                'amount' => '100',
//                'currency' => 'eur',
//                'automatic_payment_methods' => [
//                'enabled' => true,
//                ],
//            ]);
//           return $paymentIntent->client_secret;
            $output = [
                'clientSecret' => 'sk_test_51JaWzdJ9wLXqEzY52htxOjRzJ1O49tq1Eog1XtkhY50DH4lkBDfDX2zidkEUf91xzS5zs5s5IiY2QfAaOqCfIISj00AOJOyPXH',
            ];
//            json_encode($paymentIntent->client_secret);
            return response()->json($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

    }
    public function test(){
return        User::where('id','>',1)->update(['password'=>bcrypt('123456')]);
        return view('website.test');
    }
}//end class WebsiteController.

