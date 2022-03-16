<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import ChatForm from './Partials/ChatForm'
import ChannelForm from './Partials/ChannelForm'
import Modal from '@/Components/Modal'
import Dropdown from '@/Components/Dropdown'
import DropdownButton from '@/Components/DropdownButton'
import { computed, ref } from 'vue';
const props = defineProps({    
    channel: Object,
    chats: Object,
})
const showModalChannel = ref(false)
const reversedChatsData = computed(() => props.chats.data.reverse())
const dateFormat = (dateString) => {
    const d = new Date(dateString)
    return d.toLocaleString('ja-JP')
}
</script>

<template>
    <div class="sticky top-0 z-10 flex items-center justify-between h-12 px-4 border-b bg-gray-900 text-gray-100 font-bold shadow-sm">
        <div>
            <Link class="px-1 mr-2 text-gray-300 hover:text-yellow-100" :href="route('channels.index')"><i class="fa fa-chevron-left"></i></Link>
            {{ channel?.name }}
        </div>
        
        <Dropdown class="z-10">
            <template #trigger>
                <button class="px-2 text-gray-300 mr-2"><i class="fa fa-ellipsis-v"></i></button>
            </template>
            <template #content>
                <DropdownButton @click="showModalChannel=true" @close="showModalChannel=false">
                    チャンネル情報編集
                </DropdownButton>
            </template>
        </Dropdown>
        <ChannelForm :channel="channel" :show="showModalChannel" @close="showModalChannel=false" />
    
    </div>
    

    <div v-if="chats?.data.length">
        <div class="py-3 px-4 border-b flex" v-for="chat in chats.data.slice().reverse()" :key="chat.id">
            <div>
                <img class="h-10 h-10 whitespace-nowrap overflow-hidden text-xs rounded" :src="chat.user.gravatar_url" :alt="chat.user.name + 'のアイコン'">
            </div>
            <div class="w-full pl-3">
                <div class="flex items-center">
                    <span class="text-sm font-bold">{{ chat.user.name }}</span>
                    <span class="ml-3 text-xs text-gray-600">{{ dateFormat(chat.created_at) }}</span>
                </div>
                <div class="mt-2 markdown-body" v-html="chat.content_html"></div>
            </div>
            
        </div>
        
    </div>
    
    <ChatForm v-if="channel" :channel="channel" />
    
</template>
<style scoped>

</style>