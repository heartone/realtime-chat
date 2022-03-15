<script setup>
import { ref } from 'vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/inertia-vue3';


</script>

<template>
    <main class="flex absolute bottom-0 top-0 w-full overflow-hidden">
        <slot />
    </main>
    
</template>
