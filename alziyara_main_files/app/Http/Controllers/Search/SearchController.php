<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ManageSetting;
use App\User;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
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
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 100;
            if (!empty($keyword)) {
                $search = Search::where('receipt_num', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_id', 'LIKE', "%$keyword%")
                ->orWhere('qty', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->orWhere('reservation_for_date', 'LIKE', "%$keyword%")
                ->orWhere('notes_by_customer', 'LIKE', "%$keyword%")
                ->orWhere('total_price', 'LIKE', "%$keyword%")
                ->orWhere('booking_status', 'LIKE', "%$keyword%")
                ->orWhere('payment_status', 'LIKE', "%$keyword%")
                ->orWhere('sp_comments', 'LIKE', "%$keyword%")
                ->orWhere('sp_comments_date_time', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if (auth()->user()->hasrole('PackagesAdmin')) {
                    $packageID = ManageSetting::where('user_id',Auth::id())->pluck('id');
                    $bookings = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
                    $bookings = $bookings->whereIn('package_deals_id',$packageID)->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->pluck('receipt_num')->count();
                    $package = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
                    $package = $package->whereIn('package_deals_id',$packageID)->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
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
                    $packagewithdraw = $packagewithdraw->whereIn('package_deals_id',$packageID)->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
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
					// dd($arr);
                    $search = Search::orderBy('id', 'DESC')->whereIn('package_deals_id',$packageID)->paginate($perPage);
					$searchstatus = Search::where('booking_status','CONFIRMED')->where('payment_status','PAID')->orderBy('id', 'DESC')->whereIn('package_deals_id',$packageID)->paginate($perPage);
                    return view('search.search.index',compact('search','searchstatus','mytotalprice','bookings','spEarning','spEarningWithdraw'));
                } else {


                    $bookings = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
                    $bookings = $bookings->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->pluck('receipt_num')->count();
                    $package = Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
                    $package = $package->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
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
                    $totalDonation =$totalDonation->where('package_donation',1)->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get();
                    $totalInsurance =Search::where('request_refund_reply','!=','REFUNDED')->orWhereNull('request_refund_reply');
                    $totalInsurance =$totalInsurance->where('package_insurance',1)->where('booking_status','CONFIRMED')->where('payment_status','PAID')->groupBy('receipt_num')->get()->pluck('receipt_num')->count();

                    $search = Search::with('getPackageDealsOrderDetail.getPackageUser.profile')->orderBy('id', 'DESC')->paginate($perPage);
					$searchstatus = Search::with('getPackageDealsOrderDetail.getPackageUser.profile')->where('booking_status','CONFIRMED')->where('payment_status','PAID')->orderBy('id', 'DESC')->paginate($perPage);


                    return view('search.search.index',compact('search','searchstatus','mytotalprice','bookings','spEarning','appFee','totalDonation','totalInsurance'));
                }

               }
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
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('search.search.create');
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
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();

            Search::create($requestData);
            return redirect('search/search')->with('flash_message', 'Search added!');
        }
        return response(view('403'), 403);
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
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {

            $search = Search::findOrFail($id);
            $user = User::where('id',$search->user_id??'')->first();
            return view('search.search.show', compact('search','user'));
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
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $search = Search::findOrFail($id);
            return view('search.search.edit', compact('search'));
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
    public function update(Request $request, $id)
    {
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $search = Search::findOrFail($id);
             $search->update($requestData);

             return redirect('search/search')->with('flash_message', 'Search updated!');
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
        $model = str_slug('search','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Search::destroy($id);

            return redirect('search/search')->with('flash_message', 'Search deleted!');
        }
        return response(view('403'), 403);

    }
}
