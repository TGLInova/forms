<div>
    <x-mary-steps wire:model="passo" steps-color="step-primary" stepper-classes="w-full mb-12">
        <x-mary-step text="" :step="1" class="space-y-6">
            <x-mary-input maxlength="100" required wire:model="dados.razao_social" name="dados.razao_social" type="text"
                label="Razão Social" />

            <x-mary-input type="text" label="CNPJ" wire:model="dados.cnpj" name="dados.cnpj"
                x-mask="99.999.999/9999-99" />

            <div class="grid lg:grid-cols-2 gap-8">
                <x-mary-input type="tel" label='Celular' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.celular" name="dados.celular" />

                <x-mary-input type="tel" required label='Telefone' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.telefone" name="dados.telefone" />
            </div>

            <x-mary-input type="email" required label='E-mail' wire:model="dados.email" name="dados.email" />

        </x-mary-step>

        <x-mary-step text="" :step="2" class="space-y-6">
            <x-mary-toggle name="dados.constituido_legalmente" wire:model="dados.constituido_legalmente"
                label=" Constituído Legalmente?" />

            <x-mary-input wire:model='dados.representante' required label="Nome do Representante" />

            <fieldset class="grid lg:grid-cols-4 gap-6">
                <div>
                    <x-mary-input x-on:change="$event.target.value && $js.pesquisarCep($event.target.value)"
                        label="CEP" wire:model="dados.endereco_cep" x-mask="99.999-999" required />
                </div>
                <div class="lg:col-span-2">
                    <x-mary-input wire:loading.attr="disabled" placeholder="Rua Exemplo" required type="text"
                        label="Logradouro" name="dados.endereco_logradouro" wire:model="dados.endereco_logradouro" />
                </div>

                <x-mary-input wire:loading.attr="disabled" type="text" label="Nº" name="dados.endereco_numero"
                    wire:model="dados.endereco_numero" />


                <x-mary-input wire:loading.attr="disabled" type="text" label="Complemento"
                    name="dados.endereco_complemento" wire:model="dados.endereco_complemento" />

                <x-mary-input wire:loading.attr="disabled" type="text" label="Bairro" name="dados.endereco_bairro"
                    wire:model="dados.endereco_bairro" required />

                <x-mary-input wire:loading.attr="disabled" type="text" label="Cidade" name="dados.endereco_cidade"
                    wire:model="dados.endereco_cidade" />

                <x-mary-input wire:loading.attr="disabled" type="text" label="Estado" name="dados.endereco_uf"
                    wire:model="dados.endereco_uf" />
            </fieldset>

            <div class="grid lg:grid-cols-2 gap-6">
                <x-mary-input money name="dados.valor_imovel" wire:model="dados.valor_imovel" label="Valor do Imóvel" />
                <x-mary-input min="0" max="100" type="number" wire:model="dados.idade_imovel" label="Idade do Imóvel" />
            </div>

        </x-mary-step>

        <x-mary-step text="" :step="3" class="space-y-6">

            <x-mary-input type="number" min="0" max="99" name="dados.quantidade_elevadores"
                wire:model.number="dados.quantidade_elevadores" label="Qual é a quantidade de elevadores?" required />

            <x-mary-input type="number" min="0" max="99" name="dados.unidades_por_bloco"
                wire:model.number="dados.unidades_por_bloco" label='Quantas Unidades por Bloco?' required />

            <x-mary-input type="number" min="0" max="99" required wire:model.number="dados.quantidade_blocos"
                name="dados.quantidade_blocos" label="Quantos Blocos?" />

            <x-mary-group wire:model="dados.vertical" label="O condomínio é vertical ou horizontal?"
                :options="[['id' => 'Vertical', 'name' => 'Vertical'], ['id' => 'Horizontal', 'name' => 'Horizontal']]" />

            @php
                $tipoConstrucoes = collect(['Madeira', 'Concreto ou Alvenaria'])->map(
                    fn($value) => ['id' => $value, 'name' => $value],
                );
            @endphp

            <x-mary-group :options="$tipoConstrucoes" required wire:model="dados.tipo_construcao"
                label="O condomínio é vertical ou horizontal?" />

            <x-mary-toggle wire:model.boolean="dados.tem_sistema_protecao">
                <x-slot:label>
                    Possui algum sistema de segurança/proteção?
                </x-slot:label>
            </x-mary-toggle>

            <x-mary-toggle wire:model.boolean="dados.tem_cobertura_veiculos">
                <x-slot:label>
                    Cobertura Para Veículos Estacionados?
                </x-slot:label>
            </x-mary-toggle>

            <div x-show="$wire.dados.tem_cobertura_veiculos">
                <x-mary-input wire:model.number="dados.quantidade_vagas"
                    label="QUANTAS VAGAS?" type="number" />
            </div>
        </x-mary-step>
    </x-mary-steps>

    <x-tglinova-forms::form-actions />
    <x-tglinova-forms::success-message wire:model="sucesso" />
</div>

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
