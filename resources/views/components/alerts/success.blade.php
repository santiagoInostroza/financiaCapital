<div x-data="{isOpenAlert:true}" class="shadow ">
    <div  x-show="isOpenAlert" class="flex items-center justify-between w-full p-4 font-bold text-white bg-green-500 animate-pulse">
        <div class="w-full animate-bounce">
            {{$slot}}
        </div>
        <div class="p-2 text-white cursor-pointer" x-on:click="isOpenAlert=false">
          
            <svg class="w-6 h-6 text-white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    </div>  
</div>