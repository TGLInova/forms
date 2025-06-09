<div>
    <x-mary-steps wire:model="passo" steps-color="step-primary" stepper-classes="w-full mb-12">
        <x-mary-step text="" :step="1" class="space-y-4">
            <x-mary-input type="text" required label='Nome' wire:model="dados.nome" />
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-8">
                <x-mary-input type="tel" required label='Celular' x-mask="(99) 99999-9999" maxlength="15"
                    wire:model="dados.celular" />
                <x-mary-input type="tel" label='Telefone' x-mask="(99) 9999-9999" maxlength="15"
                    wire:model="dados.telefone" />
            </div>
            <x-mary-input type="email" required label='E-mail' wire:model="dados.email" name="dados.email" />
        </x-mary-step>
        <x-mary-step text="" :step="2" class="space-y-4">

            <x-mary-input type="text" label="CPF" required wire:model="dados.cpf" name="dados.cpf"
                x-mask="999.999.999-99" maxlength="14" />

            <x-mary-input required type="date" label="Qual é a sua Data de Nascimento?"
                wire:model="dados.data_nascimento" />

            <x-mary-group label="Qual seu Estado Civil?" wire:model="dados.estado_civil" option-value="value"
                option-label="label" :options="TglInova\Forms\Enums\EstadoCivil::getLabels()" />


            <x-mary-input maxlength="25" required wire:model="dados.profissao" label="Qual é a sua Profissão?" />
        </x-mary-step>
        <x-mary-step text="" :step="3" class="space-y-4">

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


            <x-mary-group wire:model="dados.proprio_ou_alugado" label="O Imóvel é Próprio ou Alugado?"
                :options="collect(['Propóprio', 'Alugado'])->map(fn($value) => ['id' => $value, 'name' => $value])" />

            <x-mary-group wire:model="dados.habitual_ou_veraneio" label="Moradia Habitual ou Veraneio?"
                :options="collect(['Habitual', 'Veraneio'])->map(fn($value) => ['id' => $value, 'name' => $value])" />

            <x-mary-input money wire:model="dados.valor_imovel" label="Valor do Imóvel"  prefix="R$" locale="pt-BR" />
        </x-mary-step>
        <x-mary-step text="" :step="4" :crsf="false" class="space-y-4">

            <x-mary-toggle wire:model.live="dados.tem_atividade_comercial">
                <x-slot:label>
                    Existe atividade comercial dentro do imóvel?
                </x-slot:label>
            </x-mary-toggle>

            <div x-show="$wire.get('dados.tem_atividade_comercial')">
                <x-mary-input wire:model="dados.atividade_comercial_descricao" label="Informe as atividades profissionais" />
            </div>

            <x-mary-toggle wire:model="dados.tem_escritorio">
                <x-slot:label>
                    Possui escritório na residência?
                </x-slot:label>
            </x-mary-toggle>

            <x-mary-toggle wire:model="dados.tem_sistema_protecao">
                <x-slot:label>
                    Possui algum sistema de segurança/proteção?
                </x-slot:label>
            </x-mary-toggle>
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
