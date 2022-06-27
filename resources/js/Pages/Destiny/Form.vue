<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Jetstream/Welcome.vue';
    import { reactive } from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    import Money from '@/components/Money.vue';

    let form = reactive({
        airport_cod : props.item ? props.item.airport_cod : '',
        airport_name : props.item ? props.item.airport_name : '',
        shipping_fee : props.item ? props.item.shipping_fee : ''
    })

    let submit = () => {
        Inertia.post('/admin/destinos', form)
    }

    const props =  defineProps({
        item: Object,
    })
</script>

<template>
    <AppLayout title="Destinos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    {{ props.item ? 'Editar destino' : 'Cadastrar destino' }}
                </h2>
            </div>
        </template>

        <div>
            <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form @submit.prevent="submit">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="bg-white p-6 flex flex-col gap-4">
                                <div>
                                    <label for="airport_cod" class="block font-medium text-sm text-gray-700">Código do aeroporto <span class="text-red-600">*</span></label>
                                    <input type="text" v-model="form.airport_cod" name="airport_cod" id="airport_cod" class="form-input rounded-md shadow-sm mt-1 block w-full" required/>
                                    <span v-if="$page.props.errors?.airport_cod">
                                        <small class="text-red" v-text="$page.props.errors?.airport_cod"></small>
                                    </span>
                                </div>
                                    
                                <div>
                                    <label for="airport_name" class="block font-medium text-sm text-gray-700">Nome do aeroporto <span class="text-red-600">*</span></label>
                                    <input type="text" v-model="form.airport_name" name="airport_name" id="airport_name" class="form-input rounded-md shadow-sm mt-1 block w-full" required/>
                                    <span v-if="$page.props.errors?.airport_name">
                                        <small class="text-red" v-text="$page.props.errors?.airport_name"></small>
                                    </span>    
                                </div>

                                <div>
                                    <label for="shipping_fee" class="block font-medium text-sm text-gray-700">Taxa de embarque <span class="text-red-600">*</span></label>
                                    <money class="w-full" required v-model="form.shipping_fee"/>
                                    <span v-if="$page.props.errors?.shipping_fee">
                                        <small class="text-red" v-text="$page.props.errors?.shipping_fee"></small>
                                    </span>
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
