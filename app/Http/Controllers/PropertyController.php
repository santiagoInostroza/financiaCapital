<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller{
    
    public function index(){
        return view('properties.index');
    }

    public function create(){
        return view('properties.create');
    }

    public function edit(Property $property){
        return view('properties.edit', compact('property'));
    }
    
}
