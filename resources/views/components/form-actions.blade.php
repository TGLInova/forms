<div class="mt-5 flex justify-between">
    <x-mary-button wire:click="passoAnterior" x-bind:disabled="$wire.get('passo') == 1" label="Voltar" />
    <x-mary-button class="btn-primary" wire:click="proximoPasso">
        <x-slot:label>
            <span x-show="$wire.get('passo') < $wire.get('ultimoPasso')">Avançar</span>
            <span x-show="$wire.get('passo') == $wire.get('ultimoPasso')">Concluir</span>
        </x-slot:label>
    </x-mary-button>
</div>
