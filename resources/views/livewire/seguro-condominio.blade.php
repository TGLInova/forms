<div>
    <x-mary-steps wire:model="passo" steps-color="step-primary" stepper-classes="w-full mb-12">
        <x-mary-step text="" :step="1" class="space-y-6" >
            <x-mary-input maxlength="100" required wire:model="dados.razao_social" name="dados.razao_social" type="text"
                label="Razão Social" />

            <x-mary-input type="text" label="CNPJ" wire:model="dados.cnpj" name="dados.cnpj"
                x-mask="99.999.999/9999-99" />

            <div class="grid lg:grid-cols-2 gap-8">
                <x-mary-input type="tel" required label='Telefone' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.telefone" name="dados.telefone" />
                <x-mary-input type="tel" label='Telefone 2' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.telefone_2" name="dados.telefone_2" />
            </div>

            <x-mary-input type="email" required label='E-mail' wire:model="dados.email" name="dados.email" />

        </x-mary-step>

        <x-mary-step text="" :step="2" class="space-y-6">
            <x-mary-toggle name="dados.constituido_legalmente" wire:model="dados.constituido_legalmente">
                Constituído Legalmente?
            </x-mary-toggle>

            <x-mary-input wire:model='dados.representante' required label="Nome do Representante" />

            <div class="grid grid-cols-4 gap-4">
                <div>
                    <x-mary-input x-on:change="$event.target.value && $wire.onCepChange($event.target.value)" label="CEP"
                        wire:model="dados.cep" name="dados.cep" required x-mask="99.999-999" />
                </div>
                <div class="lg:col-span-3">
                    <x-mary-input wire:loading.attr="disabled" wire:target="onCepChange" placeholder="Rua Exemplo" required
                        type="text" label="Endereço Completo" name="dados.endereco" wire:model="dados.endereco" />
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <x-mary-input money name="dados.valor_imovel" wire:model="dados.valor_imovel" label="Valor do Imóvel" />
                <x-mary-input min="0" max="100" type="number" name="dados.idade_imovel"
                    wire:model="dados.idade_imovel" label="Idade do Imóvel" />
            </div>

        </x-mary-step>

        <x-mary-step text="" :step="3" class="space-y-6">

            <x-mary-input type="number" min="0" max="99" name="dados.quantidade_elevadores"
                wire:model="dados.quantidade_elevadores" label="Qual é a quantidade de elevadores?" required />

            <x-mary-input type="number" min="0" max="99" name="dados.unidades_por_bloco"
                wire:model="dados.unidades_por_bloco" label='Quantas Unidades por Bloco?' required />

            <x-mary-input type="number" min="0" max="99" required wire:model="dados.quantidade_blocos"
                name="dados.quantidade_blocos" label="Quantos Blocos?" />

            <div>
                <div class="text-sm font-bold">O condomínio é vertical ou horizontal?</div>
                <x-radio required wire:model="dados.vertical" name="dados.vertical" value="1">Vertical</x-radio>
                <x-radio required wire:model="dados.vertical" name="dados.vertical" value="0">Horizontal</x-radio>
            </div>

            <div>
                <div class="text-sm font-bold">Tipo de Construção</div>
                @foreach (['M' => 'Madeira', 'C' => 'Concreto ou Alvenaria'] as $k => $v)
                    <x-radio required wire:model="dados.tipo_construcao"
                        :value="$k">{!! $v !!}</x-radio>
                @endforeach
            </div>

            <x-mary-toggle wire:model="dados.tem_sistema_protecao">
                Possui algum sistema de segurança/proteção?
            </x-mary-toggle>

            <x-mary-toggle wire:model="dados.tem_cobertura_veiculos">
                Cobertura Para Veículos Estacionados?
            </x-mary-toggle>

            <div x-show="$wire.dados.tem_cobertura_veiculos">
                <x-mary-input name="dados.quantidade_vagas" wire:model="dados.quantidade_vagas" label="QUANTAS VAGAS?" />
            </div>
        </x-mary-step>
    </x-mary-steps>

    <x-tglinova-forms::form-actions />
    <x-tglinova-forms::success-message wire:model="sucesso" />
</div>
