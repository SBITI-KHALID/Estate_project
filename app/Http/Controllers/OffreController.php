<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index(Request $request,string $view = null){
        $search_with_offers = $request->search_with_offers; // select of type of offres
        $search_with_maximum_price = $request->search_with_maximum_price; // maximum value of range price inserted by user
        $search_with_minimum_price = $request->search_with_minimum_price; // minimum value of range price inserted by user
        $Category = $request->Category; 
        $Location = $request->Location; 
        $hiddenValue = $request->input('hidden');
        $MaxPrice = Offre::max('Price'); // maximum value of range price in database
        $MinPrice = Offre::min('Price'); // minimum value of range price in database
        $Images = Image::all(); // geting the path of image of all offers
        // Query to filter offres based on search criteria
        $query = Offre::query();
        if ($Location && $Location != 'Location') {$query->where('Location', $Location);}
        if ($Category && $Category != '') { $query->where('Category', $Category);}
        if ($search_with_offers && $search_with_offers != 'all_offers') {$query->where('Type_Offre', $search_with_offers);}
        if ($search_with_minimum_price && $search_with_maximum_price) {$query->whereBetween('Price', [$search_with_minimum_price,$search_with_maximum_price]);}
        // Fetch filtered offres
        $Offres = $query->get();
        if(Auth::check()){
            switch ($view){
                case 'Admin':
                    if(isset(Auth::user()->permision) && Auth::user()->permision === "user"){
                        return redirect('/User');
                    }else{
                        return view('Admin', compact('Offres', 'MaxPrice', 'MinPrice', 'Images'));
                    }
                case 'User':
                    if (isset(Auth::user()->permision) && Auth::user()->permision === "admin"){
                        return redirect('/Admin');
                    }else{
                    return view('User', compact('Offres', 'MaxPrice', 'MinPrice', 'Images'));
                    }
                case 'Offres':
                    return view($hiddenValue ?? 'welcome', compact('Offres', 'MaxPrice', 'MinPrice', 'Images'));
                case 'Favorites':
                    return view('Favorites', compact('Offres', 'MaxPrice', 'MinPrice', 'Images'));
                case '':
                    if (isset(Auth::user()->permision) && Auth::user()->permision === "admin"){
                        return redirect('/Admin');
                    }else if (isset(Auth::user()->permision) && Auth::user()->permision === "user"){
                        return redirect('/User');
                    }
                    else{
                        return view('welcome', compact('Offres', 'MaxPrice', 'MinPrice', 'Images'));
                    }
           }
        }else{
            return view('welcome', compact('Offres', 'MaxPrice', 'MinPrice', 'Images'));
        }
    }

    public function create(){}

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'images.*' => 'required',
            'Proprietaire' => 'required',
            'tel' => 'required',
            'Location' => 'required',
            'Category' => 'required',
            'Price' => 'required',
            'Type_Offre' => 'required',
            'Descreption' => 'required',
        ]);
    
        // Create and save the Offre
        $offre = new Offre();
        $offre->Proprietaire = $request->Proprietaire;
        $offre->tel = $request->tel;
        $offre->Location = $request->Location;
        $offre->Category = $request->Category;
        $offre->Price = $request->Price;
        $offre->Type_Offre = $request->Type_Offre;
        $offre->Descreption = $request->Descreption;
        $offre->save();
    
        // Retrieve the ID of the last inserted Offre
        $lastOffreId = $offre->id;
    
        // Save the images with the last inserted Offre ID
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('multiple_image'), $imageName);
    
                // Save the file path and id_offer to the database
                Image::create([
                    'path' => 'multiple_image/' . $imageName,
                    'id_offer' => $lastOffreId,
                ]);
            }
        }
    
        return back();
    }
    
    


    public function show(string $id){
        $Offre = Offre::find($id); // the offer selected
        $Images = Image::where('id_offer','=', $Offre->id)->get(); // geting the path of image has the same id of offer selected
        return view("Details",compact('Images','Offre'));
    }

    public function destroy(string $id){
        Offre::destroy($id);
        return redirect()->route('Offres.index');
    }

    public function edit(){}
    public function update(Request $request,$id){
        $Offres = Offre::find($id);
        $Offres->update($request->all());
        return redirect()->route('Offres.index');
    }
}

