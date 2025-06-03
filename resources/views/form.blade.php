 <x-mary-main full-width>
     <x-slot:content>
         <div class="grid lg:grid-cols-4 gap-8">
             <div>
                 <h2 class="text-2xl">{{ $formulario->nome }}</h2>
                 <div class="text-sm">{{ $formulario->descricao }}</div>
             </div>
             <div class="lg:col-span-3">
                 @livewire($formulario->componente, ['formulario' => $formulario])
             </div>
         </div>
     </x-slot:content>
 </x-mary-main>
