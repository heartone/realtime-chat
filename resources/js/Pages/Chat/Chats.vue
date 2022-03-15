<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import ChatForm from './Partials/Form.vue'
import Modal from '@/Components/Modal'
import { computed, ref } from 'vue';
const props = defineProps({    
    channel: Object,
    chats: Object,
})
const show = ref(false)
const reversedChatsData = computed(() => props.chats.data.reverse())
const dateFormat = (dateString) => {
    const d = new Date(dateString)
    return d.toLocaleString('ja-JP')
}
</script>

<template>
    <div class="sticky top-0 z-10 flex items-center h-12 px-4 border-b bg-gray-900 text-gray-100 font-bold shadow-sm">
        <Link class="px-1 mr-2 text-gray-300 hover:text-yellow-100" :href="route('channels.index')"><i class="fa fa-chevron-left"></i></Link>
        {{ channel?.name }}
    </div>
    <div v-if="chats?.data.length">
        <div class="py-3 px-4 border-b" v-for="chat in chats.data.slice().reverse()" :key="chat.id">
            <div class="flex items-center">
                <span class="text-sm font-bold">{{ chat.user.name }}</span>
                <span class="ml-3 text-xs text-gray-600">{{ dateFormat(chat.created_at) }}</span>
            </div>
            <div class="mt-3 markdown-body" v-html="chat.content_html"></div>
        </div>
        
    </div>
    
    <ChatForm v-if="channel" :channel="channel" />
    
</template>
<style scoped>

</style>