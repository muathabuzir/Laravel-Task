<?php

namespace App\Http\Controllers;

use App\SavedResults;
use Illuminate\Http\Request;
use App\User;

class SavedResultsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $saved_results = auth()->user()->SavedResults;
        return view('SavedResults.index', ['saved_results' => $saved_results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $values = array_map('json_decode', $request['value']);
        $this->validate($request, [
            'checked' => 'required',
            'comment' => 'max:250'
        ]);


        foreach ($request['checked'] as $k => $v) {
            
            SavedResults::create(array_filter([
                'link' => (isset($values[$k]->link) ? $values[$k]->link : ''),
                'title' => (isset($values[$k]->title) ? $values[$k]->title : ''),
                'desc' => (isset($values[$k]->snippet) ? $values[$k]->snippet : ''),
                'comment' => (isset($request->comment[$k]) ? $request->comment[$k] : ''),
                'user_id' => auth()->user()->id
                            ], 'strlen'));
        }

        return redirect('/saved_results');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SavedResults  $savedResults
     * @return \Illuminate\Http\Response
     */
    public function show(SavedResults $savedResult, User $user) {
        abort_unless(auth()->user()->can('view', $savedResult), 403);
        return view('SavedResults.show', ['saved_result' => $savedResult]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SavedResults  $savedResults
     * @return \Illuminate\Http\Response
     */
    public function edit(SavedResults $savedResult) {
        abort_unless(auth()->user()->can('view', $savedResult), 403);
        return view('SavedResults.edit', ['saved_result' => $savedResult]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SavedResults  $savedResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SavedResults $savedResult) {

        abort_unless(auth()->user()->can('update', $savedResult), 403);

        $this->validate($request, [
            'comment' => 'max:250'
        ]);


        if ($savedResult->update(['comment' => $request->comment]))
            $request->session()->flash('success', 'Update was successful!');


        return view('SavedResults.edit', ['saved_result' => $savedResult]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SavedResults  $savedResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(SavedResults $savedResult) {
        abort_unless(auth()->user()->can('delete', $savedResult), 403);

        $savedResult->delete();

        return redirect('/saved_results');
    }

}
