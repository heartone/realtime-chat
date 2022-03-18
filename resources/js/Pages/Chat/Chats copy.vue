<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Chat from './Partials/Chat'
import ChatForm from './Partials/ChatForm'
import ChannelForm from './Partials/ChannelForm'
import ModalConfirm from '@/Components/ModalConfirm'
import Dropdown from '@/Components/Dropdown'
import DropdownButton from '@/Components/DropdownButton'
import { computed, ref, onMounted } from 'vue';

const props = defineProps({    
    channel: Object,
})
const chats = ref([])
const container = ref(null)
onMounted(() => {    
   fetchChats()
})

const fetchChats = async (url) => {
    // https://ma-vericks.com/infinite-scroll/
    // https://peachscript.github.io/vue-infinite-loading/

    // const prev = container.value.scrollHeight
    
    const response = await axios.get(url ?? route('chats.index', {channel_id: props.channel.id}))
    chats.value.push(...(response.data.data).slice().reverse())
}
const showModalChannel = ref(false)
const showModalDeleteChannel = ref(false)
const scrollToBottom = () => {
    
    setTimeout(() => {
        el.scrollTo(0, el.scrollHeight);
    }, 0)   
}
</script>

<template>
<div id="main" ref="container" class="min-h-screen overflow-auto" scroll-region>
    <div class="sticky top-0 z-10 flex items-center justify-between h-12 px-4 border-b bg-gray-900 text-gray-100 font-bold shadow-sm">
        <div>
            <Link class="px-1 mr-2 text-gray-300 hover:text-yellow-100" :href="route('channels.index')"><i class="fa fa-chevron-left"></i></Link>
            {{ channel?.name }} {{ container?.scrollHeight }}
        </div>
        <div v-if="channel">
            <Dropdown class="z-10">
                <template #trigger>
                    <button class="px-2 text-gray-300 mr-2"><i class="fa fa-ellipsis-v"></i></button>
                </template>
                <template #content>
                    <DropdownButton @click="showModalChannel=true" @close="showModalChannel=false">
                        チャンネル情報編集
                    </DropdownButton>
                    <DropdownButton @click="showModalDeleteChannel=true" @close="showModalDeleteChannel=false">
                        チャンネル削除
                    </DropdownButton>
                </template>
            </Dropdown>
            <ChannelForm :channel="channel" :show="showModalChannel" @close="showModalChannel=false" />
            <ModalConfirm :show="showModalDeleteChannel" @close="showModalDeleteChannel=false" method="delete" :url="route('channels.destroy', channel)" />
        </div>
        
    </div>
    
    <div class="p-3">
        <button class="btn btn-dark" @click="fetchChats()">load more</button>
    </div>
   
    <div v-if="chats">
        
        <div class="py-3 px-4 border-b flex" v-for="chat in chats" :key="chat.id">
            <Chat :chat="chat" @onSubmit="fetchChats" />
        </div>
   
    </div>
    <ChatForm v-if="channel" :channel="channel" @onSubmit="fetchChats" />
    
    </div>
</template>
<style scoped>

</style>