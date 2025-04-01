<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use Illuminate\Http\Request;

class ListsController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
        return Lists::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
        $fields = $request->validate([
            'title' => 'required|max:30',
            'body' => 'required'
        ]);

        $lists = Lists::create($fields);

        return ['Lists' => $lists];
    }

    /**
     * Display the specified resource.
     */
    public function show(Lists $list) {
        //
        return $list;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lists $list) {
        //
        $fields = $request->validate([
            'title' => 'required|max:30',
            'body' => 'required'
        ]);

        $list->update($fields);

        return ['Lists' => $list, 'Message' => "List {$list->id} successfully updated"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lists $list) {
        //
        $list->delete();

        return [
            'message' => "List {$list->id} successfully deleted"
        ];
    }
}
