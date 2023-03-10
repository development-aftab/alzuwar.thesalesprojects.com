<?php

namespace App\Http\Controllers\WithdrawRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\WithdrawRequest;
use Illuminate\Http\Request;
use Auth;

class WithdrawRequestController extends Controller
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $withdrawrequest = WithdrawRequest::with('getVendorDetail')->where('vendor_id', 'LIKE', "%$keyword%")
                ->orWhere('category', 'LIKE', "%$keyword%")
                ->orWhere('requested_amount', 'LIKE', "%$keyword%")
                ->orWhere('is_request_accepted', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                if(Auth::user()->hasRole('SuperAdmin')){
                    $withdrawrequest = WithdrawRequest::orderBy('updated_at', 'DESC')->paginate($perPage);
                }
                else{
                    $withdrawrequest = WithdrawRequest::orderBy('updated_at', 'DESC')->with('getVendorDetail')->where('vendor_id', Auth::id())->paginate($perPage);
                }
            }
            return view('withdrawRequest.withdraw-request.index', compact('withdrawrequest'));
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('withdrawRequest.withdraw-request.create');
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'vendor_id' => 'required',
			'category' => 'required',
			'requested_amount' => 'required'
		]);
            $requestData = $request->all();
            
            WithdrawRequest::create($requestData);
            return redirect('withdrawRequest/withdraw-request')->with('flash_message', 'WithdrawRequest added!');
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $withdrawrequest = WithdrawRequest::findOrFail($id);
            return view('withdrawRequest.withdraw-request.show', compact('withdrawrequest'));
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $withdrawrequest = WithdrawRequest::findOrFail($id);
            return view('withdrawRequest.withdraw-request.edit', compact('withdrawrequest'));
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'vendor_id' => 'required',
			'category' => 'required',
			'requested_amount' => 'required'
		]);
            $requestData = $request->all();
            
            $withdrawrequest = WithdrawRequest::findOrFail($id);
             $withdrawrequest->update($requestData);

             return redirect('withdrawRequest/withdraw-request')->with('flash_message', 'WithdrawRequest updated!');
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
        $model = str_slug('withdrawrequest','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            WithdrawRequest::destroy($id);

            return redirect('withdrawRequest/withdraw-request')->with('flash_message', 'WithdrawRequest deleted!');
        }
        return response(view('403'), 403);

    }
}
