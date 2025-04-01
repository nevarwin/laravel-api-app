<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Http\Requests\StoreListsRequest;
use App\Http\Requests\UpdateListsRequest;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListsRequest $request, Lists $lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lists $lists)
    {
        //
    }
}
