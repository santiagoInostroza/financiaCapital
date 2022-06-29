<div class="p-6 px-8 bg-white sm:px-20">
     {{-- HEADER --}}
     <div class='flex flex-wrap items-center justify-between gap-4 pb-4'>
        {{-- <h1 class='text-2xl'>Categorias <i wire:loading class='text-2xl fas fa-spinner animate-spin'></i> </h1> --}}
            <h1 class="my-12 text-5xl">
                Agregar Propiedad
            </h1>
            <a href="{{ route('properties.index') }}" >
                <x-jet-button>
                    Ir a lista de propiedades
                </x-jet-button>
            </a>

    </div> 

    <div class="pb-12">
    
                <div class="grid grid-cols-2 gap-4 row-gap-6 mb-4">
                  
               
                    <div
                        id='upload_image_{{$image}}'
                        x-data='{ isUploading: false, progress: 0 }'
                        x-on:livewire-upload-start='isUploading = true'
                        x-on:livewire-upload-finish='isUploading = false'
                        x-on:livewire-upload-error='isUploading = false'
                        x-on:livewire-upload-progress='progress = $event.detail.progress'
                        class='w-full'>
                        @if ($image)
                            <label class="cursor-pointer">
                                <div class='py-1'>Cambiar imagen</div>
                                <img class="object-cover w-full h-48 border-2 border-green-400 rounded shadow-lg 2xl:h-96" src='{{ $image->temporaryUrl() }}'>
                                <x-jet-input wire:model="image" class='hidden' type="file"></x-jet-input>
                            </label>
                        @else
                            <label class='cursor-pointer'>
                                <div class='py-3'>Agregar imagen</div>
                                <img class="object-contain w-full h-48 border-2 border-green-400 rounded shadow-lg 2xl:h-96" src="//www.webempresa.com/foro/wp-content/uploads/wpforo/attachments/3200/318277=80538-Sin_imagen_disponible.jpg">
                                <x-jet-input wire:model="image" class='hidden' type="file"></x-jet-input>
                            </label>
                        @endif
                        <!-- Progress Bar -->
                        <div x-cloak x-show='isUploading' class='w-full'>
                            <progress max='200' x-bind:value='progress' class='w-full'></progress>
                        </div>
                        
                        @error('image')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                    </div>
                        
                 
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-3">
                            <x-jet-input class="block w-full" type="text" wire:model.defer="address" placeholder="Dirección de la propiedad" />
                            @error('address')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                        </div>
                        <textarea class="col-span-3 border border-gray-300 rounded"  wire:model.defer="description" placeholder="Descripción de la propiedad"> </textarea>
                        @error('description')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                        <div class="col-span-3">
                            <x-jet-input class="block w-full" type="text" wire:model.defer="price" placeholder="Precio de la propiedad (valor en UF)" />
                            @error('price')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                        </div>
                        <div class="col-span-1">
                            <x-jet-input class="block w-full" type="text" wire:model.defer="bedrooms" placeholder="Cuartos" />
                            @error('bedrooms')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                        </div>
                        <div class="col-span-1">
                            <x-jet-input class="block w-full" type="text" wire:model.defer="bathrooms" placeholder="Baños" />
                            @error('bathrooms')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                        </div>
                        <div class="col-span-1">
                            <x-jet-input class="block w-full" type="text" wire:model.defer="area" placeholder="Area" />
                            @error('area')<span class='p-1 text-sm text-red-500'>{{ $message }}</span>@enderror
                        </div>
                    </div>
                 
                   
                </div>
           
                <x-jet-button wire:loading.attr="disabled" wire:click="save">
                    Agregar Propiedad
                </x-jet-button>
           
    </div>

    

</div>
