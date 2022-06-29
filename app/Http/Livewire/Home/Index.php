<?php

namespace App\Http\Livewire\Home;


use App\Models\Property;
use Livewire\Component;
use App\Http\Controllers\RequestController;


class Index extends Component{

      

    public function render(){
        return view('livewire.home.index', [
            'properties' => $this->getProperties(),
        ]);
    }

    public function getProperties(){
        return Property::all();
    }

    public function sendRequest($propertyId, $userId, $message){
        $requestController = new RequestController();
        $requestController->saveRequest($propertyId, $userId, $message);

        $this->dispatchBrowserEvent('salert',[
            'title' =>  'Se ha enviado su solicitud',
            'type' => 'success',
            'position' => 'top',
            'toast' => true,
            'timer' => 2400,
        ]);

    } 


}
