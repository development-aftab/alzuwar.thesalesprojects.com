<?php

namespace App\Http\Controllers\TravelAgency;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TravelAgency;
use Illuminate\Http\Request;

class TravelAgencyController extends Controller
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $travelagency = TravelAgency::where('name', 'LIKE', "%$keyword%")
                ->orWhere('contact', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $travelagency = TravelAgency::paginate($perPage);
            }

            return view('travelAgency.travel-agency.index', compact('travelagency'));
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('travelAgency.travel-agency.create');
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            TravelAgency::create($requestData);
            return redirect('travelAgency/travel-agency')->with('flash_message', 'TravelAgency added!');
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $travelagency = TravelAgency::findOrFail($id);
            return view('travelAgency.travel-agency.show', compact('travelagency'));
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $travelagency = TravelAgency::findOrFail($id);
            return view('travelAgency.travel-agency.edit', compact('travelagency'));
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $travelagency = TravelAgency::findOrFail($id);
             $travelagency->update($requestData);

             return redirect('travelAgency/travel-agency')->with('flash_message', 'TravelAgency updated!');
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
        $model = str_slug('travelagency','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TravelAgency::destroy($id);

            return redirect('travelAgency/travel-agency')->with('flash_message', 'TravelAgency deleted!');
        }
        return response(view('403'), 403);

    }
}
