<fieldset class="grid lg:grid-cols-4 gap-6">
    <div>
        <x-mary-input x-on:change="$event.target.value && $js.pesquisarCep($event.target.value)" label="CEP"
            wire:model="dados.endereco_cep" x-mask="99.999-999" required />
    </div>
    <div class="lg:col-span-2">
        <x-mary-input wire:loading.attr="disabled" placeholder="Rua Exemplo" required type="text" label="Logradouro"
            name="dados.endereco_logradouro" wire:model="dados.endereco_logradouro" />
    </div>

    <x-mary-input wire:loading.attr="disabled" type="text" label="Nº" name="dados.endereco_numero"
        wire:model="dados.endereco_numero" />


    <x-mary-input wire:loading.attr="disabled" type="text" label="Complemento" name="dados.endereco_complemento"
        wire:model="dados.endereco_complemento" />

    <x-mary-input wire:loading.attr="disabled" type="text" label="Bairro" name="dados.endereco_bairro"
        wire:model="dados.endereco_bairro" required />

    <x-mary-input wire:loading.attr="disabled" type="text" label="Cidade" name="dados.endereco_cidade"
        wire:model="dados.endereco_cidade" />

    <x-mary-input wire:loading.attr="disabled" type="text" label="Estado" name="dados.endereco_uf"
        wire:model="dados.endereco_uf" />
</fieldset>

@script
    <script>
        $js('pesquisarCep', async (value) => {

            const cep = value.replace(/\D+/g, '');

            const response = await fetch(`https://viacep.com.br/ws/${cep}/json`);
            const result = await response.json()

            $wire.set('dados.endereco_logradouro', result.logradouro)
            $wire.set('dados.endereco_bairro', result.bairro);
            $wire.set('dados.endereco_cidade', result.localidade);
            $wire.set("dados.endereco_uf", result.uf);
        })
    </script>
@endscript
