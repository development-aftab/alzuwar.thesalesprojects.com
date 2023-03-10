<?php

namespace App\Http\Controllers\PackageDealType;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\PackageDealType;
use Illuminate\Http\Request;

class PackageDealTypeController extends Controller
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $packagedealtype = PackageDealType::where('package_deals_type_desc', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $packagedealtype = PackageDealType::paginate($perPage);
            }

            return view('packageDealType.package-deal-type.index', compact('packagedealtype'));
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('packageDealType.package-deal-type.create');
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            PackageDealType::create($requestData);
            return redirect('packageDealType/package-deal-type')->with('flash_message', 'PackageDealType added!');
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $packagedealtype = PackageDealType::findOrFail($id);
            return view('packageDealType.package-deal-type.show', compact('packagedealtype'));
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $packagedealtype = PackageDealType::findOrFail($id);
            return view('packageDealType.package-deal-type.edit', compact('packagedealtype'));
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $packagedealtype = PackageDealType::findOrFail($id);
             $packagedealtype->update($requestData);

             return redirect('packageDealType/package-deal-type')->with('flash_message', 'PackageDealType updated!');
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
        $model = str_slug('packagedealtype','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            PackageDealType::destroy($id);

            return redirect('packageDealType/package-deal-type')->with('flash_message', 'PackageDealType deleted!');
        }
        return response(view('403'), 403);

    }
}
