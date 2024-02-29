<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technologies;

class Technology extends Controller
{
    public function index()
    {
        $technologies = Technology::all();
        return response()->json($technologies);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:technologies,name',
            // altre regole di validazione
        ]);

        $technology = Technology::create($request->all());
        return response()->json($technology, 201);
    }
}
