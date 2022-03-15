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
            scrollToBottom()
            initHeight()
            contentarea.value.focus()
        }
    })
}
const scrollToBottom = () => {
    const el = document.querySelector('#main');
    el.scrollTo(0, el.scrollHeight);
}

const initHeight = () => {
    contentarea.value.style.height = "42px"
}
const adjustHeight = () => {
    let ch = contentarea.value.clientHeight
    contentarea.value.style.height = ch + 'px';
    let sh = contentarea.value.scrollHeight;
    contentarea.value.style.height = sh + 'px';
}
</script>

<template>
    <form class="sticky bottom-0 z-10 p-3 bg-white border-t" @submit.prevent="submitChat()">
        <textarea ref="contentarea" rows="1" @input="adjustHeight" v-model="form.content" class="form-control w-full"></textarea>
        <button class="btn-dark" :disabled="form.processing || form.content.length == 0" type="submit">送信</button>
    </form>
</template>
<style scoped>

</style>