@props(['title' => 'Dados Enviados'])
<x-mary-modal {{ $attributes }} :title="$title">
    <p class="mt-4">Os seus dados foram enviados com sucesso!</p>
    <p>Em breve, você será atendido por nosso time de especialistas!</p>

    <x-slot:actions>
        <x-mary-button label="OK" class="btn-primary" x-on:click="open = false" />
    </x-slot:actions>
</x-mary-modal>
