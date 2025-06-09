<x-layouts.base :title="$formulario->nome" :description="strip_tags($formulario->descricao)">
    <x-slot:head>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>
    </x-slot:head>
    <section class="grow flex flex-col justify-center px-12">
        <div class="max-w-7xl mx-auto">
            @include('tglinova_forms::form', ['formulario' => $formulario])
        </div>
    </section>
</x-layouts.base>
