<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    


    public function index()
{
    $userId = Auth::id(); 
    $cards = Card::with('offre.images')
                 ->where('user_id', $userId)
                 ->get();
    return view('cards', compact('cards'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'offre_id' => 'required|exists:offres,id',
            'user_id' => 'required|exists:users,id',
        ]);
    
        // Create a new Card instance
        $card = new Card;
        $card->offre_id = $request->offre_id;
        $card->user_id = $request->user_id;
        $card->save();
    
        // Redirect to User index
        return redirect()->route('User.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        Card::destroy($id);
        return redirect()->route('cards.index');
    }
}
