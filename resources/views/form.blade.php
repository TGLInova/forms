<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
    <div class="flex flex-col justify-center space-y-4 dark:text-neutral-300 text-neutral-700">
        <x-tglinova-forms::logo />
        <h2 class="text-4xl font-bold mb-3">{{ $formulario->nome }}</h2>
        <div class="whitespace-pre-line">{{ $formulario->descricao }}</div>
    </div>
    <div class="lg:col-span-2" x-data="{}" x-cloak>
        @livewire($formulario->componente, ['formulario' => $formulario])
    </div>
</div>
