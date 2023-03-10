<?php

namespace App\Http\Controllers\Guid;

use App\GuideCity;
use App\GuideLanguage;
use App\Guides_photo;
use App\Guides_Review;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Guid;
use Illuminate\Http\Request;
use Auth;
use Storage;
use DB;
class GuidController extends Controller
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
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $guid = Guid::where('GuidesID', 'LIKE', "%$keyword%")
                ->orWhere('Productcategory', 'LIKE', "%$keyword%")
                ->orWhere('GuidesName', 'LIKE', "%$keyword%")
                ->orWhere('GuidesDesc', 'LIKE', "%$keyword%")
                ->orWhere('GuidesItinerary', 'LIKE', "%$keyword%")
                ->orWhere('Admin_status', 'LIKE', "%$keyword%")
                ->orWhere('userstatus', 'LIKE', "%$keyword%")
                ->orWhere('GuidesStatus', 'LIKE', "%$keyword%")
                ->orWhere('PricePerDay', 'LIKE', "%$keyword%")
                ->orWhere('MaxOccupancy', 'LIKE', "%$keyword%")
                ->orWhere('GuidesLocation', 'LIKE', "%$keyword%")
//                ->orWhere('DaysInTrip', 'LIKE', "%$keyword%")
                ->orWhere('HouseRules', 'LIKE', "%$keyword%")
                ->orWhere('DisplayOnHomePage', 'LIKE', "%$keyword%")
                ->orWhere('SortOrder', 'LIKE', "%$keyword%")
                ->orWhere('GuidesCreatedBy', 'LIKE', "%$keyword%")
                ->orWhere('Languages', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if(Auth::user()->hasrole('admin') || Auth::user()->hasrole('SuperAdmin')){
                    $guid = Guid::orderBy('GuidesID', 'DESC')->paginate($perPage);
                }
                else{
                    $guid = Guid::orderBy('GuidesID', 'DESC')->where('GuidesCreatedBy',Auth::user()->id)->paginate($perPage);
                }

            }

            return view('guid.guid.index', compact('guid'));
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
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $languages = GuideLanguage::where('status',1)->get();
            $cities = GuideCity::where('status',1)->get();
            return view('guid.guid.create',compact('languages','cities'));
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
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'GuidesCreatedBy' => 'required',
			'GuidesName' => 'required',
			'GuidesDesc' => 'required',
			'PricePerDay' => 'required',
			'MaxOccupancy' => 'required',
//			'DaysInTrip' => 'required',
//			'guide_startdate' => 'required',
//			'guide_enddate' => 'required',
//			'guide_deadlinedate' => 'required',
			'HouseRules' => 'required',
			'Languages' => 'required',
			'GuidesStatus' => 'required'

		]);
            $requestData = $request->all();
            $requestData['Languages'] = implode(",",$requestData['Languages']);
            DB::beginTransaction();
            try{
                $guide = Guid::create($requestData);
                foreach($request->file('PhotoLocation') as $key => $file){
                    $imageName = Storage::disk('website')->put('Guide', $file);
                    $selectedimageindex = (int)$request->Showimage[0];
                    if($key == $selectedimageindex ){
                        $flag = 1;
                        // dd($key);
                    }else{
                        $flag = 0;
                    }
                    Guides_photo::create([
                        "GuidesID"    => $guide->GuidesID,
                        "PhotoTitle"     => $request->PhotoTitle[$key],
                        "AltText"        => $request->AltText[$key],
                        "PhotoLocation"  => $imageName,
                        "SortOrder"      => 1,
                        "DefaultFlag"    => $flag,
                    ]);
                }
                Guides_Review::create([
                    "GuidesID"=>$guide->GuidesID,
                    "Name"=>Auth::user()->name,
                    "EmailAddress"=>Auth::user()->email,
                    "Rating"=>0,
                    "IPAddress"=>\Request::getClientIp(true),
                    "Flag"=>0
                ]);
                DB::commit();
                return redirect('guid/guid')->with('message', 'Guid Added Successfully!');
            }
            catch (\Throwable $e) {
                DB::rollback();
            }
            return redirect('guid/guid')->with('message', 'Error in Add Guide!');
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
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $guid = Guid::findOrFail($id);
            return view('guid.guid.show', compact('guid'));
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
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $guid = Guid::findOrFail($id);
            $languages = GuideLanguage::where('status',1)->get();
            $cities = GuideCity::where('status',1)->get();
            return view('guid.guid.edit', compact('guid','languages','cities'));
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
    public function update(Request $request )
    {
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
//                'GuidesCreatedBy' => 'required',
                'GuidesName' => 'required',
                'GuidesDesc' => 'required',
                'PricePerDay' => 'required',
                'MaxOccupancy' => 'required',
//                'DaysInTrip' => 'required',
//                'guide_startdate' => 'required',
//                'guide_enddate' => 'required',
//                'guide_deadlinedate' => 'required',
                'HouseRules' => 'required',
                'Languages' => 'required',
                'GuidesStatus' => 'required',
//                'Status'      =>  'required',
                'Admin_status'      =>  'required',
                'PhotoTitle.*'          =>  'required',
                'PhotoTitleupload.*'    =>  'required',
                'AltText.*'             =>  'required',
                'AltTextupload.*'       =>  'required',
                'PhotoLocation.*'       =>  'required|mimes:jpeg,bmp,png|max:2000',
                'PhotoLocationupload.*' =>  'required|mimes:jpeg,bmp,png|max:2000',
            ]);
            DB::beginTransaction();
            try{
//            return $requestData = $request->all();
            $requestData = array_except($request->all(), ['_token','photoidupload','PhotoTitleupload','AltTextupload','photoid','Showimage','PhotoTitle','AltText','PhotoLocation']);
            $requestData['Languages'] = implode(',', $request->Languages);
            $guid = Guid::findOrFail($request->GuidesID);
            $guid::where('GuidesID', $request->GuidesID)->update($requestData);
            if ($request->hasfile('PhotoLocationupload')){
                $uploadimageindex = 0;
                foreach($request->file('PhotoLocationupload') as $key => $file){
                    $imageNameupload = Storage::disk('website')->put('Guide', $file);
                    $user = Guides_photo::where('GuidesID', $request->GuidesID)
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
                    $imageName = Storage::disk('website')->put('Guide', $file);
                    $user = Guides_photo::create([
                        "GuidesID"    => $request->GuidesID,
                        "PhotoTitle"     => $request->PhotoTitle[$key],
                        "AltText"        => $request->AltText[$key],
                        "PhotoLocation"  => $imageName,
                        "SortOrder"      => 1,
                        "DefaultFlag"    => 0,
                    ]);
                }
            }
            $propertyallphotos = Guides_photo::where('GuidesID', $request->GuidesID)->get();
            foreach($propertyallphotos as $key => $propertypassphotosids){
                $selectedimageindex = (int)$request->Showimage[0];
                if($key == $selectedimageindex ){
                    $flag = 1;
                }else{
                    $flag = 0;

                }
                Guides_photo::where('GuidesID', $request->GuidesID)
                    ->where('PhotoID', $propertypassphotosids->PhotoID)
                    ->update([
                        "DefaultFlag"      => $flag,
                    ]);
            }
                DB::commit();
                return redirect('guid/guid')->with('message', 'Guides Updated Successfully!');
            }
            catch (\Throwable $e) {
                DB::rollback();
            }
             return redirect('guid/guid')->with('flash_message', 'Guide not updated!');
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
        foreach (Guides_photo::where('GuidesID',$id)->get() as $photo){
            array_push($photos_arr,$photo->PhotoLocation);
        }
        $model = str_slug('guid','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            DB::beginTransaction();
            try{
                Guid::destroy($id);
                Guides_photo::where('GuidesID',$id)->delete();
                Guides_Review::where('GuidesID',$id)->delete();
                DB::commit();
                foreach ($photos_arr as $photo){
                    Storage::disk('website')->delete($photo);
                }
                return redirect('guid/guid')->with('message', 'Guide deleted!');
            }
            catch (\Throwable $e) {
                DB::rollback();
            }
            return redirect('guid/guid')->with('message', 'Guid not deleted!');
        }
        return response(view('403'), 403);
    }
    public function guideImageRemove($id){
        Guides_photo::where('PhotoID',$id)->delete();
    }
}
