<script setup>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue';

const props =  defineProps({
    airplanes: Number,
    destinies: Number,
    passengers: Number,
    flights: Number
})
</script>

<template>
    <main>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <div class="p-6 pb-20 bg-teal-700 border-b border-gray-200">
                        <div class="mt-3 text-2xl text-white"> Bem-vindo ao painel de administração </div>
                    </div>
                    <div class="flex justify-between relative -my-12 px-8 mb-8">
                        <div class="w-full mx-4 flex flex-col items-center gap-3 p-5 shadow-lg bg-gray-100 border-4 border-white rounded-lg"><span class="text-gray-400 text-sm">Destinos cadastrados</span><span class="text-3xl text-gray-500">{{props.destinies}}</span></div>
                        <div class="w-full mx-4 flex flex-col items-center gap-3 p-5 shadow-lg bg-gray-100 border-4 border-white rounded-lg"><span class="text-gray-400 text-sm">Aviões cadastrados</span><span class="text-3xl text-gray-500">{{props.airplanes}}</span></div>
                        <div class="w-full mx-4 flex flex-col items-center gap-3 p-5 shadow-lg bg-gray-100 border-4 border-white rounded-lg"><span class="text-gray-400 text-sm">Voos (mensal)</span><span class="text-3xl text-gray-500">{{props.flights}}</span></div>
                        <div class="w-full mx-4 flex flex-col items-center gap-3 p-5 shadow-lg bg-gray-100 border-4 border-white rounded-lg"><span class="text-gray-400 text-sm">Passageiros(mensal)</span><span class="text-3xl text-gray-500">{{props.passengers}}</span></div>
                    </div>
                   
                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Relatório</div>
                            </div>
                            <div class="ml-4">
                                <div class="mt-2 text-sm text-gray-500"> Confira o controle de ocupação de aeronaves, a capacidade de ocupação por voo e a quantidade de assentos ocupados por dia.</div>
                                <a href="#">
                                    <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                        <div>Visualizar relatório</div>
                                        <div class="ml-1 text-indigo-500"><svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
