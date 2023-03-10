<?php

namespace App\Http\Controllers\AgencyImage;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\AgencyImage;
use Illuminate\Http\Request;
use Storage;

class AgencyImageController extends Controller
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $agencyimage = AgencyImage::where('image', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $agencyimage = AgencyImage::paginate($perPage);
            }

            return view('agencyImage.agency-image.index', compact('agencyimage'));
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('agencyImage.agency-image.create');
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();

            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }
            
            AgencyImage::create($requestData);
            return redirect('agencyImage/agency-image')->with('flash_message', 'AgencyImage added!');
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $agencyimage = AgencyImage::findOrFail($id);
            return view('agencyImage.agency-image.show', compact('agencyimage'));
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $agencyimage = AgencyImage::findOrFail($id);
            return view('agencyImage.agency-image.edit', compact('agencyimage'));
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }

            $agencyimage = AgencyImage::findOrFail($id);
             $agencyimage->update($requestData);

             return redirect('agencyImage/agency-image')->with('flash_message', 'AgencyImage updated!');
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
        $model = str_slug('agencyimage','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            AgencyImage::destroy($id);

            return redirect('agencyImage/agency-image')->with('flash_message', 'AgencyImage deleted!');
        }
        return response(view('403'), 403);

    }
}
