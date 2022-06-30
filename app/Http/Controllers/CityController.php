<?php

namespace App\Http\Controllers;

use App\Product;
use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() {

        $city = City::all();

        return view('admin.city.index', compact('city'));
    }

    public function create() {
        $city = new City();
        return view('admin.city.create', compact('city'));
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required'
        ]);

        // Save the data into database
        City::create([
            'name' => $request->name
        ]);

        // Sessions Message
        $request->session()->flash('msg','Your city has been added');

        // Redirect
        return redirect('admin/city/create');
    }

    public function edit($id) {
        $city = City::find($id);
        return view('admin.city.edit', compact('city'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $city = City::find($id);

        // Validate The form
        $request->validate([
            'name' => 'required'
        ]);
        
        // Updating the product
        $city->update([
            'name' => $request->name
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'City has been updated');

        // Redirect
        return redirect('admin/city');

    }

    public function show($id) {
        $city = City::find($id);
        return view('admin.city.details', compact('city'));
    }

    public function destroy($id) {
        // Delete the product
        City::destroy($id);

        // Store a message
        session()->flash('msg','City has been deleted');

        // Redirect back
        return redirect('admin/city');
    }
}
