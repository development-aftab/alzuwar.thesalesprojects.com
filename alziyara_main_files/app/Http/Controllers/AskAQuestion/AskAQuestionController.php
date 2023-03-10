<?php

namespace App\Http\Controllers\AskAQuestion;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\AskAQuestion;
use Illuminate\Http\Request;

class AskAQuestionController extends Controller
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 250;

            if (!empty($keyword)) {
                $askaquestion = AskAQuestion::where('email', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orderBy('id','DESC')->paginate($perPage);
            } else {
                $askaquestion = AskAQuestion::orderBy('id','DESC')->paginate($perPage);
            }

            return view('askAQuestion.ask-a-question.index', compact('askaquestion'));
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('askAQuestion.ask-a-question.create');
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            AskAQuestion::create($requestData);
            return redirect('askAQuestion/ask-a-question')->with('flash_message', 'AskAQuestion added!');
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $askaquestion = AskAQuestion::findOrFail($id);
            return view('askAQuestion.ask-a-question.show', compact('askaquestion'));
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $askaquestion = AskAQuestion::findOrFail($id);
            return view('askAQuestion.ask-a-question.edit', compact('askaquestion'));
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $askaquestion = AskAQuestion::findOrFail($id);
             $askaquestion->update($requestData);

             return redirect('askAQuestion/ask-a-question')->with('flash_message', 'AskAQuestion updated!');
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
        $model = str_slug('askaquestion','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            AskAQuestion::destroy($id);

            return redirect('askAQuestion/ask-a-question')->with('flash_message', 'AskAQuestion deleted!');
        }
        return response(view('403'), 403);

    }
}
