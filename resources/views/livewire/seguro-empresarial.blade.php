<div>
    <x-mary-steps wire:model="passo" steps-color="step-primary" stepper-classes="w-full mb-12">
        <x-mary-step text="" :step="1" class="space-y-4">
            <div class="grid">
                <x-mary-group data-label='Você é uma pessoa física ou jurídica?' :options="[['id' => 'F', 'name' => 'Pessoa Física'], ['id' => 'J', 'name' => 'Pessoa Jurídica']]"
                    wire:model="dados.tipo_pessoa" />
            </div>

            <x-mary-input maxlength="100" required wire:model="dados.nome" type="text">
                <x-slot:label>
                    <span x-text="$wire.get('dados.tipo_pessoa') == 'F' ? 'Nome Completo': 'Razão Social'"></span>
                </x-slot:label>
            </x-mary-input>

            <template x-if="$wire.get('dados.tipo_pessoa') == 'F'">
                <x-mary-input type="text" label="CPF" wire:model="dados.cpf" name="dados.cpf"
                    x-mask="999.999.999-99" wire:key="input-cpf" />
            </template>
            <template x-if="$wire.get('dados.tipo_pessoa') == 'J'">
                <x-mary-input type="text" label="CNPJ" wire:model="dados.cnpj" name="dados.cnpj"
                    x-mask="99.999.999.9999/99" wire:key="input-cnpj" />
            </template>

            <div class="grid grid-cols-2 gap-4">
                <x-mary-input type="tel" required label='Celular' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.celular" icon="heroicon.o-device-phone-mobile" />
                <x-mary-input type="tel" label='Telefone' icon="heroicon.o-phone" x-mask="(99) 9999-9999" maxlength="15"
                    wire:model="dados.telefone" />
            </div>

            <x-mary-input type="email" required label='E-mail' wire:model="dados.email" name="dados.email" icon="heroicon.o-envelope" />
        </x-mary-step>

        <x-mary-step text="" :step="2" theme="outlined" class="space-y-4">

            <x-mary-input required type="date" label="Qual é a sua Data de Nascimento?"
                wire:model="dados.data_nascimento" />

            <x-mary-group label="Qual seu Estado Civil?" wire:model="dados.estado_civil" option-value="value"
                option-label="label" :options="TglInova\Forms\Enums\EstadoCivil::getLabels()" />


            <x-mary-input maxlength="25" required wire:model="dados.profissao" label="Qual é a sua Profissão?" />
        </x-mary-step>

        <x-mary-step text="" :step="3" theme="outlined" class="space-y-8" wire:submit.prevent="toStep4()"
            wire:key="step-3">

            <x-tglinova-forms::address />

            <x-mary-group label="O Imóvel é Próprio ou Alugado?" wire:model="dados.imovel_proprio_ou_alugado"
                :options="collect(['Próprio', 'Alugado'])->map(
                    static fn($value) => ['id' => $value, 'name' => $value],
                )" />



            <div class="grid lg:grid-cols-2 gap-4">
                <x-mary-input locale="pt-BR" money required name="dados.valor_reconstrucao_incendio"
                    wire:model="dados.valor_reconstrucao_incendio"
                    label="Valor para reconstrução do imóvel em caso de Incêndio" prefix="R$" />

                <x-mary-input locale="pt-BR" money required name="dados.valor_conteudo_local"
                    wire:model="dados.valor_conteudo_local" label="Valor do conteúdo local" prefix="R$" />
            </div>


            <x-mary-toggle wire:model.live="dados.tem_atividade_local" label="Atividade Exercida No Local?" />
            <div x-show="$wire.get('dados.tem_atividade_local')">
                <x-mary-input required type="text" label="Qual é a atividade?"
                    wire:model="dados.descricao_atividade_local" />
            </div>
        </x-mary-step>
    </x-mary-steps>


    <x-tglinova-forms::form-actions />
    <x-tglinova-forms::success-message wire:model="sucesso" />

</div>
