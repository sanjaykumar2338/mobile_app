<?php

namespace App\Http\Controllers;

use App\Product;
use App\Apartment;
use App\City;
use App\Sector;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index() {

        $apartment = Apartment::all();
        return view('admin.apartment.index', compact('apartment'));
    }

    public function create() {
        $apartment = new Apartment();
        $sector = Sector::all();
        $city = City::all();
        return view('admin.apartment.create', compact('apartment','city','sector'));
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required',
           'city' => 'required',
           'sector' => 'required'
        ]);

        // Save the data into database
        Apartment::create([
            'name' => $request->name,
            'city' => $request->city,
            'sector' => $request->sector
        ]);

        // Sessions Message
        $request->session()->flash('msg','Your apartment has been added');

        // Redirect
        return redirect('admin/apartment/create');
    }

    public function edit($id) {
        $apartment = Apartment::find($id);
        $city = City::all();
        return view('admin.apartment.edit', compact('apartment','city'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $apartment = apartment::find($id);

        // Validate The form
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'sector' => 'required'
        ]);
        
        // Updating the product
        $apartment->update([
            'name' => $request->name,
            'city' => $request->city,
            'sector' => $request->sector
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Apartment has been updated');

        // Redirect
        return redirect('admin/apartment');

    }

    public function show($id) {
        $apartment = Apartment::find($id);
        return view('admin.apartment.details', compact('apartment'));
    }

    public function get_sector(Request $request){
        $id = $request->id;
        $sector = Sector::where('city',$id)->get()->toArray();
        return response()->json(['sector' => $sector]);
    }

    public function destroy($id) {
        // Delete the product
        Apartment::destroy($id);

        // Store a message
        session()->flash('msg','Apartment has been deleted');

        // Redirect back
        return redirect('admin/apartment');
    }
}
