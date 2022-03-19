<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Chat from './Partials/Chat'
import ChatForm from './Partials/ChatForm'

import ChannelShow from './Partials/ChannelShow'
import ChannelForm from './Partials/ChannelForm'
import ModalConfirm from '@/Components/ModalConfirm'
import Dropdown from '@/Components/Dropdown'
import DropdownButton from '@/Components/DropdownButton'
import { computed, ref, onMounted, watch, toRefs } from 'vue';

const props = defineProps({    
    channel: Object,
})
const chats = ref([])
const pagination = ref({})
const container = ref(null)
const loading = ref(false)
const showChannelEdit = ref(false)
const showChannelDelete = ref(false)
const chatform = ref(null)
onMounted(() => {
    // 初回アクセス（マウント時）
    if (props.channel) { initChats() }
})
// channelの変更を監視してチャットを初期化
const { channel } = toRefs(props);
watch(channel, () => {
    initChats()
})
const loadMore = () => {
    if (!pagination.value.nextPageUrl) return
    loading.value = true
    const prev = container.value.scrollHeight
    axios.get(pagination.value.nextPageUrl).then((response) => {
        chats.value.unshift(...(response.data.data.slice().reverse()))
        pagination.value = {
            nextPageUrl: response.data.next_page_url
        }
    }).finally(() => {
        container.value.scrollTop = container.value.scrollHeight - prev
        loading.value = false
    })    
}
const  initChats = async () => {
    if (!props.channel) return
    loading.value = true
    axios.get(route('chats.index', {channel_id: props.channel.id})).then((response) => {
        chats.value = response.data.data.slice().reverse()
        pagination.value = {
            nextPageUrl: response.data.next_page_url
        }
    }).finally(() => {
        loading.value = false
        container.value.scrollTo(0, container.value.scrollHeight);
        scroll()
    })  
}
const showModalChannel = ref(false)


const scroll = () => {
    container.value.onscroll = (ev) => {
        setTimeout(() => {
            if (!loading.value && container.value.scrollTop < 100 && !!pagination.value.nextPageUrl) {
                loadMore()
            }
        }, 200) 
    }
}
const toggleMenu = () => {
    document.querySelector('#side').classList.toggle('on')
}
</script>

<template>
<div id="main" ref="container" class="w-full min-h-screen overflow-auto" scroll-region>
    <div class="sticky top-0 z-10 flex items-center justify-between h-12 px-2 shadow bg-gray-900 text-gray-100 font-bold shadow-sm">
        <div class="flex items-center">
            <button @click="toggleMenu()" class="md:hidden py-1 px-2 mr-2 bg-gray-800 text-gray-300 hover:bg-black hover:text-yellow-100"><i class="fa fa-bars fa-fw"></i></button>
            <div v-if="channel" @click="showModalChannel=true" @close="showModalChannel=false" class="truncate cursor-pointer hover:text-blue-300 text-gray-200">{{ channel.name }}</div>
        </div>
    </div>
    <ChannelShow v-if="channel" :channel="channel" :show="showModalChannel" @close="showModalChannel=false" />
     

    <div v-if="!loading && !pagination.nextPageurl" class="p-2 flex justify-center">
       <div class="rounded-full bg-gray-500 text-white text-xs py-1 px-4">最初の投稿です</div>
    </div>
    <div v-show="loading" class="flex justify-center p-4">
        <div className="animate-ping h-2 w-2 bg-blue-500 rounded-full"></div>
        <div className="animate-ping h-2 w-2 bg-indigo-500 animation-delay-100 rounded-full mx-3"></div>
        <div className="animate-ping h-2 w-2 bg-purple-500 animation-delay-200 rounded-full"></div>
    </div>
    <div v-if="chats.length">        
        <template v-for="chat in chats" :key="chat.id">
            <Chat :chat="chat" />
        </template>
    </div>
    <ChatForm v-if="channel" :channel="channel" @onSubmit="initChats()" />
    <ChannelForm v-if="channel" :channel="channel" :show="showChannelEdit" @close="showChannelEdit=false" />
    <ModalConfirm v-if="channel" :show="showChannelDelete" @close="showChannelDelete=false" method="delete" :url="route('channels.destroy', channel)" />
      
    </div>
</template>
