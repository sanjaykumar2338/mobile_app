<?php

namespace App\Http\Controllers;

use App\Product;
use App\City;
use App\Apartment;
use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index() {

        $sector = Sector::all();
        return view('admin.sector.index', compact('sector'));
    }

    public function create() {
        
        $city = City::all();
        $apartment = new Sector();

        return view('admin.sector.create', compact('city','apartment'));
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required',
           'city' => 'required'
        ]);

        // Save the data into database
        Sector::create([
            'name' => $request->name,
            'city' => $request->city
        ]);

        // Sessions Message
        $request->session()->flash('msg','Your sector has been added');

        // Redirect
        return redirect('admin/sector/create');
    }

    public function edit($id) {
        $sector = Sector::find($id);
        $city = City::all();
        //$sector = Sector::all();
        return view('admin.sector.edit', compact('sector','city'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $sector = sector::find($id);

        // Validate The form
        $request->validate([
            'city' => 'required',
            'name' => 'required'
        ]);
        
        // Updating the product
        $sector->update([
            'name' => $request->name,
            'city' => $request->city
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'sector has been updated');

        // Redirect
        return redirect('admin/sector');

    }

    public function show($id) {
        $category  = sector::find($id);
        return view('admin.sector.details', compact('category'));
    }

    public function destroy($id) {
        // Delete the product
        sector::destroy($id);

        // Store a message
        session()->flash('msg','sector has been deleted');

        // Redirect back
        return redirect('admin/sector');
    }
}
