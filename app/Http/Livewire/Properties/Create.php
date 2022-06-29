<?php

namespace App\Http\Livewire\Properties;

use Livewire\Component;

use Livewire\WithFileUploads;
use App\Models\Property;

class Create extends Component{
    use WithFileUploads;

    public $image;
    public $description;
    public $address;
    public $price;
    public $bedrooms;
    public $bathrooms;
    public $area;


    protected $rules=[
        'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description'=>'nullable|string|max:255',
        'address'=>'required',
        'price'=>'required|numeric',
        'bedrooms'=>'required|numeric',
        'bathrooms'=>'required|numeric',
        'area'=>'required',
    ];

    protected $messages=[
        'image.required'=>'Debe seleccionar una imagen',
        'image.image'=>'Debe seleccionar una imagen',
        'image.mimes'=>'Debe seleccionar una imagen',
        'image.max'=>'Debe seleccionar una imagen',
        // 'description.required'=>'Debe ingresar una descripción',
        'address.required'=>'Debe ingresar una dirección',
        'price.required'=>'Debe ingresar un valor',
        'price.numeric'=>'Debe ingresar un valor',
        'bedrooms.required'=>'Debe ingresar un número de habitaciones',
        'bedrooms.numeric'=>'Debe ingresar un número de habitaciones',
        'bathrooms.required'=>'Debe ingresar un número de baños',
        'bathrooms.numeric'=>'Debe ingresar un número de baños',
        'area.required'=>'Debe ingresar una área',

    ];



    public function render()
    {
        return view('livewire.properties.create');
    }

    public function save(){
        $this->validate();

        $property = new Property();
        $property->image = $this->image->store('properties');
        $property->description = $this->description;
        $property->address = $this->address;
        $property->price = $this->price;
        $property->bedrooms = $this->bedrooms;
        $property->bathrooms = $this->bathrooms;
        $property->area = $this->area;
        $property->user_id=auth()->user()->id;
        $property->save();
       
        session()->flash('success', 'Propiedad creada correctamente');
        return redirect()->route('properties.index');
        
       
    }
}
