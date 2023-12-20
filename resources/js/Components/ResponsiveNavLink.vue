<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-[#006f89ff] text-left text-base font-bold text-[#004758] bg-[#ecf1f2ff] focus:outline-none focus:bg-[#f8f9f9ff] focus:border-[#6ba3b0ff] transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-[#006f89] hover:bg-[#f8f9f9ff] hover:border-[#6ba3b0ff] focus:outline-none focus:bg-[#f8f9f9ff] focus:border-[#6ba3b0ff] transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
