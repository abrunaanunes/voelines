<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-1 pt-1 text-base font-medium leading-5 text-white transition hover:text-gray-200'
        : 'inline-flex items-center px-1 pt-1 text-base font-medium leading-5 text-white hover:text-gray-200 hover:border-gray-400 transition';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
