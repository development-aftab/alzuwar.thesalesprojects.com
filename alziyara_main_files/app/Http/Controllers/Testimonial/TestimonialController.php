<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Testimonial;
use Illuminate\Http\Request;
use Storage;
class TestimonialController extends Controller
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $testimonial = Testimonial::where('description', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('rating', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $testimonial = Testimonial::paginate($perPage);
            }

            return view('testimonial.testimonial.index', compact('testimonial'));
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('testimonial.testimonial.create');
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }
            Testimonial::create($requestData);
            return redirect('testimonial/testimonial')->with('flash_message', 'Testimonial added!');
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $testimonial = Testimonial::findOrFail($id);
            return view('testimonial.testimonial.show', compact('testimonial'));
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $testimonial = Testimonial::findOrFail($id);
            return view('testimonial.testimonial.edit', compact('testimonial'));
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }
            $testimonial = Testimonial::findOrFail($id);
             $testimonial->update($requestData);

             return redirect('testimonial/testimonial')->with('flash_message', 'Testimonial updated!');
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
        $model = str_slug('testimonial','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Testimonial::destroy($id);

            return redirect('testimonial/testimonial')->with('flash_message', 'Testimonial deleted!');
        }
        return response(view('403'), 403);

    }
}
