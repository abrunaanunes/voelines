<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Jetstream/Welcome.vue';

    const props =  defineProps({
        items: Object,
    })
</script>

<template>
    <AppLayout title="Destinos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    Destinos
                </h2>
                <div>
                    <a :href="route('admin.destinos.create')" class="bg-teal-900 hover:bg-teal-600  text-white font-bold py-2 px-4 rounded">Novo destino</a>
                </div>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg" v-if="props.items.length > 0">
                                <table class="min-w-full divide-y divide-gray-200 w-full">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código aeroporto
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nome aeroporto
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Taxa de embarque
                                        </th>
                                        <th scope="col" width="200" class="px-6 py-3 bg-gray-50">
                                            
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(item, idx) in props.items" :key="idx">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ item.airport_cod }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ item.airport_name }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ formatMoney(item.shipping_fee) }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex flex-row gap-4">
                                                <a :href="route('admin.destinos.edit', item.id)" class="inline-flex items-center px-4 py-2 bg-gray-300 rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">EDITAR</a>
                                                <button type="button" @click.prevent="deleteConfirm(route('admin.destinos.destroy', item))" class="inline-flex items-center px-4 py-2 bg-red-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-400 active:bg-red-500 focus:outline-none focus:border-red-500 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                                                    DELETAR
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="p-5 bg-gray-200 text-gray-400 font-sm flex items-center gap-3">
                                    <fa-icon icon="exclamation-circle"></fa-icon> Nenhum resultado encontrado!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
