<div class="p-6 px-8 bg-white sm:px-20">

    <h1 class="my-12 text-5xl">
        Propiedades disponibles
    </h1>

    
    
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3 gap-y-16">
        @forelse ($properties as $property)
            <div class="border border-transparent rounded shadow hover:border-gray-200 md:w-96">
                @if (Storage::has($property->image))
                    <img class="md:w-96" src="{{ Storage::url($property->image) }}" alt=""> 
                @else
                    <img class="md:w-96" src="{{$property->image}}" alt="">
                @endif
                
                <div class="flex items-center justify-between grid-cols-2 gap-4 pt-4">
                    <div id="dropdown_rooms_{{$property->id}}" x-data="{isOpenDropdown:false}" class="flex items-center gap-2 text-sm" x-on:click.away="isOpenDropdown=false">
                        <div>
                            <div class="cursor-pointer" x-on:click="isOpenDropdown= !isOpenDropdown">
                                <span class="text-sm">{{$property->address}}</span>
                                <i x-show="!isOpenDropdown" x-cloak class="fas fa-chevron-down"></i>     
                                <i x-show="isOpenDropdown" x-cloak class="fas fa-chevron-up"></i>     
                            </div> 
                            <div x-show="isOpenDropdown" x-transition x-cloak>
                                {{$property->bathrooms}} baños
                                {{$property->bedrooms}} habitaciones
                                {{$property->area}} m2
                            </div>
                        </div>                         
                    </div>
                    <div class="p-3 border border-red-800">
                        <span class="text-gray-600">
                           UF {{number_format($property->price,0,',','.')}}
                        </span>
                    </div>
                
                </div>
                <div class="my-4 text-center">
                    {{-- button de agendamiento de visita --}}
                    @if (auth()->user()->id == $property->user_id)
                        Esta propiedad te pertenece.
                        <a href="{{route('properties.edit', $property->id)}}" class="underline btn btn-primary">Editar</a> 
                    @else
                        @if (!$property->requests->map(function($request) { return $request->user_id; })->contains(auth()->user()->id))
                            <div id="modal_{{$property->id}}" x-data="{isOpenModal:false, message:'Hola me interesa visitar esta propiedad...' }">
                                <x-jet-button x-on:click="isOpenModal=true">Solicitar visita</x-jet-button> 
                            
                                <div x-show="isOpenModal" x-cloak  >
                                    <div class="fixed inset-0 bg-gray-800 opacity-80"></div> 
                                    <div class="fixed inset-0 flex items-center justify-center ">
                                        <div class="flex flex-col gap-8 p-4 bg-white rounded-md shadow h-96">
                                            <div class="flex items-center justify-between gap-4 my-4">
                                                <span class="text-xl font-bold">Solicitud de visita</span>
                                                <svg x-on:click="isOpenModal=false" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </div>
                                            <textarea x-model="message" class="h-48 p-4" placeholder="Quiero visitar esta propiedad..."></textarea>
                                            <x-jet-button x-on:click="$wire.sendRequest({{$property->id}}, {{auth()->user()->id}}, message).then( ()=>{isOpenModal=false})">Enviar</x-jet-button>
                                        </div>
                                    </div> 
                                </div>                 
                            </div>
                        @else
                        <div class="flex items-center justify-around gap-2 px-4">
                            <i class="text-green-600 fas fa-check"></i>
                            <span>
                                ya has solicitado la visita de esta propiedad.
                                pronto se pondran en contacto contigo.
                            </span>
                        </div>
                           
                        @endif
                        
                        
                    
                    @endif
                </div>
            </div>            
        @empty
            
        @endforelse
    </div>

    {{-- <div class="flex justify-center">
        {{$properties->links()}}
    </div> --}}

    
   
</div>