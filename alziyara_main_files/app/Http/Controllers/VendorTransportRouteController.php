<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\VendorTransportRoute;
use Illuminate\Http\Request;

class VendorTransportRouteController extends Controller
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $vendortransportroute = VendorTransportRoute::where('VehicleRouteID', 'LIKE', "%$keyword%")
                ->orWhere('RouteID', 'LIKE', "%$keyword%")
                ->orWhere('Price', 'LIKE', "%$keyword%")
                ->orWhere('TwoWayPrice', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $vendortransportroute = VendorTransportRoute::paginate($perPage);
            }

            return view('vendor-transport-route.index', compact('vendortransportroute'));
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('vendor-transport-route.create');
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'VehicleRouteID' => 'required',
			'RouteID' => 'required'
		]);
            $requestData = $request->all();
            
            VendorTransportRoute::create($requestData);
            return redirect('vendor-transport-route')->with('flash_message', 'VendorTransportRoute added!');
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $vendortransportroute = VendorTransportRoute::findOrFail($id);
            return view('vendor-transport-route.show', compact('vendortransportroute'));
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $vendortransportroute = VendorTransportRoute::findOrFail($id);
            return view('vendor-transport-route.edit', compact('vendortransportroute'));
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'VehicleRouteID' => 'required',
			'RouteID' => 'required'
		]);
            $requestData = $request->all();
            
            $vendortransportroute = VendorTransportRoute::findOrFail($id);
             $vendortransportroute->update($requestData);

             return redirect('vendor-transport-route')->with('flash_message', 'VendorTransportRoute updated!');
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
        $model = str_slug('vendortransportroute','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            VendorTransportRoute::destroy($id);

            return redirect('vendor-transport-route')->with('flash_message', 'VendorTransportRoute deleted!');
        }
        return response(view('403'), 403);

    }
}
