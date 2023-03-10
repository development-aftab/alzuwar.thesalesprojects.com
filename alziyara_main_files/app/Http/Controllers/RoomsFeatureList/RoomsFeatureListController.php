<?php

namespace App\Http\Controllers\RoomsFeatureList;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\RoomsFeatureList;
use Illuminate\Http\Request;

class RoomsFeatureListController extends Controller
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $roomsfeaturelist = RoomsFeatureList::where('FeatureID', 'LIKE', "%$keyword%")
                ->orWhere('Title', 'LIKE', "%$keyword%")
                ->orWhere('ImageIcon', 'LIKE', "%$keyword%")
                ->orWhere('Description', 'LIKE', "%$keyword%")
                ->orWhere('SortOrder', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $roomsfeaturelist = RoomsFeatureList::paginate($perPage);
            }

            return view('roomsFeatureList.rooms-feature-list.index', compact('roomsfeaturelist'));
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('roomsFeatureList.rooms-feature-list.create');
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
//			'FeatureID' => 'required',
			'Title' => 'required'
		]);
            $requestData = $request->all();
            
            RoomsFeatureList::create($requestData);
            return redirect('roomsFeatureList/rooms-feature-list')->with('flash_message', 'RoomsFeatureList added!');
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $roomsfeaturelist = RoomsFeatureList::findOrFail($id);
            return view('roomsFeatureList.rooms-feature-list.show', compact('roomsfeaturelist'));
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $roomsfeaturelist = RoomsFeatureList::findOrFail($id);
            return view('roomsFeatureList.rooms-feature-list.edit', compact('roomsfeaturelist'));
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'FeatureID' => 'required',
			'Title' => 'required'
		]);
            $requestData = $request->all();
            
            $roomsfeaturelist = RoomsFeatureList::findOrFail($id);
             $roomsfeaturelist->update($requestData);

             return redirect('roomsFeatureList/rooms-feature-list')->with('flash_message', 'RoomsFeatureList updated!');
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
        $model = str_slug('roomsfeaturelist','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            RoomsFeatureList::destroy($id);

            return redirect('roomsFeatureList/rooms-feature-list')->with('flash_message', 'RoomsFeatureList deleted!');
        }
        return response(view('403'), 403);

    }
}
