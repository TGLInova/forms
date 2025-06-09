<div>
    <x-mary-steps wire:model="passo" steps-color="step-primary" stepper-classes="w-full mb-12">
        <x-mary-step text="" :step="1" theme="outlined" class="space-y-4">
            <x-mary-input required label="Nome Completo" wire:model="dados.nome" />
            <div class="grid lg:grid-cols-2 gap-4">
                <x-mary-input required icon="heroicon.o-envelope" type="email" label="E-mail" wire:model="dados.email"
                    name="dados.email" />
                <x-mary-input icon="heroicon.o-device-phone-mobile" required label="Celular" wire:model="dados.celular"
                    x-mask="(99) 99999-9999" type="tel" />
            </div>

            <div class="grid lg:grid-cols-2 gap-4">
                <x-mary-input required label="CPF" x-mask="999.999.999-99" wire:model="dados.cpf" name="dados.cpf"
                    type="tel" />

                <x-mary-input required label="Data de Nascimento" type="date" maxlength="10"
                    wire:model="dados.data_nascimento" name="dados.data_nascimento" />
            </div>


        </x-mary-step>

        <x-mary-step text="" :step="2" theme="outlined" class="space-y-4" wire:submit="toStep3()">

            <x-mary-input required label="Local de Partida" type="text" wire:model="dados.origem_viagem"
                name="dados.origem_viagem" />

            <x-mary-input required label="Local de Destino" type="text" wire:model="dados.destino_viagem"
                name="dados.destino_viagem" />

        </x-mary-step>

        <x-mary-step text="" :step="3" class="space-y-4">

            <div class="space-y-4" x-data="{ passageiros: $wire.entangle('dados.passageiros') }">
                @foreach ($dados['passageiros'] as $key => $item)
                    <div class="flex gap-4 items-end" wire:key="passageiro-{{ $key }}">
                        <div class="grow">
                            <x-mary-input label="Viajante" wire:model="dados.passageiros.{{ $key}}.nome" required />
                        </div>
                        <div class="flex-none w-32">
                            <x-mary-input
                                label="Idade"
                                wire:model="dados.passageiros.{{ $key}}.idade" required type="number" min="0"
                                max="100" />
                        </div>
                        <x-mary-button class="btn-circle btn-error btn-sm" icon="o-x-mark" wire:click="removerPassageiro({{$key}})" />
                    </div>
                @endforeach

                <x-mary-button class="btn-circle btn-primary" icon="o-plus" wire:click="adicionarPassageiro" />
            </div>
        </x-mary-step>
    </x-mary-steps>

    <x-tglinova-forms::form-actions />

    <x-tglinova-forms::success-message wire:model="sucesso" />
</div>
