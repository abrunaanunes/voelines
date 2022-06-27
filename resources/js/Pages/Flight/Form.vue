<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import moment from 'moment'
    import Money from '@/components/Money.vue';

    let form = reactive({
        departure_date : props.item ? moment(props.item.departure_date).format('YYYY-MM-DD') : '',
        value : props.item ? props.item.value : '',
        airplane_id : props.item ? props.item.airplane_id : '',
    })

    let submit = () => {
        Inertia.post('/admin/voos', form)
    }

    const props =  defineProps({
        item: Object,
        airplanes: Object,
        destinies: Object,
    })
</script>

<template>
    <AppLayout title="Voos">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    {{ props.item ? 'Editar voo' : 'Cadastrar voo' }}
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
                                    <label for="departure_date" class="block font-medium text-sm text-gray-700">Data de partida <span class="text-red-600">*</span></label>
                                    <input type="date" v-model="form.departure_date" name="departure_date" id="departure_date" class="form-input rounded-md shadow-sm mt-1 block w-full" required/>
                                    <span v-if="$page.props.errors?.departure_date">
                                        <small class="text-red" v-text="$page.props.errors?.departure_date"></small>
                                    </span>
                                </div>

                                <div>
                                    <label for="value" class="block font-medium text-sm text-gray-700">Valor da passagem <span class="text-red-600">*</span></label>
                                    <money class="w-full" required v-model="form.value"/>
                                    <span v-if="$page.props.errors?.value">
                                        <small class="text-red" v-text="$page.props.errors?.value"></small>
                                    </span>
                                </div>

                                <div v-if="props.airplanes?.length > 0">
                                    <label for="airplane_id" class="block font-medium text-sm text-gray-700">Código do avião <span class="text-red-600">*</span></label>
                                    <select v-model="form.airplane_id" name="airplane_id" id="airplane_id" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <option v-for="(airplane, idx) in props.airplanes" :key="idx" :value="airplane.id" v-text="airplane.airplane_model"></option>
                                    </select>
                                    <span v-if="$page.props.errors?.airplane_id">
                                        <small class="text-red" v-text="$page.props.errors?.airplane_id"></small>
                                    </span>
                                </div>
                                <div v-else class="p-3 bg-gray-200 text-gray-400 font-sm flex items-center gap-3">
                                    É necessário cadastrar um avião primeiro.
                                </div>

                                <div v-if="props.destinies?.length > 0">
                                    <label for="destiny_id" class="block font-medium text-sm text-gray-700">Destino <span class="text-red-600">*</span></label>
                                    <select v-model="form.destiny_id" name="destiny_id" id="destiny_id" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        <option v-for="(destiny, idx) in props.destinies" :key="idx" :value="destiny.id">{{ destiny.airport_cod }} -- {{ destiny.airport_name }}</option>
                                    </select>
                                    <span v-if="$page.props.errors?.destiny_id">
                                        <small class="text-red" v-text="$page.props.errors?.destiny_id"></small>
                                    </span>
                                </div>
                                <div v-else class="p-3 bg-gray-200 text-gray-400 font-sm flex items-center gap-3">
                                    É necessário cadastrar um destino primeiro.
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" :disabled="!props.destinies && !props.airplanes" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
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
