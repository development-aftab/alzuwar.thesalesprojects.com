<?php

namespace App\Http\Controllers\TransportType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\TransportType;
use Illuminate\Http\Request;

class TransportTypeController extends Controller
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $transporttype = TransportType::where('TransportationTypeID', 'LIKE', "%$keyword%")
                ->orWhere('NumOfSeats', 'LIKE', "%$keyword%")
                ->orWhere('TransportationTypeDesc', 'LIKE', "%$keyword%")
                ->orWhere('LuggageCapacity', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $transporttype = TransportType::paginate($perPage);
            }

            return view('transportType.transport-type.index', compact('transporttype'));
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('transportType.transport-type.create');
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'NumOfSeats' => 'required',
			'TransportationTypeDesc' => 'required',
			'LuggageCapacity' => 'required'
		]);
            $requestData = $request->all();
            
            TransportType::create($requestData);
            return redirect('transportType/transport-type')->with('flash_message', 'TransportType added!');
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $transporttype = TransportType::findOrFail($id);
            return view('transportType.transport-type.show', compact('transporttype'));
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $transporttype = TransportType::findOrFail($id);
            return view('transportType.transport-type.edit', compact('transporttype'));
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'NumOfSeats' => 'required',
			'TransportationTypeDesc' => 'required',
			'LuggageCapacity' => 'required'
		]);
            $requestData = $request->all();
            
            $transporttype = TransportType::findOrFail($id);
             $transporttype->update($requestData);

             return redirect('transportType/transport-type')->with('flash_message', 'TransportType updated!');
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
        $model = str_slug('transporttype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            TransportType::destroy($id);

            return redirect('transportType/transport-type')->with('flash_message', 'TransportType deleted!');
        }
        return response(view('403'), 403);

    }
}
