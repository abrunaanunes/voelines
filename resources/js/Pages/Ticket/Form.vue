<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import { reactive } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import moment from 'moment'

    let form = reactive({
        name : props.item ? props.item.name : '',
        document : props.item ? props.item.document : '',
        flight_id : props.item ? props.item.flight_id : null,
        birth : props.item ? moment(props.item.birth).format('YYYY-MM-DD') : '',
        type_seat: props.item ? props.item.type_seat : null,
    })

    let submit = () => {
        Inertia.post('/admin/passagens', form)
    }

    const props =  defineProps({
        item: Object,
        flights: Object,
    })
</script>

<template>
    <AppLayout title="Passagens">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    {{ props.item ? 'Editar passagem' : 'Vender passagem' }}
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
                                    <label for="name" class="block font-medium text-sm text-gray-700">Nome completo <span class="text-red-600">*</span></label>
                                    <input type="text" v-model="form.name" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                                    <span v-if="$page.props.errors?.name">
                                        <small class="text-red" v-text="$page.props.errors?.name"></small>
                                    </span>
                                </div>

                                <div>
                                    <label for="document" class="block font-medium text-sm text-gray-700">CPF <span class="text-red-600">*</span></label>
                                    <input type="text" v-model="form.document" name="document" id="document" class="form-input rounded-md shadow-sm mt-1 block w-full" v-maska="'###.###.###-##'"/>
                                    <span v-if="$page.props.errors?.document">
                                        <small class="text-red" v-text="$page.props.errors?.document"></small>
                                    </span>
                                </div>

                                <div>
                                    <label for="birth" class="block font-medium text-sm text-gray-700">Data de nascimento <span class="text-red-600">*</span></label>
                                    <input type="date" v-model="form.birth" name="birth" id="birth" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                                    <span v-if="$page.props.errors?.birth">
                                        <small class="text-red" v-text="$page.props.errors?.birth"></small>
                                    </span>
                                </div>

                                <div v-if="props.flights">
                                    <label for="flight_id" class="block font-medium text-sm text-gray-700">Voo <span class="text-red-600">*</span></label>
                                    <select v-model="form.flight_id" name="flight_id" id="flight_id" class="form-input rounded-md shadow-sm mt-1 block w-full">
                                        <option v-for="(flight, idx) in props.flights" :key="idx" :value="flight.id" v-text="flight.id"></option>
                                    </select>
                                    <span v-if="$page.props.errors?.flight_id">
                                        <small class="text-red" v-text="$page.props.errors?.flight_id"></small>
                                    </span>
                                </div>
                                <div v-else class="p-3 bg-gray-200 text-gray-400 font-sm flex items-center gap-3">
                                    É necessário cadastrar um voo primeiro.
                                </div>

                                <div class="flex flex-col gap-2" v-if="form.flight_id != null">
                                    <p class="text-base">Selecione o tipo de poltrona <span class="text-red-600">*</span></p>
                                    <div class="flex flex-row items-center gap-4">
                                        <input type="radio" name="type_seat" v-model="form.type_seat" value="special_seat" id="special_seat"/>
                                        <label for="special_seat">Poltrona especial</label>
                                    </div>

                                    <div class="flex flex-row items-center gap-4">
                                        <input type="radio" name="type_seat" v-model="form.type_seat" value="seat" id="seat"/>
                                        <label for="seat">Poltrona comum</label>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" :disabled="!props.flights" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
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
