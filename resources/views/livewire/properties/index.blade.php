<div>
    <div class="p-6 px-8 bg-white sm:px-20">

           

            {{-- HEADER --}}
        <div class='flex flex-wrap items-center justify-between gap-4 pb-4'>
            {{-- <h1 class='text-2xl'>Categorias <i wire:loading class='text-2xl fas fa-spinner animate-spin'></i> </h1> --}}
                <h1 class="my-12 text-5xl">
                    Mis propiedades 
                </h1>
                <a href="{{ route('properties.create') }}" >
                    <x-jet-button>
                        Agregar propiedad
                    </x-jet-button>
                </a>
    
        </div> 

        @if ($properties->count() > 0)
            {{--FILTROS  --}}
            <div class='flex flex-wrap items-center justify-between pb-4 gap-x-4'>
                {{-- BUSCADOR --}}
                <label class='flex items-center justify-between flex-1 gap-x-4 md:mr-4'>
                    <x-jet-input wire:model.debounce.1s='search' class='w-full p-2 border' placeholder='Que deseas buscar?'></x-jet-input>
                    <i wire:loading class='fas fa-spinner animate-spin'></i>
                    <i wire:loading.remove class='fas fa-search'></i>
                </label>

                {{-- COLUMNAS --}}
                <div>
                    <div id='dropdown_num_col' x-data='{dropdown:false}' >
                        <div x-on:click='dropdown=true'>
                            <div class='p-2 bg-white border rounded shadow cursor-pointer select-none'>
                                columnas
                            </div>
                        </div>
                        <div x-show='dropdown' x-cloak x-transition x-on:click.away='dropdown=false'>
                            <div class='absolute z-10 bg-white rounded shadow'>
                                <ul class='grid gap-2 py-2'>
                                    <li class='grid grid-cols-1 cursor-pointer hover:bg-gray-100 px-4 py-0.5' wire:click="selectColumns('all')">
                                        Marcar todas
                                    </li>
                                    <li class='grid grid-cols-1 cursor-pointer hover:bg-gray-100 px-4 py-0.5' wire:click="selectColumns('none')">
                                        Desmarcar todas
                                    </li>
                                    <li class='grid grid-cols-1 cursor-pointer hover:bg-gray-100 px-4 py-0.5' wire:click="selectColumns('switch')">
                                        Alternar
                                    </li>
                                    <hr>
                                    @foreach ($columns as $key => $column)
                                        <li class='grid grid-cols-1 hover:bg-gray-100 px-4 py-0.5'>
                                            <label class='flex items-center'>
                                                <input type='checkbox' wire:model="columns.{{$key}}.value"  class='w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox'>
                                                <span class='ml-2'>{{$column['name']}}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- FILAS --}}
                <div id='dropdown_num_rows' x-data='{dropdown:false}' >
                    <div x-on:click='dropdown=true'>
                        <div class='p-2 bg-white border rounded shadow cursor-pointer select-none'>
                            mostrar {{$numRows}} filas
                        </div>
                    </div>
                    <div x-show='dropdown' x-cloak x-transition x-on:click.away='dropdown=false'>
                        <div class='absolute z-10 p-4 bg-white rounded shadow'>
                            <div class='flex flex-wrap gap-4'>
                                <div class='w-full'>
                                    <label class='flex items-center'>
                                        <input type='radio' name='num_rows' value='10' wire:model='numRows' class='w-4 h-4 text-indigo-600 form-radio'/>
                                        <span class='ml-2 text-sm'>10</span>
                                    </label>
                                </div>
                                <div class='w-full'>
                                    <label class='flex items-center'>
                                        <input type='radio' name='num_rows' value='25' wire:model='numRows' class='w-4 h-4 text-indigo-600 form-radio'/>
                                        <span class='ml-2 text-sm'>25</span>
                                    </label>
                                </div>
                                <div class='w-full'>
                                    <label class='flex items-center'>
                                        <input type='radio' name='num_rows' value='50' wire:model='numRows' class='w-4 h-4 text-indigo-600 form-radio'/>
                                        <span class='ml-2 text-sm'>50</span>
                                    </label>
                                </div>
                                <div class='w-full'>
                                    <label class='flex items-center'>
                                        <input type='radio' name='num_rows' value='100' wire:model='numRows' class='w-4 h-4 text-indigo-600 form-radio'/>
                                        <span class='ml-2 text-sm'>100</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LISTA --}}
       
            <x-tables.table>
                <x-slot name='thead'>
                    <x-tables.tr>
                        @foreach ($columns as $name_column => $column)
                            @if ($column['value'])
                                @if ($name_column == 'accions')
                                    <x-tables.th class='text-right'>
                                        {{$column['name']}}
                                    </x-tables.th>
                                @else
                                    <x-tables.td class='text-left'>
                                        @if ( !isset($column['sortable']) || (isset($column['sortable'])  && $column['sortable']  ) )
                                            <div wire:click="sortBy('{{$name_column}}')" class='flex items-center cursor-pointer gap-x-2'>
                                                {{ $column['name'] }} 
                                                @if ($sortField == $name_column)
                                                    @if ($sortOrder == 'asc')
                                                        <i class='fas fa-sort-up'></i>
                                                    @else
                                                        <i class='fas fa-sort-down'></i>
                                                    @endif
                                                @endif							
                                            </div>
                                        @else
                                            <div class='flex items-center gap-x-2'>
                                                {{ $column['name'] }} 
                                            </div>
                                        @endif
                                    </x-tables.td>
                                @endif
                            @endif
                        @endforeach
                    </x-tables.tr>
                </x-slot>
                <x-slot name='tbody'>
                    @foreach ($properties as $property)
                        <x-tables.tr>
                            @foreach ($columns as $name_column => $column)                
                                @if ($column['value'])
                                        @if ($name_column == 'address')
                                            <x-tables.td class='text-left'>
                                                {{ $property->address }}
                                            </x-tables.td>
                                            
                                        @elseif ($name_column == 'request')
                                            <x-tables.td class='text-left'>
                                               
                                                @if ($property->request != null  )
                                                    <div id='tooltip_text_{{$property->request}}_{{rand()}}' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                                        <div x-on:mouseover='tooltip=true' class="cursor-pointer">
                                                            <div class="flex items-center gap-2">
                                                                <span class="p-1 px-2 text-white bg-red-500 rounded-full ">1</span>
                                                                <span class="text-base font-bold"> {{ $property->user_name }}</span>
                                                            </div>
                                                            <div class="m-1">
                                                               ha solicitado ver esta propiedad
                                                            </div>
                                                        </div>
                                                        <div x-show='tooltip' x-cloak >
                                                            <div class='absolute p-4 bg-white rounded shadow'>
                                                                <div class="font-bold text-gray-400">
                                                                    {{ $property->user_email }}
                                                                </div>
                                                                <div>
                                                                   {{$property->request_message}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                @else
                                                    <span class="font-bold">Nadie ha solicitado ver esta propiedad</span>
                                                @endif
                                            </x-tables.td>                                    
                                        @elseif ( $name_column == 'accions')
                                            <x-tables.td>
                                                <div class='flex flex-wrap justify-end gap-x-2'>                                                  
                                                    <a href="{{ route('properties.edit', $property) }}" >
                                                        {{-- heroicon edit --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        
                                                    </a>
                                                    <div id='dropdown_delete_{{$property}}' x-data='{dropdown:false}' >
                                                   
                                                        <svg x-on:click='dropdown=true' xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                      
                                                        <div x-show='dropdown' x-cloak>
                                                            <x-modals.alert>
                                                                <x-slot name='header'>
                                                                    Eliminar Propiedad
                                                                </x-slot>
                                                                <x-slot name='body'>
                                                                    Seguro deseas eliminar la propiedad?
                                                                </x-slot>
                                                                <x-slot name='footer'>
                                                                    <div class="flex items-center justify-between">
                                                                        <x-jet-danger-button wire:click='delete({{$property->id}})'>
                                                                            Eliminar
                                                                        </x-jet-danger-button>
                                                                        <x-jet-button  x-on:click='dropdown=false'>
                                                                            Cancelar
                                                                        </x-jet-button>
                                                                    </div>
                                                                </x-slot>
                                                            </x-modals.alert>
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                            </x-tables.td>
                                        @else
                                            @if (isset($column['type']) && $column['type'] == 'date')
                                                <x-tables.td class='text-left'>
                                                    {{ Helper::date($property->$name_column)->format('d-m-Y') }}
                                                </x-tables.td>
                                                
                                            @elseif(isset($column['type']) && $column['type'] == 'money')
                                                <x-tables.td class='text-left'>
                                                UF {{ number_format($property->$name_column,0,',','.') }}
                                                </x-tables.td>
                                            @elseif(isset($column['type']) && $column['type'] == 'image')
                                                <x-tables.td class='text-left'>
                                                    @if (Storage::has($property->$name_column))
                                                        <img class="w-36" src="{{Storage::url($property->$name_column) }}" alt="{{$property->$name_column }}" srcset="">
                                                    @else
                                                        <img class="w-36" src="{{$property->$name_column }}" alt="{{$property->$name_column }}" srcset="">
                                                    @endif
                                                    
                                                </x-tables.td>
                                            @elseif(isset($column['type']) && $column['type'] == 'text')
                                                <x-tables.td class='text-left'>
                                                    <div id='tooltip_text_{{$property->id}}' x-data='{tooltip:false}' x-on:mouseleave='tooltip=false'>
                                                        <div x-on:mouseover='tooltip=true' class="cursor-pointer">
                                                            {{ Str::limit($property->$name_column,10) }}
                                                        </div>
                                                        <div x-show='tooltip' x-cloak >
                                                            <div class='absolute p-4 bg-white rounded shadow'>
                                                            {{ $property->$name_column }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-tables.td>
                                            @else
                                                <x-tables.td class='text-left'>
                                                    {{ $property->$name_column }}
                                                </x-tables.td>
                                            @endif
                                        @endif
                                @endif
                            @endforeach                    
                        </x-tables.tr>
                    @endforeach
                </x-slot>
            </x-tables.table>
        @else
            <div>
               En este lugar puedes agregar propiedades...
            </div>
        @endif

        {{-- PAGINACION --}}
        <div class='py-4'>
            {{ $properties->links() }}
        </div>




    </div>
    
</div>
