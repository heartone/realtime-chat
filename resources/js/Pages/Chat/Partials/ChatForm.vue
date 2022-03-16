<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue'

const props = defineProps({
    channel: Object,
    chat: Object
})

const form = useForm({
    id: props.chat?.id,
    content: '',
})
const contentarea = ref(null)
onMounted(() => {
    initHeight()
    scrollToBottom()
})
const submitChat = () => {
    form.post(route('chats.store', {channel_id: props.channel.id}),{
        preserveScroll: true,
        onFinish: () => {
            form.content = ''            
            
            initHeight()
            contentarea.value.focus()
            scrollToBottom()
        }
    })
}
const scrollToBottom = () => {
    const el = document.querySelector('#main');
    setTimeout(() => {
        el.scrollTo(0, el.scrollHeight);
    }, 0)   
}
let ch = 0
const initHeight = () => {
    ch = contentarea.value.clientHeight
    contentarea.value.style.height = "auto"
}
const adjustHeight = () => {
    contentarea.value.style.height = ch + 'px';
    let sh = contentarea.value.scrollHeight;
    contentarea.value.style.height = sh < 256 ? sh + 'px' : '256px';
    
}
</script>

<template>
    <form class="sticky bottom-0 z-8 p-3 bg-white border-t" @submit.prevent="submitChat()">
        <div class="flex p-1 border border-gray-300 rounded">
            <textarea 
                ref="contentarea" rows="1" 
                @input="adjustHeight" v-model="form.content"
                class="w-full border-0 rounded bg-none focus:outline-none focus:ring-none text-sm" 
                placeholder="メッセージを入力"
            ></textarea>
            <button class="btn-dark whitespace-nowrap ml-2" :disabled="form.processing" :class="{'bg-opacity-50': form.content.length == 0}" type="submit">送信</button>
        </div>
        
    </form>
</template>
<style scoped>

</style>