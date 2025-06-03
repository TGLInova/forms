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

        <x-mary-button class="btn-primary" label="Avançar" wire:click="proximoPasso" />
    </x-mary-step>

    <x-mary-step text="" :step="2" theme="outlined-var" class="space-y-6" wire:submit.prevent="toStep3()"
        wire:key="step-2">

        <x-mary-input required type="text" label="Qual é a sua Data de Nascimento?"
            wire:model="dados.data_nascimento" x-mask="99/99/9999" maxlength="10" name="dados.data_nascimento"
            icon="heroicon.o-calendar" />

        <div>
            <div class="font-bold text-sm">
                Qual seu Estado Civil?
            </div>

            <x-mary-group wire:model="dados.estado_civil" option-value="value" option-label="label" :options="TglInova\Forms\Enums\EstadoCivil::getLabels()" />
        </div>

        <x-mary-input maxlength="25" required wire:model="dados.profession" label="Qual é a sua Profissão?" />


        <x-mary-button class="btn-primary" label="Avançar" on-back-click="$set('step', 1)" />

    </x-mary-step>

    <x-mary-step text="" :step="3" theme="outlined-var" class="space-y-6" wire:submit.prevent="toStep4()"
        wire:key="step-3" wire:transition.opacity.duration.800ms>

        <div class="grid lg:grid-cols-4 gap-4">
            <div>
                <x-mary-input x-on:change="$event.target.value && $wire.onCepChange($event.target.value)" label="CEP"
                    wire:model="dados.cep" x-mask="99.999-999" />
            </div>
            <div class="lg:col-span-3">
                <x-mary-input wire:target="onCepChange" wire:loading.attr="disabled" placeholder="Rua Exemplo" required
                    type="text" label="Endereço Completo" name="dados.address" wire:model="dados.address" />
            </div>
        </div>

        <x-mary-input label="Condutor Principal do Veículo (quem dirige 85% do tempo)?" name="dados.main_vehicle_driver"
            wire:model="dados.main_vehicle_driver" />

        <x-mary-button class="btn-primary" label="Avançar" on-back-click="$set('step', 2)" />
    </x-mary-step>

    <x-mary-step text="" :step="4" class="grid space-y-6" wire:submit="toStep5" wire:key="step-4">

        <x-mary-toggle name="dados.work_garage" wire:model="dados.work_garage">
            Garagem para o veículo no trabalho?
        </x-mary-toggle>

        <x-mary-toggle name="dados.residence_garage" wire:model.live="dados.residence_garage">
            Garagem para o veículo na residência?
        </x-mary-toggle>

        @if (isset($form['residence_garage']) && $form['residence_garage'])
            <div>
                <div class="font-bold text-sm">Casa ou Apartamento?</div>
                @foreach (['C' => 'Casa', 'A' => 'Apartamento'] as $k => $v)
                    <x-radio :value="$k" label="Casa ou apartamento" wire:model="dados.house_or_apartment"
                        name="dados.house_or_apartment">{!! $v !!}</x-radio>
                @endforeach
            </div>
        @endif

        <x-mary-toggle name="dados.college_garage" wire:model="dados.college_garage">
            Garagem para o veículo na faculdade?
        </x-mary-toggle>

        <x-mary-toggle wire:model="dados.is_travel_car" name="dados.is_travel_car">
            Viaja com o veículo?
        </x-mary-toggle>

        <x-mary-toggle wire:model="dados.drivers_under_26_years_old">
            Existem condutores menores de 26 anos para o veículo?
        </x-mary-toggle>

        <x-mary-toggle wire:model="dados.have_accident" name="dados.have_accident">
            Teve sinistro?
        </x-mary-toggle>

        <x-mary-toggle wire:model="dados.funded" name="dados.funded">
            O veículo é financiado?
        </x-mary-toggle>

        <x-mary-button class="btn-primary" label="Avançar" on-back-click="$set('step', 3)" />

    </x-mary-step>

    <x-mary-step text="" :step="5" theme="outlined-var" wire:submit.prevent="toStep6"
        class="space-y-6" wire:key="step-5">

        <div>
            <strong class="text-sm block">Como Deseja Enviar as Informações do Veículo?</strong>
            <x-radio wire:model.live="useAttachement" name="useAttachement" :value="1">
                Anexar arquivo
            </x-radio>
            <x-radio wire:model.live="useAttachement" name="useAttachement" :value="0">
                Preencher os Dados
            </x-radio>
        </div>

        @if (false)
            <div wire:key="upload">
                {{-- <x-layout.upload-box title="Selecionar Anexo" name="file" wire:model="file" /> --}}
            </div>
        @else
            <div class="grid lg:grid-cols-2 gap-8" wire:key="manual-form">
                <x-mary-input required type="number" min="1990" max="{!! date('Y') !!}"
                    label="Ano fabricação" wire:model='dados.manufacture_year' name="dados.manufacture_year'" />
                <x-mary-input required type="number" min="1990" max="{!! date('Y') !!}"
                    label="Ano modelo" wire:model="dados.model_year" name="dados.model_year" />
                <x-mary-input label="Modelo" wire:model="dados.model" name="dados.model" />
                <x-mary-input required label="Placa" wire:model="dados.license_plate" x-mask="aaa-9*99"
                    name="dados.license_plate" />
            </div>
        @endif

        {{-- <x-mary-input label="Chassi" wire:model="dados.chassis" name="dados.chassis" /> --}}

        <x-mary-button class="btn-primary" label="Avançar" on-back-click="$set('step', 4)" />
    </x-mary-step>

</x-mary-steps>
