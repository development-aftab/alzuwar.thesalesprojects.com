<?php

namespace App\Http\Controllers\PropertyFavorite;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PropertyFavorite;
use Illuminate\Http\Request;

class PropertyFavoriteController extends Controller
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $propertyfavorite = PropertyFavorite::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('property_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $propertyfavorite = PropertyFavorite::paginate($perPage);
            }

            return view('propertyFavorite.property-favorite.index', compact('propertyfavorite'));
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('propertyFavorite.property-favorite.create');
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'user_id' => 'required',
			'property_id' => 'required'
		]);
            $requestData = $request->all();
            
            PropertyFavorite::create($requestData);
            return redirect('propertyFavorite/property-favorite')->with('flash_message', 'PropertyFavorite added!');
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $propertyfavorite = PropertyFavorite::findOrFail($id);
            return view('propertyFavorite.property-favorite.show', compact('propertyfavorite'));
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $propertyfavorite = PropertyFavorite::findOrFail($id);
            return view('propertyFavorite.property-favorite.edit', compact('propertyfavorite'));
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'user_id' => 'required',
			'property_id' => 'required'
		]);
            $requestData = $request->all();
            
            $propertyfavorite = PropertyFavorite::findOrFail($id);
             $propertyfavorite->update($requestData);

             return redirect('propertyFavorite/property-favorite')->with('flash_message', 'PropertyFavorite updated!');
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
        $model = str_slug('propertyfavorite','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            PropertyFavorite::destroy($id);

            return redirect('propertyFavorite/property-favorite')->with('flash_message', 'PropertyFavorite deleted!');
        }
        return response(view('403'), 403);

    }
}
