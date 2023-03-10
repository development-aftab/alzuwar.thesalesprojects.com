<?php

namespace App\Http\Controllers\SPFAQ;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\SPFAQ;
use Illuminate\Http\Request;

class SPFAQController extends Controller
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $spfaq = SPFAQ::where('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $spfaq = SPFAQ::paginate($perPage);
            }

            return view('sPFAQ.s-p-f-a-q.index', compact('spfaq'));
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('sPFAQ.s-p-f-a-q.create');
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            SPFAQ::create($requestData);
            return redirect('sPFAQ/s-p-f-a-q')->with('flash_message', 'SPFAQ added!');
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $spfaq = SPFAQ::findOrFail($id);
            return view('sPFAQ.s-p-f-a-q.show', compact('spfaq'));
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $spfaq = SPFAQ::findOrFail($id);
            return view('sPFAQ.s-p-f-a-q.edit', compact('spfaq'));
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $spfaq = SPFAQ::findOrFail($id);
             $spfaq->update($requestData);

             return redirect('sPFAQ/s-p-f-a-q')->with('flash_message', 'SPFAQ updated!');
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
        $model = str_slug('spfaq','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            SPFAQ::destroy($id);

            return redirect('sPFAQ/s-p-f-a-q')->with('flash_message', 'SPFAQ deleted!');
        }
        return response(view('403'), 403);

    }
}
