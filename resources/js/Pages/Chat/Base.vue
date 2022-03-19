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
        <div id="side" class="min-h-screen overflow-auto" scroll-region>
            <Channels :channels="channels" :channel="channel" />
        </div>
        <Chats :channel="channel" />                
    </AppLayout>
</template>
<style scoped>
#side {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 300px;
    background: #fafafa;
    left: -300px;;
    z-index: 10;
    min-width: 300px;
    transition: all .3s ease;
}

#side.on {
    left: 0;
    box-shadow: 4px 0px 8px rgba(0, 0, 0, 0.1);
}
@media screen and (min-width:768px) {
    #side, #side.on {  
        position: static;  
        left: 0;
        box-shadow: none;
    }
    #main {
        left: 300px;
        width: calc(100% - 300px);
    }
}
</style>