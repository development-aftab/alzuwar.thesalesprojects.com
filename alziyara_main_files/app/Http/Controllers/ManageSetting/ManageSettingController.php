<?php

namespace App\Http\Controllers\ManageSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\PackageDealReview;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;
use App\ManageSetting;
use App\PackageDealPhoto;
use App\PackageDealType;
use Illuminate\Http\Request;

class ManageSettingController extends Controller
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
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 100;

            if (!empty($keyword)) {
                $managesetting = ManageSetting::where('product_category', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_type_id', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_name', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_desc', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_itinerary', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_status', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('max_occupancy', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_time', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_location', 'LIKE', "%$keyword%")
                ->orWhere('house_rules', 'LIKE', "%$keyword%")
                ->orWhere('display_on_home_page', 'LIKE', "%$keyword%")
                ->orWhere('sort_order', 'LIKE', "%$keyword%")
                ->orWhere('package_deals_create_by', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if(auth()->user()->hasrole('PackagesAdmin')) {
                    $managesetting = ManageSetting::orderBy('id', 'DESC')->where('user_id', Auth::id())->paginate($perPage);
                }else{
                    $managesetting = ManageSetting::orderBy('id', 'DESC')->paginate($perPage);
                }
            }

            return view('manageSetting.manage-setting.index', compact('managesetting'));
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
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $PackageDealType =PackageDealType::get();
            return view('manageSetting.manage-setting.create',compact('PackageDealType'));
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
//        return $request->all();
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            DB::beginTransaction();

            try{
                $requestData = $request->all();
                $manageSetting = ManageSetting::create([
                    'user_id'=>Auth::id(),
                    'house_rules'=>$request->house_rules,
                    'product_category'=>$request->product_category??'',
                    'package_deals_type_id'=>$request->package_deals_type_id??'',
                    'package_deals_name'=>$request->package_deals_name??'',
                    'package_deals_desc'=>$request->package_deals_desc??'',
                    'package_deals_itinerary'=>$request->package_deals_itinerary??'',
                    'package_deals_status'=>$request->status??'',
                    'price'=>$request->price??'',
                    'max_occupancy'=>$request->max_occupancy??'',
                    'package_deals_time'=>$request->package_deals_time??'',
                    'package_deals_location'=>$request->package_deals_location??'',
                    'display_on_home_page'=>$request->display_on_home_page??'',
                    'sort_order'=>$request->sort_order??'',
                    'package_deals_create_by'=>Auth()->user()->email??'',
                    'package_available_from'=>$request->available_from??'',
                    'package_available_to'=>$request->available_to??'',
                    'accomodation'=>$request->accomodation??'',
                    'transportation'=>$request->transportation??'',
                    'meal'=>$request->meal??'',
                    'location'=>$request->location??'',
                    'airfare'=>$request->airfare??'',
                    'total_stay'=>$request->total_stay??'',
                    'departure_place'=>$request->departure_place??'',
                    'guide'=>$request->guide??'',
                    'deadline'=>$request->deadline??''
                ]);
                PackageDealReview::create([
                    'PackageDealsID'=>$manageSetting->id,
                    'ReviewerName'=>Auth::user()->name,
                    'EmailAddress'=>Auth::user()->email,
                    'Description'=>'No Rating Package',
                    'Rating'=>0, "IPAddress"=>\Request::getClientIp(true),
                    'flag'=>0
                ]);

                if ($request->hasfile('PhotoLocation')) {

                    foreach($request->file('PhotoLocation') as $key => $file){

                        $imageName = Storage::disk('website')->put('package', $file);

                        $selectedimageindex = (int)$request->Showimage[0];

                        if($key == $selectedimageindex ){

                            $flag = 1;

                            // dd($key);

                        }else{

                            $flag = 0;

                        }

                        $user = PackageDealPhoto::create([
                            "PackageDealsID"    => $manageSetting->id,
                            "PhotoTitle"     => $request->PhotoTitle[$key],
                            "AltText"        => $request->AltText[$key],
                            "PhotoLocation"  => $imageName,
                            "SortOrder"      => 1,
                            "DefaultFlag"    => $flag,
                        ]);

                    }
                }
                DB::commit();
            }
            catch (\Throwable $e)
            {
                DB::rollback();

            }
            
//            ManageSetting::create($requestData);
            return redirect('manageSetting/manage-setting')->with('flash_message', 'ManageSetting added!');
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
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $managesetting = ManageSetting::findOrFail($id);
            return view('manageSetting.manage-setting.show', compact('managesetting'));
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
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $managesetting = ManageSetting::with('getPackageDealsAllPhotos')->findOrFail($id);
            $PackageDealType =PackageDealType::get();
            return view('website.editpackagedeals', compact('managesetting','PackageDealType'));
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
//        return $request->all();
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            DB::beginTransaction();

            try{
                $requestData = $request->all();
                $managesetting = ManageSetting::findOrFail($id);
                //Update
                $managesetting->update([
                    'house_rules'=>$request->house_rules,
                    'product_category'=>$request->product_category??'',
                    'package_deals_type_id'=>$request->package_deals_type_id??'',
                    'package_deals_name'=>$request->package_deals_name??'',
                    'package_deals_desc'=>$request->package_deals_desc??'',
                    'package_deals_itinerary'=>$request->package_deals_itinerary??'',
                    'package_deals_status'=>$request->status??'',
                    'status_from_admin'=>$request->status_from_admin??0,
                    'price'=>$request->price??'',
                    'max_occupancy'=>$request->max_occupancy??'',
                    'package_deals_time'=>$request->package_deals_time??'',
                    'package_deals_location'=>$request->package_deals_location??'',
                    'display_on_home_page'=>$request->display_on_home_page??'',
                    'sort_order'=>$request->sort_order??'',
                    'package_deals_create_by'=>$request->package_deals_create_by??'',
                    'package_available_from'=>$request->available_from??'',
                    'package_available_to'=>$request->available_to??'',
                    'accomodation'=>$request->accomodation??'',
                    'transportation'=>$request->transportation??'',
                    'meal'=>$request->meal??'',
                    'location'=>$request->location??'',
                    'airfare'=>$request->airfare??'',
                    'total_stay'=>$request->total_stay??'',
                    'departure_place'=>$request->departure_place??'',
                    'guide'=>$request->guide??'',
                    'deadline'=>$request->deadline??'']);

                if ($request->hasfile('PhotoLocationupload')) {

                    $uploadimageindex = 0 ;

                    foreach($request->file('PhotoLocationupload') as $key => $file){

                        // dd($request->PhotoLocationupload);

                        $imageNameupload = Storage::disk('website')->put('package', $file);

                        $user = PackageDealPhoto::where('id', $request->PackageDealsID)
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


                        $imageName = Storage::disk('website')->put('package', $file);

                        $user = PackageDealPhoto::create([
                            "PackageDealsID"    => $request->PackageDealsID,
                            "PhotoTitle"     => $request->PhotoTitle[$key],
                            "AltText"        => $request->AltText[$key],
                            "PhotoLocation"  => $imageName,
                            "SortOrder"      => 1,
                            "DefaultFlag"    => 0,
                        ]);

                    }
                }
    //             $managesetting->update($requestData);

                 return redirect('manageSetting/manage-setting')->with('flash_message', 'ManageSetting updated!');
                return response(view('403'), 403);
                DB::commit();
            }
            catch (\Throwable $e)
            {
                DB::rollback();

            }
            }

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
        $model = str_slug('managesetting','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ManageSetting::destroy($id);

            return redirect('manageSetting/manage-setting')->with('flash_message', 'ManageSetting deleted!');
        }
        return response(view('403'), 403);

    }
}
