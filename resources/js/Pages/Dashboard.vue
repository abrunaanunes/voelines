<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';

const props =  defineProps({
    airplanes: Number,
    destinies: Number,
    passengers: Number,
    flights: Number
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Welcome :destinies="props.destinies" :airplanes="props.airplanes" :passengers="props.passengers" :flights="props.flights"/>
            </div>
        </div>
    </AppLayout>
</template>
