<?php

namespace App\Http\Controllers\ContactDetail;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailController extends Controller
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $contactdetail = ContactDetail::where('description', 'LIKE', "%$keyword%")
                ->orWhere('number', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $contactdetail = ContactDetail::paginate($perPage);
            }

            return view('contactDetail.contact-detail.index', compact('contactdetail'));
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('contactDetail.contact-detail.create');
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            ContactDetail::create($requestData);
            return redirect('contactDetail/contact-detail')->with('flash_message', 'ContactDetail added!');
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $contactdetail = ContactDetail::findOrFail($id);
            return view('contactDetail.contact-detail.show', compact('contactdetail'));
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $contactdetail = ContactDetail::findOrFail($id);
            return view('contactDetail.contact-detail.edit', compact('contactdetail'));
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $contactdetail = ContactDetail::findOrFail($id);
             $contactdetail->update($requestData);

             return redirect('contactDetail/contact-detail')->with('flash_message', 'ContactDetail updated!');
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
        $model = str_slug('contactdetail','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            ContactDetail::destroy($id);

            return redirect('contactDetail/contact-detail')->with('flash_message', 'ContactDetail deleted!');
        }
        return response(view('403'), 403);

    }
}
