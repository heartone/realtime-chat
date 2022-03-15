<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
    channels: Object,
    channel: Object,
})
</script>

<template>
    <div class="flex items-center h-12 px-4 bg-gray-100 border-gray-200">チャンネル</div>
    <div v-for="ch in channels.data" :key="ch.id">
        <Link 
            :href="route('channels.show', ch)"
            class="block py-3 px-2 hover:bg-gray-100"
        >{{ ch.name }}</Link>
    </div>
</template>