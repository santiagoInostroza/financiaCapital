<?php

namespace App\Http\Livewire\Properties;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Expr\AssignOp\ShiftLeft;

class Index extends Component{

    use WithPagination;
    
    public $search;
    public $numRows;
    public $columns;
    public $sortField;
    public $sortOrder;

    public function mount(){
        $this->search = '';
        $this->numRows = (session()->has('properties.numRows') ) ? session('properties.numRows') : 10;
        $this->columns = (session()->has('properties.columns') ) ? session('properties.columns') : [
            // 'id' => ['value' =>true, 'name' =>'Id', 'sortable' =>true], 
            'image' => ['value' =>true, 'name' =>'Imagen','type' =>'image'],
            'user_name' => ['value' =>true, 'name' =>'Solicitudes','type' =>'text'],
            'address' => ['value' =>true, 'name' =>'Dirección', 'sortable' =>true],
            'price' => ['value' =>true, 'name' =>'Valor', 'sortable' =>true, 'type' =>'money'],
            'description' => ['value' =>true, 'name' =>'Descripcion', 'sortable' =>true, 'type' =>'text'],
            'bedrooms' => ['value' =>true, 'name' =>'Dormitorios', 'sortable' =>true],
            'bathrooms' => ['value' =>true, 'name' =>'Baños', 'sortable' =>true],
            'garage' => ['value' =>true, 'name' =>'Estacionamientos', 'sortable' =>true],
            'area' => ['value' =>true, 'name' =>'Area', 'sortable' =>true],
            // 'user_id' => ['value' =>true, 'name' =>'Usuario'],
           
        //     'date' => ['value' =>true, 'name' =>'Fecha','type' =>'date'],
        //     'price' => ['value' =>true, 'name' =>'Precio','type' =>'money'],
        //     'active' => ['value' =>true, 'name' =>'Activo','type' =>'boolean'],
        //    'text' => ['value' =>true, 'name' =>'Texto','type' =>'text'],
            'accions' => ['value' =>true, 'name' =>'Acciones'],
        ];
        $this->sortField = (session()->has('properties.sortField') ) ? session('properties.sortField') : 'id';
        $this->sortOrder = (session()->has('properties.sortOrder') ) ? session('properties.sortOrder') : 'asc';
    }

    public function render(){
        $properties = Property::
        leftjoin('requests', 'requests.property_id', '=', 'properties.id')
        ->leftjoin('users', 'users.id', '=', 'requests.user_id')
        ->where('properties.user_id', auth()->id())
        ->where(function($data){
            $data-> orWhere('address', 'like', "%{$this->search}%")
            ->orWhere('description', 'like', "%{$this->search}%")
            ->orWhere('price', 'like', "%{$this->search}%");
        })
       
        ->select('properties.*', 'users.name as user_name', 'users.email as user_email', 'requests.status as request_status','requests.created_at as request_created_at','requests.message as request_message')
        ->orderBy($this->sortField, $this->sortOrder)
        ->paginate($this->numRows);
        return view('livewire.properties.index',compact('properties'));
    }


    public function selectColumns($value){
        switch ($value) {
            case 'all':
                foreach ($this->columns as $name_column => $column ) {
                    $this->columns[$name_column]['value'] = true;
                }
                break;
            case 'none':
                foreach ($this->columns as $name_column => $column ) {
                    $this->columns[$name_column]['value'] = false;
                }
                break;
            case 'switch':
                foreach ($this->columns as $name_column => $column ) {
                    $this->columns[$name_column]['value'] = !$this->columns[$name_column]['value'];
                }
                break;
            
            default:
                
                break;
        }
        session(['properties.columns' => $this->columns]);
    }
    
    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function updatedNumRows(){
        session([
            'properties.numRows' => $this->numRows
        ]);
    }
    
    public function updatedColumns(){
        session([
            'properties.columns' => $this->columns
        ]);
    }

    public function delete($id){
        $property = Property::find($id);
        $property->delete();
        $this->dispatchBrowserEvent('salert',[
            'title' =>  'La propiedad '. $property->id . ' ha sido eliminada correctamente',
            'type' => 'success',
            'position' => 'top',
            'toast' => true,
            'timer' => 2400,
        ]);
    }

    public function sortBy($column){
        $this->sortField = $column;
        $this->sortOrder = $this->sortOrder == 'asc' ? 'desc' : 'asc';
        session([
            'properties.sortOrder' => $this->sortOrder
        ]);
        session([
            'properties.sortField' => $this->sortField
        ]);
    }
    


}
