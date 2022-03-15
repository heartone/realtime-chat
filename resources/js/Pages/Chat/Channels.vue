<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
    channels: Object,
    channel: Object,
})
</script>

<template>
    <div class="sticky top-0 z-10 flex items-center h-12 px-4 bg-gray-900 text-gray-200 border-b border-gray-200">チャンネル</div>
        <div class="py-2 overflow-y-auto">
            <div 
            v-for="ch in channels.data" 
            :key="ch.id" 
            class="px-3 mb-1"
            
        >
            <Link 
                :href="route('channels.show', ch)"
                class="block py-2 px-2 rounded-lg hover:bg-gray-100 text-sm"
                :class="{'bg-gray-200 hover:bg-gray-200 font-bold': ch.id == channel?.id}"
            >{{ ch.name }}</Link>
        </div>
    </div>
    
</template>