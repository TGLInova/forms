<div>

    <x-mary-steps wire:model="passo" stepper-classes="w-full mb-12" steps-color="step-primary">
        <x-mary-step :step="1" text="" class="space-y-6">
            <x-mary-input name="dados.cnpj" wire:model="dados.cnpj"
                label="Digite o CNPJ da empresa para a qual será realizado o seguro saúde" x-mask="99.999.999/9999-99" />

            <div class="space-y-5" shadow>
                <strong>Escreva o nome e data de nascimento das pessoas que farão parte do seguro saúde</strong>
                @foreach ($dados['beneficiarios'] as $key => $item)
                    <div wire:key="holder-{{ $key }}" class="p-4 rounded border border-neutral-300 relative">
                        <div class="grid lg:grid-cols-3 gap-4">
                            <a wire:click="removerBeneficiario({{ $key }})"
                                class="absolute -top-3 -right-3 h-6 w-6 bg-neutral-100 block rounded-full text-neutral-700 p-1 cursor-pointer">
                                <x-icon name="heroicon-o-x-mark" />
                            </a>

                            <div class="lg:col-span-2">
                                <x-mary-input wire:model="dados.beneficiarios.{{ $key }}.nome"
                                    label="Nome do Titular" required />
                            </div>
                            <x-mary-input wire:model="dados.beneficiarios.{{ $key }}.data_nascimento"
                                label="Data de Nascimento" required placeholder="DD/MM/AAAA" x-mask="99/99/9999" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex">
                <x-mary-button type="button" wire:click="adicionarBeneficiario()" class="btn-primary btn-sm">
                    <x-icon name="heroicon-o-plus" class="h-4 w-4" />
                    <span>Adicionar Beneficiário</span>
                </x-mary-button>
            </div>

            @php
                $respostasPlanoSaude = collect([
                    'Tenho somente plano de saúde',
                    'Tenho somente seguro saúde',
                    'Tenho os dois',
                    'Não tenho plano ou seguro saúde',
                ])->map(fn($value) => ['id' => $value, 'name' => $value]);
            @endphp

            <x-mary-radio label="Já possui plano de saúde ou seguro saúde atualmente?"
                wire:model="dados.plano_saude_atual" :options="$respostasPlanoSaude" />

            <div x-show="$wire.get('dados.plano_saude_atual') != ultimaOpcao" x-data="{ ultimaOpcao: @js($respostasPlanoSaude->last()['id']) }">
                <x-mary-input wire:model="dados.insurance_plan_text"
                    label="Escreva aqui quais planos ou seguros você possui"
                    x-bind:required="$wire.get('dados.plano_saude_atual') != ultimaOpcao" />
            </div>


            <x-mary-button label='Avançar' class="btn-primary" wire:click="proximoPasso" />

        </x-mary-step>

        <x-mary-step :step="2" text="" class='space-y-6'>
            <fieldset x-data="{}">
                @php
                    $motivos = collect([
                        'Custo',
                        'Qualidade da rede de atendimento',
                        'Cobertura mais ampla',
                        'Outro',
                    ])->map(fn($value) => ['id' => $value, 'name' => $value]);
                @endphp

                <x-mary-radio label='Qual o principal motivo para buscar um seguro saúde ou mudança?'
                    wire:model="dados.motivo_troca_plano" :options="$motivos" />

                <template x-if="$wire.get('dados.motivo_troca_plano') === 'Outro'" class="flex gap-3">
                    <x-mary-input wire:model="dados.motivo_troca_plano_texto" label="Conte-nos qual é o motivo" />
                </template>
            </fieldset>

            <fieldset>
                @php
                    $preferencias = collect([
                        'Com coparticipação (mensalidade menor, mas paga conforme o uso)',
                        'Sem coparticipação (mensalidade maior, mas não paga conforme o uso)',
                        'Tanto Faz',
                    ])->map(fn($value) => ['id' => $value, 'name' => $value]);
                @endphp
                <x-mary-radio label="Prefere seguro saúde:" wire:model="dados.preferencia" :options="$preferencias" />
            </fieldset>

            <div>
                @php
                    $rede_coberturas = [['id' => 'R', 'name' => 'Regional'], ['id' => 'N', 'name' => 'Nacional']];
                @endphp
                <x-mary-group wire:model="dados.plano_amplitude" :options="$rede_coberturas"
                    label="Rede de cobertura desejada:" />
            </div>

            <x-mary-toggle wire:model="dados.reembolso_fora_rede" name="dados.use_refunds">
                <x-slot:label>
                    Tem interesse em reembolso para atendimento fora da rede? (mensalidade maior)
                </x-slot:label>
            </x-mary-toggle>

            <x-mary-toggle wire:model="dados.sirio_libanes" name="dados.sirio_libanes">
                <x-slot:label>
                    Gostaria de incluir Sírio Libanês e Einstein na rede de atendimento? (mensalidade maior)
                </x-slot:label>
            </x-mary-toggle>


            <x-mary-input
                label="Há outros hospitais, clínicas ou laboratórios que deseja incluir na rede? Quais? (indique o nome, cidade e estado)"
                wire:model="dados.additional_hospitals" placeholder="Sua resposta" />


            <div>{{ $errors->first() }}</div>

            <x-mary-button wire:click="proximoPasso()" label="Avançar" />
        </x-mary-step>
        <x-mary-step :step="3" text="" class="space-y-6">
            @php
                $opcoes = collect(['Nenhuma vez', '1 a 3 vezes', '4 a 6 vezes', 'Mais de 6 vezes', 'Não sei'])->map(
                    fn($value) => ['id' => $value, 'name' => $value],
                );
            @endphp
            <x-mary-group wire:model="dados.frequencia_uso_consulta" :options="$opcoes"
                label="Nos últimos 12 meses, quantas vezes as pessoas do grupo coberto pelo plano ou seguro utilizou
                    consultas médicas?" />


            <x-mary-group wire:model="dados.frequencia_uso_exames" :options="$opcoes"
                label="Nos últimos 12 meses, quantas vezes as pessoas do grupo coberto pelo plano ou seguro utilizou exames?" />


            <x-mary-group wire:model="dados.frequencia_uso_pronto_socorro" :options="$opcoes"
                label="Nos últimos 12 meses, quantas vezes as pessoas do grupo coberto pelo plano ou seguro utilizou pronto-socorro?" />

            <x-mary-group wire:model="dados.frequencia_uso_internacao" :options="$opcoes"
                label="Nos últimos 12 meses, quantas vezes as pessoas do grupo coberto pelo plano ou seguro utilizou internações?" />


            <x-mary-toggle wire:model="dados.doenca_cronica">
                <x-slot:label>
                    Alguém do grupo faz tratamento contínuo ou possui doenças crônicas?
                </x-slot:label>
            </x-mary-toggle>

            <div x-show="$wire.get('dados.doenca_cronica')">
                <x-mary-input ::required="$wire.get('dados.doenca_cronica')" wire:model="dados.doenca_cronica_texto"
                    label="Se respondeu sim na questão anterior, especifique quais são os tratamentos contínuos e/ou doenças crônicas" />
            </div>

            <x-mary-button label="Concluir" class="btn-primary" wire:click="proximoPasso" />
        </x-mary-step>
    </x-mary-steps>
    <x-tglinova-forms::success-message wire:model="sucesso" />
</div>
