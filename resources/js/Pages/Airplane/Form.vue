<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { reactive } from 'vue';
    import { Inertia } from '@inertiajs/inertia';

    let form = reactive({
        airplane_model : props.item ? props.item.airplane_model : '',
        seats : props.item ? props.item.seats : '',
        special_seats : props.item ? props.item.special_seats : ''
    })

    let submit = () => {
        Inertia.post('/admin/avioes', form)
    }

    const props =  defineProps({
        item: Object,
    })
</script>

<template>
    <AppLayout title="Aviões">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    {{ props.item ? 'Editar avião' : 'Cadastrar avião' }}
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
                                    <label for="airplane_model" class="block font-medium text-sm text-gray-700">Modelo do avião <span class="text-red-600">*</span></label>
                                    <input type="text" v-model="form.airplane_model" name="airplane_model" id="airplane_model" class="form-input rounded-md shadow-sm mt-1 block w-full" required/>
                                    <span v-if="$page.props.errors?.airplane_model">
                                        <small class="text-red" v-text="$page.props.errors?.airplane_model"></small>
                                    </span>
                                </div>

                                <div>
                                    <label for="seats" class="block font-medium text-sm text-gray-700">Número de assentos <span class="text-red-600">*</span></label>
                                    <input type="number" v-model="form.seats" name="seats" id="seats" class="form-input rounded-md shadow-sm mt-1 block w-full" required/>
                                    <span v-if="$page.props.errors?.seats">
                                        <small class="text-red" v-text="$page.props.errors?.seats"></small>
                                    </span>
                                </div>

                                <div>
                                    <label for="special_seats" class="block font-medium text-sm text-gray-700">Número de assentos especiais <span class="text-red-600">*</span></label>
                                    <input type="number" v-model="form.special_seats" name="special_seats" id="special_seats" class="form-input rounded-md shadow-sm mt-1 block w-full" required/>
                                    <span v-if="$page.props.errors?.special_seats">
                                        <small class="text-red" v-text="$page.props.errors?.special_seats"></small>
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
