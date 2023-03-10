<?php

namespace App\Http\Controllers\TransportRoute;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TransportRoute;
use Illuminate\Http\Request;

class TransportRouteController extends Controller
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 1500;

            if (!empty($keyword)) {
                $transportroute = TransportRoute::where('RouteID', 'LIKE', "%$keyword%")
                ->orWhere('RouteName', 'LIKE', "%$keyword%")
                ->orWhere('RouteFrom', 'LIKE', "%$keyword%")
                ->orWhere('RouteTo', 'LIKE', "%$keyword%")
                ->orWhere('Distance', 'LIKE', "%$keyword%")
                ->orWhere('DrivingTime', 'LIKE', "%$keyword%")
                ->orWhere('PickupDateTime', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $transportroute = TransportRoute::paginate($perPage);
            }

            return view('transportRoute.transport-route.index', compact('transportroute'));
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('transportRoute.transport-route.create');
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
            'RouteFrom'   => 'required|unique:transportation_routes,RouteFrom,Null,RouteID,RouteTo,'.$request->RouteTo,
			'RouteFrom' => 'required',
			'RouteTo' => 'required',
			'Distance' => 'required|numeric',
			'DrivingTime' => 'required',
//			'PickupDateTime' => 'required'
		],
            ['RouteFrom.unique'    => 'This route already exist']

        );
            $requestData = $request->all();
            if(ucfirst($request->RouteFrom) == ucfirst($request->RouteTo)){
                $requestData['RouteName'] = 'Within '.$request->RouteTo;
            }
            else{
                $requestData['RouteName'] = $request->RouteFrom." to ".$request->RouteTo;
            }
//            $requestData['Distance'] = $request->Distance;
//            $requestData['Distance'] = $request->Distance.' km';
//            $requestData['DrivingTime'] = str_replace(":"," hr ",$request->DrivingTime).' min';
//            return $requestData;
            TransportRoute::create($requestData);
            return redirect('transportRoute/transport-route')->with('flash_message', 'TransportRoute added!');
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $transportroute = TransportRoute::findOrFail($id);
            return view('transportRoute.transport-route.show', compact('transportroute'));
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $transportroute = TransportRoute::findOrFail($id);
            return view('transportRoute.transport-route.edit', compact('transportroute'));
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
//            'RouteFrom'   => 'required|unique:transportation_routes,RouteFrom,Null,RouteID,RouteTo,'.$request->RouteTo,
			'RouteFrom' => 'required',
			'RouteTo' => 'required',
			'Distance' => 'required',
			'DrivingTime' => 'required',
//			'PickupDateTime' => 'required'
		],
            ['RouteFrom.unique'    => 'This route already exist']

        );
            $requestData = $request->all();
            if(ucfirst($request->RouteFrom) == ucfirst($request->RouteTo)){
                $requestData['RouteName'] = 'Within '.$request->RouteTo;
            }
            else{
                $requestData['RouteName'] = $request->RouteFrom." to ".$request->RouteTo;
            }
//            $requestData['Distance'] = $request->Distance;
//            $requestData['DrivingTime'] = $request->DrivingTime;
            $transportroute = TransportRoute::findOrFail($id);
            $transportroute->update($requestData);
            return redirect('transportRoute/transport-route')->with('flash_message', 'TransportRoute updated!');
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
        $model = str_slug('transportroute','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TransportRoute::destroy($id);

            return redirect('transportRoute/transport-route')->with('flash_message', 'TransportRoute deleted!');
        }
        return response(view('403'), 403);

    }
}
