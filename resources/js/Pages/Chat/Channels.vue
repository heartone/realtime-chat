<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import LoginUser from './Partials/LoginUser'
import ChannelForm from './Partials/ChannelForm'
import { ref, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
defineProps({
    channels: Object,
    channel: Object,
})

const showModalChannel = ref(false)
const hideMenu = () => {
    document.querySelector('#side').classList.remove('on')
}
Echo.channel('chat').listen('ChatCreated', (e) => {
    Inertia.reload({
        only: ['channels'],
    })
})
</script>

<template>
    <header class="sticky top-0 z-10 flex items-center h-12 px-4 bg-gray-900 text-gray-200 shadow border-r border-gray-700">
        <Link class="truncate" :href="route('top')">💬 リアルタイムチャット</Link>
    </header>
    <div>
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
                class="flex items-center block py-2 px-2 truncate rounded hover:bg-gray-100 text-sm"
                :class="{'bg-gray-200 hover:bg-gray-200 font-bold': ch.id == channel?.id}"
                preserve-state
                preserve-scroll
                @click="hideMenu()"
            >
                <div class="h-2 w-2 rounded-full bg-orange-500 mr-1" :class="{'invisible': ch.user?.access_at >= ch.latest_chat?.created_at}"></div>
                <div class="truncate">{{ ch.name }}</div>
            </Link>
        </div>
    </div>
    
</template>