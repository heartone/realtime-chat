<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue'
import Modal from '@/Components/Modal'
import InputError from '@/Components/InputError'
const props = defineProps({
    channel: Object, 
    show: Boolean
})
const emits = defineEmits(['close']);
const form = useForm({
    id: props.channel?.id,
    name: props.channel?.name,
    description: props.channel?.description,
})
const submitChannel = () => {
    const method = form.id ? 'patch' : 'post'
    const url = form.id ? route('channels.update', props.channel) : route('channels.store')
    form.submit(method, url, {
        onSuccess: () => {    
            emits('close')
        }
    })
}
</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <template #header>チャンネル{{ channel ? '情報の編集' : '新規作成'}}</template>
        <template #content>
            <form @submit.prevent="submitChannel()">
                <div class="text-sm text-gray-700 font-bold">チャンネル名</div>
                <input type="text" class="mt-2 form-control w-full" v-model="form.name">
                <InputError :message="form.errors.name" />
                <div class="mt-6 text-sm text-gray-700 font-bold">チャンネルの説明</div>
                <textarea class="mt-2 form-control w-full" v-model="form.description" rows="3"></textarea>
                <InputError :message="form.errors.description" />
            </form>
        </template>
        <template #footer>
             <form @submit.prevent="submitChannel()">
                 <button v-if="channel" type="submit" class="btn-primary" :disabled="form.processing">更新</button>
                 <button v-else type="submit" class="btn-danger" :disabled="form.processing">登録</button>
             </form>
            
        </template>
    </Modal>
        
</template>
<style scoped>

</style>