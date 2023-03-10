<?php

namespace App\Http\Controllers\TourTrip;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TourTrip;
use Illuminate\Http\Request;
use Storage;
class TourTripController extends Controller
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $tourtrip = TourTrip::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('rating', 'LIKE', "%$keyword%")
                ->orWhere('feature', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $tourtrip = TourTrip::paginate($perPage);
            }

            return view('tourTrip.tour-trip.index', compact('tourtrip'));
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('tourTrip.tour-trip.create');
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }
            TourTrip::create($requestData);
            return redirect('tourTrip/tour-trip')->with('flash_message', 'TourTrip added!');
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $tourtrip = TourTrip::findOrFail($id);
            return view('tourTrip.tour-trip.show', compact('tourtrip'));
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $tourtrip = TourTrip::findOrFail($id);
            return view('tourTrip.tour-trip.edit', compact('tourtrip'));
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
            }
            $tourtrip = TourTrip::findOrFail($id);
             $tourtrip->update($requestData);

             return redirect('tourTrip/tour-trip')->with('flash_message', 'TourTrip updated!');
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
        $model = str_slug('tourtrip','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TourTrip::destroy($id);

            return redirect('tourTrip/tour-trip')->with('flash_message', 'TourTrip deleted!');
        }
        return response(view('403'), 403);

    }
}
