<script setup>
import {computed} from 'vue'
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';


</script>

<template>
    <div class="px-3 border-b py-2 bg-gray-200">
        <BreezeDropdown align="right" width="48">
            <template #trigger>
                <button type="button" class="flex justify-between btn-white w-full">
                    {{ $page.props.auth.user.name }}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </template>

            <template #content>
                <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                    Log Out
                </BreezeDropdownLink>
            </template>
        </BreezeDropdown>
    </div>
</template>