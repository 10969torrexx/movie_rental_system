<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rents;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $rents = Rents::join('movies', 'rents.movie_id', 'movies.id')
        ->select(
            'movies.title', 
            'movies.rental_price', 
            'movies.type', 
            'rents.id',
            'rents.*'
        )
        ->where('rents.user_id',  Auth::user()->id)
        ->orderBy('rents.id', 'desc')
        ->get();

        return view('pages.rent-list', compact('rents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'movie_id' => $request->movie_id,
            'quantity' => $request->quantity,
            'total_price' => $request->totalPrice,
            'payment' => $request->payment,
            'change' => $request->change,
            'from' => Carbon::createFromFormat('F d, Y', $request->from),
            'until' => Carbon::createFromFormat('F d, Y', $request->until),
        ];
        
        Rents::create($data);

        return redirect(route('rentList'))->with('success', 'Product Succesfully Bought!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Request $request)
    {
        Rents::where('id', $request->id)->delete();

        return [
            'status' => 200,
            'message' => 'Purchase Deleted!'
        ];
    }
}
