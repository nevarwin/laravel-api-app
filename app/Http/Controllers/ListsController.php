<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

// Laravel 11
// class ListsController extends Controller implements HasMiddleware {
class ListsController extends Controller {
    // Laravel 11
    // public function middleware() {
    //     return [new Middleware('auth:sanctum', except: ['index', 'show'])];
    // }

    public function __construct() {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }


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
        try {

            $fields = $request->validate([
                'title' => 'required|max:30',
                'body' => 'required'
            ]);

            $lists = $request->user()->lists()->create($fields);

            return ['Lists' => $lists];
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
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
        Gate::authorize('modify', $list);

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
        Gate::authorize('modify', $list);

        $list->delete();

        return [
            'message' => "List {$list->id} successfully deleted"
        ];
    }
}
