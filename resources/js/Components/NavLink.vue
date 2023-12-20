<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#006f89ff] text-base font-medium leading-5 text-[#006f89] focus:outline-none focus:border-[#6ba3b0ff] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#006f89] hover:text-[#55828cff] hover:border-[#6ba3b0ff] focus:outline-none focus:text-[#55828cff] focus:border-[#6ba3b0ff] transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
