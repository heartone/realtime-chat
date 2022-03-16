<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import LoginUser from './Partials/LoginUser'
import ChannelForm from './Partials/ChannelForm'

import { ref } from 'vue'
defineProps({
    channels: Object,
    channel: Object,
})
const showModalChannel = ref(false)
</script>

<template>
    <header class="sticky top-0 z-10 flex items-center h-12 px-4 bg-gray-900 text-gray-200 border-b border-gray-200">
        リアルタイムチャット
    </header>
        <div class="overflow-y-auto">
            <LoginUser />
            <div class="flex justify-between items-center px-2 mt-3 mb-1 text-sm text-gray-500">
                <div><i class="fas fa-hashtag mr-2"></i><span class="font-bold">Channels</span></div>
                <button @click="showModalChannel = true" class="mr-1 p-1 hover:text-gray-900">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            <ChannelForm :show="showModalChannel" @close="showModalChannel=false" />
            <div 
            v-for="ch in channels.data" 
            :key="ch.id" 
            class="px-3 mb-1 ml-1"
        >
            <Link 
                :href="route('channels.show', ch)"
                class="block py-2 px-3 rounded hover:bg-gray-100 text-sm"
                :class="{'bg-gray-200 hover:bg-gray-200 font-bold': ch.id == channel?.id}"
            >{{ ch.name }}</Link>
        </div>
    </div>
    
</template>