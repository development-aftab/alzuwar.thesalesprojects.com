<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Blog;
use Illuminate\Http\Request;
use Storage;
class BlogController extends Controller
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $blog = Blog::where('image', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('blog', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $blog = Blog::paginate($perPage);
            }

            return view('blog.blog.index', compact('blog'));
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('blog.blog.create');
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'image' => 'required',
			'title' => 'required',
			'blog' => 'required'
		]);
            $requestData = $request->all();
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }
            Blog::create($requestData);
            return redirect('blog/blog')->with('flash_message', 'Blog added!');
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $blog = Blog::findOrFail($id);
            return view('blog.blog.show', compact('blog'));
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $blog = Blog::findOrFail($id);
            return view('blog.blog.edit', compact('blog'));
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            if(!isset($request->image)){
                $requestData['image'] = $request->old_image;
            }else{
                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = Storage::disk('website')->put('image', $request->image??'');
                Storage::disk('website')->delete($request->old_image);
                $request['image'] = $imageName;
            }


            $this->validate($request, [
			// 'image' => 'required',
			'title' => 'required',
			'blog' => 'required'
		]);


            $requestData = $request->all();
            if($request->hasFile('image')) {
            try {
            $image = Storage::disk('website')->put('image', $request->image??'');
                $requestData['image'] = $image; 
            }catch (\Exception $e) {}//end try catch.
         }
            $blog = Blog::findOrFail($id);
             $blog->update($requestData);

             return redirect('blog/blog')->with('flash_message', 'Blog updated!');
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
        $model = str_slug('blog','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Blog::destroy($id);

            return redirect('blog/blog')->with('flash_message', 'Blog deleted!');
        }
        return response(view('403'), 403);

    }
}
