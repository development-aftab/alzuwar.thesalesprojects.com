<?php

namespace App\Http\Controllers\TransportFeature;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TransportFeature;
use Illuminate\Http\Request;

class TransportFeatureController extends Controller
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $transportfeature = TransportFeature::where('FeatureID', 'LIKE', "%$keyword%")
                ->orWhere('Title', 'LIKE', "%$keyword%")
                ->orWhere('ImageIcon', 'LIKE', "%$keyword%")
                ->orWhere('Description', 'LIKE', "%$keyword%")
                ->orWhere('SortOrder', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $transportfeature = TransportFeature::paginate($perPage);
            }

            return view('transportFeature.transport-feature.index', compact('transportfeature'));
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('transportFeature.transport-feature.create');
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'Title' => 'required'
		]);
            $requestData = $request->all();
            
            TransportFeature::create($requestData);
            return redirect('transportFeature/transport-feature')->with('flash_message', 'TransportFeature added!');
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $transportfeature = TransportFeature::findOrFail($id);
            return view('transportFeature.transport-feature.show', compact('transportfeature'));
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $transportfeature = TransportFeature::findOrFail($id);
            return view('transportFeature.transport-feature.edit', compact('transportfeature'));
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'Title' => 'required'
		]);
            $requestData = $request->all();
            
            $transportfeature = TransportFeature::findOrFail($id);
             $transportfeature->update($requestData);

             return redirect('transportFeature/transport-feature')->with('flash_message', 'TransportFeature updated!');
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
        $model = str_slug('transportfeature','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TransportFeature::destroy($id);

            return redirect('transportFeature/transport-feature')->with('flash_message', 'TransportFeature deleted!');
        }
        return response(view('403'), 403);

    }
}
