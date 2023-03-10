<?php

namespace App\Http\Controllers\GuideCity;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\GuideCity;
use Illuminate\Http\Request;

class GuideCityController extends Controller
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $guidecity = GuideCity::where('city_name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $guidecity = GuideCity::paginate($perPage);
            }

            return view('guideCity.guide-city.index', compact('guidecity'));
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('guideCity.guide-city.create');
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'city_name' => 'required'
		]);
            $requestData = $request->all();
            
            GuideCity::create($requestData);
            return redirect('guideCity/guide-city')->with('flash_message', 'GuideCity added!');
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $guidecity = GuideCity::findOrFail($id);
            return view('guideCity.guide-city.show', compact('guidecity'));
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $guidecity = GuideCity::findOrFail($id);
            return view('guideCity.guide-city.edit', compact('guidecity'));
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'city_name' => 'required'
		]);
            $requestData = $request->all();
            
            $guidecity = GuideCity::findOrFail($id);
             $guidecity->update($requestData);

             return redirect('guideCity/guide-city')->with('flash_message', 'GuideCity updated!');
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
        $model = str_slug('guidecity','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            GuideCity::destroy($id);

            return redirect('guideCity/guide-city')->with('flash_message', 'GuideCity deleted!');
        }
        return response(view('403'), 403);

    }
}
