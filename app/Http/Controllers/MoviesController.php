<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movies;
class MoviesController extends Controller
{
    public function movieGenre() {
        return [
            'horror',
            'thriller',
            'suspense',
            'drama'
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movies::all();
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
       $product = Movies::where('id', $request->id)
       ->first();

       return view('pages.rent-movie', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
