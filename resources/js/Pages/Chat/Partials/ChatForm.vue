<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue'
import ElasticTextArea from '@/Components/ElasticTextArea'
const props = defineProps({
    channel: Object,
    chat: Object
})
const emits = defineEmits(['onSubmit'])
const form = useForm({
    id: props.chat?.id,
    content: '',
})

const eta = ref(null)
const onSubmit = () => {
    form.post(route('chats.store', {channel_id: props.channel?.id}),{
        preserveScroll: true,
        onFinish: () => {
            emits('onSubmit'),
            form.content = ''            
            eta.value.initHeight()
            focus()
        }
    })
}

const focus = () => {
    eta.value.focus()
}
</script>

<template>
    <form class="bottom-0 z-8 p-3 bg-white border-t" @submit.prevent="onSubmit()">
        <div class="flex p-1 border border-gray-300 rounded">
            <ElasticTextArea ref="eta" :autofocus="true" v-model="form.content" placeholder="メッセージを入力" />
            <button class="btn-dark whitespace-nowrap ml-2" :disabled="form.processing" :class="{'bg-opacity-50': form.content.length == 0}" type="submit">送信</button>
        </div>
    </form>
</template>
