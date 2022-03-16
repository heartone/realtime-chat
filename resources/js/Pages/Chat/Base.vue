<script setup>
import AppLayout from '@/Layouts/AppLayout'
import Channels from './Channels'
import Chats from './Chats'
import { Head, Link } from '@inertiajs/inertia-vue3'

defineProps({
    channels: Object,
    channel: Object,
    chats: Object,
})
</script>
<template>
    <AppLayout>
        <Head v-if="channel" :title="channel.name" />
        <div id="side" class="min-h-screen overflow-auto">
            <Channels :channels="channels" :channel="channel" />
        </div>
        <div id="main" class="min-h-screen overflow-auto">
            <Chats :channel="channel" :chats="chats" />
        </div>
        
    </AppLayout>
</template>
<style scoped>
#side {
    width: 300px;
    background: #fafafa;
}
#main {
    width: 100%;
}
</style>