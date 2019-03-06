<?php

namespace App\Http\Controllers;

use App\IndexTopThreeColumn;
use Illuminate\Http\Request;
use App\Http\Requests\IndexTopThreeColumnRequest;

class IndexTopThreeColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $top3Cols = IndexTopThreeColumn::all();
        return request()->json(200, $top3Cols);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $top3Cols = IndexTopThreeColumn::create($request->all());
        if($top3Cols){
            $top3Cols = IndexTopThreeColumn::all();
            return request()->json(200, $top3Cols);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IndexTopThreeColumn  $indexTopThreeColumn
     * @return \Illuminate\Http\Response
     */
    public function show(IndexTopThreeColumn $indexTopThreeColumn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IndexTopThreeColumn  $indexTopThreeColumn
     * @return \Illuminate\Http\Response
     */
    public function edit(IndexTopThreeColumn $indexTopThreeColumn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IndexTopThreeColumn  $indexTopThreeColumn
     * @return \Illuminate\Http\Response
     */
    public function update(IndexTopThreeColumnRequest $request, IndexTopThreeColumn $indexTopThreeColumn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IndexTopThreeColumn  $indexTopThreeColumn
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndexTopThreeColumn $indexTopThreeColumn)
    {
        //
    }
}
