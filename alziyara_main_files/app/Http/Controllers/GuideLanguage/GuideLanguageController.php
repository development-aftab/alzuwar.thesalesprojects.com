<?php

namespace App\Http\Controllers\GuideLanguage;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\GuideLanguage;
use Illuminate\Http\Request;

class GuideLanguageController extends Controller
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $guidelanguage = GuideLanguage::where('language_name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $guidelanguage = GuideLanguage::paginate($perPage);
            }

            return view('guideLanguage.guide-language.index', compact('guidelanguage'));
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('guideLanguage.guide-language.create');
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'language_name' => 'required'
		]);
            $requestData = $request->all();
            
            GuideLanguage::create($requestData);
            return redirect('guideLanguage/guide-language')->with('flash_message', 'GuideLanguage added!');
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $guidelanguage = GuideLanguage::findOrFail($id);
            return view('guideLanguage.guide-language.show', compact('guidelanguage'));
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $guidelanguage = GuideLanguage::findOrFail($id);
            return view('guideLanguage.guide-language.edit', compact('guidelanguage'));
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'language_name' => 'required'
		]);
            $requestData = $request->all();
            
            $guidelanguage = GuideLanguage::findOrFail($id);
             $guidelanguage->update($requestData);

             return redirect('guideLanguage/guide-language')->with('flash_message', 'GuideLanguage updated!');
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
        $model = str_slug('guidelanguage','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            GuideLanguage::destroy($id);

            return redirect('guideLanguage/guide-language')->with('flash_message', 'GuideLanguage deleted!');
        }
        return response(view('403'), 403);

    }
}
