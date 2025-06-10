<div>
    <x-mary-steps wire:model="passo" steps-color="step-primary" stepper-classes="w-full mb-12">
        <x-mary-step text="" :step="1" class="space-y-6">
            <x-mary-input maxlength="100" required wire:model="dados.nome" name="dados.nome" type="text"
                placeholder="Nome Completo" />

            <x-mary-input type="tel" placeholder="CPF" wire:model="dados.cpf" name="dados.cpf"
                x-mask="999.999.999-99" />

            <div class="grid lg:grid-cols-2 lg:gap-8">
                <x-mary-input type="tel" required placeholder='Celular' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.celular" name="dados.celular" icon="heroicon.o-device-phone-mobile">

                </x-mary-input>
                <x-mary-input type="tel" placeholder='Telefone' x-mask="(99) 9999-9999" maxlength="15"
                    wire:model="dados.telefone" name="dados.telefone" icon="heroicon.o-phone" />
            </div>

            <x-mary-input type="email" required placeholder='E-mail' wire:model="dados.email" name="dados.email"
                icon="heroicon.o-envelope" />

        </x-mary-step>

        <x-mary-step text="" :step="2" class="space-y-6" wire:submit.prevent="toStep3()">

            <x-mary-input required type="date" label="Qual é a sua Data de Nascimento?"
                wire:model="dados.data_nascimento" name="dados.data_nascimento" icon="heroicon.o-calendar" />

            <x-mary-group label="Qual seu Estado Civil?" wire:model="dados.estado_civil" option-value="value" option-label="label"
                :options="TglInova\Forms\Enums\EstadoCivil::getLabels()" />


            <x-mary-input maxlength="25" required wire:model="dados.profissao" label="Qual é a sua Profissão?" />

        </x-mary-step>

        <x-mary-step text="" :step="3" class="space-y-6" wire:submit.prevent="toStep4()">

            <x-tglinova-forms::address />

            <x-mary-input label="Condutor Principal do Veículo (quem dirige 85% do tempo)?"
                name="dados.main_vehicle_driver" wire:model="dados.main_vehicle_driver" />
        </x-mary-step>

        <x-mary-step text="" :step="4" class="space-y-6" >

            <x-mary-toggle name="dados.work_garage" wire:model="dados.garagem_trabalho"
                label="Garagem para o veículo no trabalho?" />

            <x-mary-toggle name="dados.garagem_residencial" wire:model.live="dados.garagem_residencial"
                label="Garagem para o veículo na residência?" />

            <template x-if="$wire.get('dados.garagem_residencial')">
                <div>

                    <x-mary-group class="checked:!btn-primary" option-value="id" option-label="name"
                        :options="[['id' => 'C', 'name' => 'Casa'], ['id' => 'A', 'name' => 'Apartamento']]" wire:model="dados.casa_ou_apartamento" label="Casa ou Apartamento?"
                        name="dados.casa_ou_apartamento" />
                </div>
            </template>

            <x-mary-toggle name="dados.garagem_faculdade" wire:model="dados.garagem_faculdade"
                label="Garagem para o veículo na faculdade?" />

            <x-mary-toggle wire:model="dados.viaja_com_veiculo" name="dados.viaja_com_veiculo"
                label=" Viaja com o veículo?" />

            <x-mary-toggle wire:model="dados.condutores_menores_26_anos"
                label="Existem condutores menores de 26 anos para o veículo?" />

            <x-mary-toggle wire:model="dados.teve_sinistro" name="dados.teve_sinistro" label="Teve sinistro?" />
            <x-mary-toggle wire:model="dados.veiculo_financiado" name="dados.veiculo_financiado"
                label="O veículo é financiado?" />

        </x-mary-step>

        <x-mary-step text="" :step="5" wire:submit.prevent="toStep6" class="space-y-6">

            <x-mary-group wire:model.live="dados.usar_anexo" label="Como Deseja Enviar as Informações do Veículo?"
                :options="[['id' => 1, 'name' => 'Enviar Anexo'], ['id' => 0, 'name' => 'Preencher Dados']]" />

            <template x-if="1 == $wire.get('dados.usar_anexo')">
                <div wire:key="upload">
                    <x-mary-file wire:model="arquivos.anexo" label="Anexo" accept="application/pdf,image/*" />

                </div>
            </template>
            <template x-if="0 == $wire.get('dados.usar_anexo')">
                <div class="grid lg:grid-cols-2 gap-8" wire:key="manual-form">
                    <x-mary-input required type="number" min="1990" max="{!! date('Y') !!}"
                        label="Ano fabricação" wire:model='dados.ano_fabricacao' />
                    <x-mary-input required type="number" min="1990" max="{!! date('Y') !!}"
                        label="Ano modelo" wire:model="dados.ano_modelo" />
                    <x-mary-input label="Modelo" wire:model="dados.modelo" />
                    <x-mary-input required label="Placa" wire:model="dados.placa" x-mask="aaa-9*99" />
                </div>
            </template>
        </x-mary-step>
    </x-mary-steps>

    <x-tglinova-forms::form-actions />
    <x-tglinova-forms::success-message wire:model="sucesso" />
</div>