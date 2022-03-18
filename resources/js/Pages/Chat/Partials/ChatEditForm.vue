<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue'
import ElasticTextArea from '@/Components/ElasticTextArea'
import Modal from '@/Components/Modal'
const props = defineProps({
    chat: Object
})
const emits = defineEmits(['close', 'onSubmit'])

const form = useForm({
    id: props.chat.id,
    content: props.chat.content,
})

const submitChat = () => {
    form.patch(route('chats.update', props.chat),{
        preserveScroll: true,
        onFinish: () => {
            emits('close')
            emits('onSubmit')
        }
    })
}

</script>

<template>
    <form class="py-3" @submit.prevent="submitChat()">
        <div class="p-1 border border-gray-300 rounded">
            <ElasticTextArea :autofocus="true" :autoadjust="true" v-model="form.content" placeholder="メッセージを入力" />
            <div class="p-2">
                <button class="btn-success" :disabled="form.processing" :class="{'bg-opacity-50': form.content.length == 0}" type="submit">送信</button>
                <button type="button" class="btn-white ml-2" @click="$emit('close')">キャンセル</button>
            </div>
        </div>
    </form>
</template>
<style scoped>

</style>