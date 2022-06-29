<?php

namespace App\Http\Livewire\Properties;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Edit extends Component{
    use WithFileUploads;

    public $property;

    public $image;
    public $description;
    public $address;
    public $price;
    public $bedrooms;
    public $bathrooms;
    public $area;

    protected $rules=[
        'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'property.description'=>'nullable|string|max:255',
        'property.address'=>'required',
        'property.price'=>'required|numeric',
        'property.bedrooms'=>'required|numeric',
        'property.bathrooms'=>'required|numeric',
        'property.area'=>'required',
    ];

    public function render(){
        return view('livewire.properties.edit');
    }

    public function update(){

        $this->validate();
        
        if ($this->image) {
            Storage::delete($this->property->image);
            $url = $this->image->store('properties');
            $this->property->image->url = $url;  
        }    
        $this->property->save();

        session()->flash('success', 'Propiedad actualizada correctamente');
        redirect()->route('properties.edit', $this->property);  
    }


}
