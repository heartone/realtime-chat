<script setup>
import { ref } from 'vue'
import Modal from '@/Components/Modal'
import ValidationErrors from '@/Components/ValidationErrors'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    method: {type: String, default: 'delete'},
    url: String,
    params: Object,
    title: String,
    message: {type: String, default: '本当に削除しますか？'},
    maxWidth: {type: String, default: 'sm'},
    show: Boolean,
    
})
const form = useForm(props.params)
const emits = defineEmits(['close']);

const confirm = () => {
    form.submit(props.method, props.url, {
        onError: () => {
            console.log(error)
        },
        onSuccess: () => {    
            emits('close')
        },
        onFinish: () => {
            
        },
    })
}
</script>

<template>
    <Modal :show="show" :maxWidth="maxWidth" @close="$emit('close')" >
        <template #header>{{ title ?? '確認'}}</template>
        <template #content>
            <div class="p-3">
                {{ message }}
            </div>          
            
        </template>
        <template #footer>
                <button class="btn" @click="$emit('close')" tabindex="-1">Cancel</button>
                <button class="btn-danger" @click="confirm()" :disabled="form.processing">OK</button>

        </template>
    </Modal>
        
</template>
<style scoped>

</style>